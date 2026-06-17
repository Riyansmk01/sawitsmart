<?php

namespace App\Libraries;

/**
 * KlikQris Library
 * Integrasi Payment Gateway KlikQRIS.com v2.0
 */
class KlikQris
{
    protected string $apiKey;
    protected string $merchantId;
    protected string $baseUrl = 'https://klikqris.com/api/qrisv2';

    public function __construct()
    {
        $this->apiKey     = env('KLIKQRIS_API_KEY', '');
        $this->merchantId = env('KLIKQRIS_MERCHANT_ID', '');
    }

    /**
     * Buat transaksi QRIS baru
     */
    public function createTransaction(string $orderId, int $amount, string $keterangan = ''): array
    {
        $payload = [
            'order_id'    => $orderId,
            'id_merchant' => $this->merchantId,
            'amount'      => $amount,
            'keterangan'  => $keterangan,
        ];

        $response = $this->request('POST', '/create', $payload);

        return $response;
    }

    /**
     * Cek status transaksi
     */
    public function checkStatus(string $orderId): array
    {
        $url = "/status/{$this->merchantId}/{$orderId}";
        return $this->request('GET', $url);
    }

    /**
     * Validasi signature webhook (Double Security)
     * Bandingkan signature dari webhook dengan signature saat create transaksi
     */
    public function validateSignature(string $receivedSignature, string $storedSignature): bool
    {
        if (empty($receivedSignature) || empty($storedSignature)) {
            return false;
        }

        return hash_equals($storedSignature, $receivedSignature);
    }

    /**
     * HTTP Request ke API KlikQRIS
     */
    protected function request(string $method, string $endpoint, array $body = []): array
    {
        $curl = curl_init();

        $headers = [
            'Content-Type: application/json',
            'x-api-key: ' . $this->apiKey,
            'id_merchant: ' . $this->merchantId,
        ];

        $options = [
            CURLOPT_URL            => $this->baseUrl . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => true,
        ];

        if ($method === 'POST' && !empty($body)) {
            $options[CURLOPT_POSTFIELDS] = json_encode($body);
        }

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error    = curl_error($curl);
        curl_close($curl);

        if ($error) {
            log_message('error', '[KlikQRIS] cURL Error: ' . $error);
            return [
                'status'  => false,
                'message' => 'Connection error: ' . $error,
            ];
        }

        $decoded = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', '[KlikQRIS] JSON Decode Error. Response: ' . $response);
            return [
                'status'  => false,
                'message' => 'Invalid response from payment gateway',
            ];
        }

        log_message('info', '[KlikQRIS] ' . $method . ' ' . $endpoint . ' -> HTTP ' . $httpCode);

        return $decoded;
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }
}
