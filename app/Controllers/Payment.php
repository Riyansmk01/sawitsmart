<?php

namespace App\Controllers;

use App\Libraries\KlikQris;
use App\Models\PaymentModel;

class Payment extends BaseController
{
    protected KlikQris $qris;
    protected PaymentModel $paymentModel;

    public function __construct()
    {
        $this->qris         = new KlikQris();
        $this->paymentModel = new PaymentModel();
    }

    // ─────────────────────────────────────────────────────────────────────────
    // HALAMAN CHECKOUT
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Form checkout / pilih paket pembayaran
     */
    public function checkout()
    {
        // Paket-paket yang tersedia
        $packages = [
            [
                'id'          => 'basic',
                'name'        => 'Paket Basic',
                'price'       => 99000,
                'description' => 'Akses SIM Sawit untuk 1 kebun',
                'features'    => ['1 Kebun', '5 Zona', 'Laporan Bulanan', 'Support Email'],
                'icon'        => 'fa-seedling',
                'color'       => '#4ade80',
                'popular'     => false,
            ],
            [
                'id'          => 'pro',
                'name'        => 'Paket Pro',
                'price'       => 299000,
                'description' => 'Akses penuh SIM Sawit + SIM Koperasi',
                'features'    => ['5 Kebun', '20 Zona', 'Laporan Real-Time', 'Support Prioritas', 'API Access'],
                'icon'        => 'fa-rocket',
                'color'       => '#60a5fa',
                'popular'     => true,
            ],
            [
                'id'          => 'enterprise',
                'name'        => 'Paket Enterprise',
                'price'       => 799000,
                'description' => 'Solusi komprehensif untuk korporasi',
                'features'    => ['Tak Terbatas', 'Zona Tak Terbatas', 'Analytics Lengkap', 'Dedicated Support', 'Custom Integration'],
                'icon'        => 'fa-building',
                'color'       => '#f59e0b',
                'popular'     => false,
            ],
        ];

        $data = [
            'title'            => 'Berlangganan — SawitSmart',
            'meta_description' => 'Pilih paket SawitSmart yang sesuai kebutuhan kebun sawit Anda.',
            'packages'         => $packages,
        ];

        return view('payment/checkout', $data);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PROSES PEMBAYARAN
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Buat transaksi baru via AJAX/POST
     */
    public function create()
    {
        // Validasi input
        $rules = [
            'amount'      => 'required|integer|greater_than[0]',
            'keterangan'  => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $this->validator->getErrors(),
            ]);
        }

        $amount      = (int) $this->request->getPost('amount');
        $keterangan  = $this->request->getPost('keterangan') ?? 'Pembayaran SawitSmart';
        $userId      = session()->get('user_id') ?? null;

        // Generate order_id unik
        $orderId = PaymentModel::generateOrderId('SS');

        // Simpan dulu ke DB sebagai PENDING
        $this->paymentModel->insert([
            'order_id'    => $orderId,
            'user_id'     => $userId,
            'amount'      => $amount,
            'keterangan'  => $keterangan,
            'status'      => 'PENDING',
        ]);

        // Panggil API KlikQRIS
        $result = $this->qris->createTransaction($orderId, $amount, $keterangan);

        if (!isset($result['status']) || $result['status'] !== true) {
            // Hapus record jika gagal
            $this->paymentModel->where('order_id', $orderId)->delete();

            log_message('error', '[Payment::create] KlikQRIS Error: ' . json_encode($result));
            return $this->response->setJSON([
                'success' => false,
                'message' => $result['message'] ?? 'Gagal membuat transaksi. Silakan coba lagi.',
            ]);
        }

        $txData = $result['data'];

        // Update record dengan data dari API
        $this->paymentModel->updateStatusSafe($orderId, 'PENDING', [
            'total_amount' => $txData['total_amount'] ?? $amount,
            'direct_url'   => $txData['direct_url'] ?? null,
            'qris_url'     => $txData['qris_url'] ?? null,
            'signature'    => $txData['signature'] ?? null,
            'expired_at'   => $txData['expired_at'] ?? null,
        ]);

        return $this->response->setJSON([
            'success'      => true,
            'message'      => 'Transaksi berhasil dibuat',
            'order_id'     => $orderId,
            'total_amount' => $txData['total_amount'] ?? $amount,
            'direct_url'   => $txData['direct_url'] ?? null,
            'qris_url'     => $txData['qris_url'] ?? null,
            'expired_at'   => $txData['expired_at'] ?? null,
            'redirect'     => base_url('payment/status/' . $orderId),
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // STATUS TRANSAKSI
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Halaman status pembayaran
     */
    public function status(string $orderId)
    {
        $payment = $this->paymentModel->getByOrderId($orderId);

        if (!$payment) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi tidak ditemukan');
        }

        $data = [
            'title'            => 'Status Pembayaran — SawitSmart',
            'meta_description' => 'Cek status pembayaran QRIS Anda.',
            'payment'          => $payment,
        ];

        return view('payment/status', $data);
    }

    /**
     * Cek status via AJAX (polling)
     */
    public function checkStatus(string $orderId)
    {
        $payment = $this->paymentModel->getByOrderId($orderId);

        if (!$payment) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ]);
        }

        // Jika sudah PAID/SUCCESS, langsung kembalikan dari DB
        if (in_array($payment['status'], ['PAID', 'SUCCESS'])) {
            return $this->response->setJSON([
                'success' => true,
                'status'  => $payment['status'],
                'payment' => $payment,
            ]);
        }

        // Cek ke API KlikQRIS
        $result = $this->qris->checkStatus($orderId);

        if (isset($result['status']) && $result['status'] === true) {
            $apiStatus = $result['data']['status'] ?? 'PENDING';

            // Update status di DB jika berubah
            if ($apiStatus !== $payment['status']) {
                $extra = [];
                if ($apiStatus === 'PAID' || $apiStatus === 'SUCCESS') {
                    $extra['paid_at'] = date('Y-m-d H:i:s');
                }
                $this->paymentModel->updateStatusSafe($orderId, $apiStatus, $extra);
                $payment['status'] = $apiStatus;
            }
        }

        return $this->response->setJSON([
            'success' => true,
            'status'  => $payment['status'],
            'payment' => [
                'order_id'     => $payment['order_id'],
                'total_amount' => $payment['total_amount'],
                'status'       => $payment['status'],
                'expired_at'   => $payment['expired_at'],
                'qris_url'     => $payment['qris_url'],
                'direct_url'   => $payment['direct_url'],
            ],
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // WEBHOOK / CALLBACK
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Endpoint Webhook dari KlikQRIS
     * POST /payment/webhook
     */
    public function webhook()
    {
        // Hanya terima POST
        if (!$this->request->is('post')) {
            return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
        }

        $rawBody = $this->request->getBody();
        $payload = json_decode($rawBody, true);

        if (json_last_error() !== JSON_ERROR_NONE || empty($payload)) {
            log_message('warning', '[Webhook] Payload tidak valid: ' . $rawBody);
            return $this->response->setStatusCode(400)->setBody('Bad Request');
        }

        $data      = $payload['data'] ?? [];
        $orderId   = $data['order_id'] ?? null;
        $status    = $data['status'] ?? null;
        $signature = $data['signature'] ?? null;

        if (!$orderId || !$status) {
            log_message('warning', '[Webhook] Data tidak lengkap: ' . $rawBody);
            return $this->response->setStatusCode(400)->setBody('Bad Request');
        }

        // Cari transaksi di DB
        $payment = $this->paymentModel->getByOrderId($orderId);

        if (!$payment) {
            log_message('warning', '[Webhook] Order tidak ditemukan: ' . $orderId);
            // Tetap return 200 agar KlikQRIS tidak retry terus
            return $this->response->setStatusCode(200)->setBody('OK');
        }

        // ── Validasi Signature (Double Security) ──────────────────────────────
        if (!empty($payment['signature']) && !empty($signature)) {
            if (!$this->qris->validateSignature($signature, $payment['signature'])) {
                log_message('error', '[Webhook] Signature TIDAK COCOK untuk order: ' . $orderId);
                return $this->response->setStatusCode(403)->setBody('Forbidden');
            }
        }

        // ── Hindari Produk Ganda: cek status saat ini ─────────────────────────
        if (in_array($payment['status'], ['PAID', 'SUCCESS'])) {
            log_message('info', '[Webhook] Order ' . $orderId . ' sudah PAID, abaikan.');
            return $this->response->setStatusCode(200)->setBody('OK');
        }

        // ── Update status ─────────────────────────────────────────────────────
        $newStatus = strtoupper($status);
        $extraData = [
            'callback_data'       => json_encode($payload),
            'webhook_received_at' => date('Y-m-d H:i:s'),
            'payment_via'         => $data['via'] ?? 'QRIS',
        ];

        if ($newStatus === 'PAID') {
            $extraData['paid_at'] = $data['payment_date'] ?? date('Y-m-d H:i:s');
        }

        $this->paymentModel->updateStatusSafe($orderId, $newStatus, $extraData);

        log_message('info', '[Webhook] Order ' . $orderId . ' diupdate ke status: ' . $newStatus);

        // Wajib response HTTP 200
        return $this->response->setStatusCode(200)->setBody('OK');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // RIWAYAT (OPSIONAL - untuk user login)
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Riwayat transaksi user
     */
    public function history()
    {
        if (!session()->has('user_id')) {
            return redirect()->to(base_url('auth/login'));
        }

        $userId   = session()->get('user_id');
        $payments = $this->paymentModel->getByUserId($userId);

        $data = [
            'title'    => 'Riwayat Pembayaran — SawitSmart',
            'payments' => $payments,
        ];

        return view('payment/history', $data);
    }
}
