<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table            = 'payments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'order_id',
        'user_id',
        'amount',
        'total_amount',
        'keterangan',
        'status',
        'direct_url',
        'qris_url',
        'signature',
        'expired_at',
        'paid_at',
        'webhook_received_at',
        'payment_via',
        'callback_data',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    /**
     * Ambil transaksi berdasarkan order_id
     */
    public function getByOrderId(string $orderId): ?array
    {
        return $this->where('order_id', $orderId)->first();
    }

    /**
     * Ambil semua transaksi milik user tertentu
     */
    public function getByUserId(int $userId, int $limit = 20, int $offset = 0): array
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Ambil transaksi PENDING yang sudah kadaluarsa
     */
    public function getExpiredPending(): array
    {
        return $this->where('status', 'PENDING')
                    ->where('expired_at <', date('Y-m-d H:i:s'))
                    ->findAll();
    }

    /**
     * Update status transaksi secara aman (cek duplikat webhook)
     */
    public function updateStatusSafe(string $orderId, string $newStatus, array $extraData = []): bool
    {
        $payment = $this->getByOrderId($orderId);

        if (!$payment) {
            return false;
        }

        // Hindari update jika sudah PAID/SUCCESS
        if (in_array($payment['status'], ['PAID', 'SUCCESS'])) {
            return false;
        }

        $updateData = array_merge(['status' => $newStatus], $extraData);

        return $this->update($payment['id'], $updateData);
    }

    /**
     * Generate order_id unik
     */
    public static function generateOrderId(string $prefix = 'INV'): string
    {
        return $prefix . '-' . strtoupper(uniqid()) . '-' . date('ymdHis');
    }

    /**
     * Statistik pembayaran
     */
    public function getStats(): array
    {
        $total   = $this->countAll();
        $paid    = $this->where('status', 'PAID')->countAllResults(false);
        $pending = $this->where('status', 'PENDING')->countAllResults(false);
        $expired = $this->where('status', 'EXPIRED')->countAllResults(false);

        $totalRevenue = $this->selectSum('total_amount')
                             ->where('status', 'PAID')
                             ->first();

        return [
            'total'         => $total,
            'paid'          => $paid,
            'pending'       => $pending,
            'expired'       => $expired,
            'total_revenue' => $totalRevenue['total_amount'] ?? 0,
        ];
    }
}
