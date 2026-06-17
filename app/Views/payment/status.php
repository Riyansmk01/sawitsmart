<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$status     = $payment['status'];
$isPaid     = in_array($status, ['PAID', 'SUCCESS']);
$isPending  = $status === 'PENDING';
$isExpired  = $status === 'EXPIRED';
?>

<style>
.status-page {
    min-height: 80vh;
    background: #0a0a0a;
    padding: 4rem 0;
}
.status-card {
    background: #111827;
    border-radius: 24px;
    border: 1px solid rgba(255,255,255,0.08);
    padding: 2.5rem;
    max-width: 500px;
    margin: 0 auto;
}
.status-icon { font-size: 4rem; margin-bottom: 1rem; }
.info-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    font-size: 0.9rem;
}
.info-row:last-child { border-bottom: none; }
.info-label { color: #64748b; }
.info-value { color: #f1f5f9; font-weight: 600; }
.status-badge-lg {
    display: inline-flex; align-items: center; gap: 0.5rem;
    padding: 0.5rem 1.2rem; border-radius: 999px;
    font-size: 0.9rem; font-weight: 700;
}
.qris-section {
    background: #fff;
    border-radius: 16px;
    padding: 1.2rem;
    text-align: center;
    margin: 1.5rem 0;
}
.qris-section img { max-width: 220px; height: auto; }
.btn-action {
    display: block; width: 100%; padding: 0.9rem;
    border-radius: 14px; font-weight: 700; font-size: 0.95rem;
    text-align: center; text-decoration: none;
    border: none; cursor: pointer;
    transition: opacity 0.2s, transform 0.2s;
    margin-top: 0.75rem;
}
.btn-action:hover { opacity: 0.88; transform: scale(1.01); }
.btn-primary-g { background: linear-gradient(135deg, #4ade80, #22d3ee); color: #000; }
.btn-outline-g { background: transparent; border: 2px solid rgba(74,222,128,0.4); color: #4ade80; }

.poll-indicator {
    display: flex; align-items: center; gap: 0.5rem;
    justify-content: center; color: #475569; font-size: 0.82rem;
    margin-top: 1rem;
}
.pulse-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: #4ade80;
    animation: pulse 1.5s ease-in-out infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.4; transform: scale(0.7); }
}
</style>

<section class="status-page">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb" style="background:transparent; padding:0; font-size:0.85rem;">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>" style="color:#4ade80;">Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('payment/checkout') ?>" style="color:#4ade80;">Berlangganan</a></li>
                <li class="breadcrumb-item active" style="color:#64748b;">Status Pembayaran</li>
            </ol>
        </nav>

        <div class="status-card">
            <!-- Icon & Heading -->
            <div class="text-center mb-4">
                <?php if ($isPaid): ?>
                    <div class="status-icon">✅</div>
                    <h2 style="color:#4ade80; font-weight:800;">Pembayaran Berhasil!</h2>
                    <p style="color:#94a3b8;">Terima kasih, langganan Anda telah aktif.</p>
                    <span class="status-badge-lg" style="background:rgba(74,222,128,0.15);color:#4ade80;border:1px solid rgba(74,222,128,0.3);">
                        <i class="fas fa-check-circle"></i> LUNAS
                    </span>

                <?php elseif ($isPending): ?>
                    <div class="status-icon">⏳</div>
                    <h2 style="color:#fbbf24; font-weight:800;">Menunggu Pembayaran</h2>
                    <p style="color:#94a3b8;">Scan QR di bawah atau buka link pembayaran.</p>
                    <span class="status-badge-lg" style="background:rgba(251,191,36,0.15);color:#fbbf24;border:1px solid rgba(251,191,36,0.3);">
                        <i class="fas fa-clock"></i> PENDING
                    </span>

                <?php else: ?>
                    <div class="status-icon">⌛</div>
                    <h2 style="color:#ef4444; font-weight:800;">QR Kadaluarsa</h2>
                    <p style="color:#94a3b8;">Waktu pembayaran habis.</p>
                    <span class="status-badge-lg" style="background:rgba(239,68,68,0.15);color:#ef4444;border:1px solid rgba(239,68,68,0.3);">
                        <i class="fas fa-times-circle"></i> EXPIRED
                    </span>
                <?php endif; ?>
            </div>

            <!-- Detail Transaksi -->
            <div class="mb-3">
                <div class="info-row">
                    <span class="info-label">Order ID</span>
                    <span class="info-value" style="font-size:0.8rem; font-family:monospace;"><?= esc($payment['order_id']) ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nominal</span>
                    <span class="info-value">Rp <?= number_format($payment['amount'], 0, ',', '.') ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Total Bayar (unik)</span>
                    <span class="info-value" style="color:#4ade80;">
                        Rp <?= number_format($payment['total_amount'] ?? $payment['amount'], 0, ',', '.') ?>
                    </span>
                </div>
                <?php if ($payment['keterangan']): ?>
                <div class="info-row">
                    <span class="info-label">Keterangan</span>
                    <span class="info-value"><?= esc($payment['keterangan']) ?></span>
                </div>
                <?php endif; ?>
                <?php if ($payment['expired_at']): ?>
                <div class="info-row">
                    <span class="info-label">Berlaku Hingga</span>
                    <span class="info-value" style="color:<?= $isExpired ? '#ef4444' : '#f1f5f9' ?>;">
                        <?= $payment['expired_at'] ?>
                    </span>
                </div>
                <?php endif; ?>
                <?php if ($payment['paid_at']): ?>
                <div class="info-row">
                    <span class="info-label">Tanggal Bayar</span>
                    <span class="info-value"><?= $payment['paid_at'] ?></span>
                </div>
                <?php endif; ?>
            </div>

            <!-- QR Code (hanya saat PENDING) -->
            <?php if ($isPending && $payment['qris_url']): ?>
            <div class="qris-section">
                <p style="color:#374151; font-size:0.82rem; margin-bottom:0.75rem; font-weight:600;">
                    <i class="fas fa-qrcode me-1" style="color:#059669;"></i> Scan QR dengan aplikasi m-banking Anda
                </p>
                <img src="<?= esc($payment['qris_url']) ?>" alt="QRIS <?= esc($payment['order_id']) ?>" id="qrisImage">
            </div>
            <?php endif; ?>

            <!-- Actions -->
            <?php if ($isPaid): ?>
                <a href="<?= base_url('dashboard') ?>" class="btn-action btn-primary-g">
                    <i class="fas fa-chart-line me-2"></i>Pergi ke Dashboard
                </a>
            <?php elseif ($isPending): ?>
                <?php if ($payment['direct_url']): ?>
                <a href="<?= esc($payment['direct_url']) ?>" target="_blank" rel="noopener" class="btn-action btn-primary-g">
                    <i class="fas fa-external-link-alt me-2"></i>Buka Halaman Pembayaran
                </a>
                <?php endif; ?>
                <div class="poll-indicator">
                    <div class="pulse-dot"></div>
                    Otomatis memeriksa status setiap 5 detik
                </div>
            <?php else: ?>
                <a href="<?= base_url('payment/checkout') ?>" class="btn-action btn-primary-g">
                    <i class="fas fa-redo me-2"></i>Buat Transaksi Baru
                </a>
            <?php endif; ?>

            <a href="<?= base_url('payment/history') ?>" class="btn-action btn-outline-g">
                <i class="fas fa-history me-2"></i>Riwayat Pembayaran
            </a>
        </div>
    </div>
</section>

<?php if ($isPending): ?>
<script>
(function() {
    const orderId = '<?= esc($payment['order_id'], 'js') ?>';
    let count = 0;

    const timer = setInterval(async () => {
        count++;
        if (count > 72) { clearInterval(timer); return; } // 6 menit max

        try {
            const res  = await fetch('<?= base_url('payment/check-status') ?>/' + orderId);
            const json = await res.json();

            if (!json.success) return;

            if (json.status === 'PAID' || json.status === 'SUCCESS') {
                clearInterval(timer);
                window.location.reload();
            } else if (json.status === 'EXPIRED') {
                clearInterval(timer);
                window.location.reload();
            }
        } catch(e) { /* silent fail */ }
    }, 5000);
})();
</script>
<?php endif; ?>

<?= $this->endSection() ?>
