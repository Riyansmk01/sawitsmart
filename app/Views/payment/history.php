<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.history-page { min-height: 80vh; background: #0a0a0a; padding: 3rem 0; }
.history-header { margin-bottom: 2rem; }
.history-header h1 { font-size: 2rem; font-weight: 800; color: #f1f5f9; }
.history-header p  { color: #64748b; }
.tx-card {
    background: #111827;
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 16px;
    padding: 1.25rem 1.5rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: border-color 0.2s;
}
.tx-card:hover { border-color: rgba(74,222,128,0.25); }
.tx-icon {
    width: 44px; height: 44px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.15rem; flex-shrink: 0;
}
.tx-body { flex: 1; min-width: 0; }
.tx-order { font-size: 0.78rem; font-family: monospace; color: #64748b; }
.tx-desc  { font-size: 0.95rem; color: #e2e8f0; font-weight: 600; margin-bottom: 0.1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.tx-date  { font-size: 0.78rem; color: #475569; }
.tx-right { text-align: right; flex-shrink: 0; }
.tx-amount { font-size: 1.05rem; font-weight: 700; color: #f1f5f9; }
.tx-status {
    display: inline-flex; align-items: center; gap: 0.3rem;
    padding: 0.2rem 0.65rem; border-radius: 999px;
    font-size: 0.72rem; font-weight: 600; margin-top: 0.3rem;
}
.s-paid    { background: rgba(74,222,128,0.15); color: #4ade80; }
.s-pending { background: rgba(251,191,36,0.15); color: #fbbf24; }
.s-expired { background: rgba(239,68,68,0.15);  color: #ef4444; }
.empty-state { text-align: center; padding: 4rem; }
.empty-state i { font-size: 3rem; color: #1e293b; margin-bottom: 1rem; }
.empty-state p { color: #475569; }
</style>

<section class="history-page">
    <div class="container">
        <div class="history-header d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h1><i class="fas fa-history me-2" style="color:#4ade80;"></i>Riwayat Pembayaran</h1>
                <p>Semua riwayat transaksi QRIS Anda.</p>
            </div>
            <a href="<?= base_url('payment/checkout') ?>" class="btn btn-sm" style="background:linear-gradient(135deg,#4ade80,#22d3ee);color:#000;font-weight:700;border-radius:10px;padding:0.5rem 1.2rem;">
                <i class="fas fa-plus me-1"></i> Berlangganan Baru
            </a>
        </div>

        <?php if (empty($payments)): ?>
        <div class="empty-state">
            <i class="fas fa-receipt"></i>
            <p>Belum ada transaksi.</p>
            <a href="<?= base_url('payment/checkout') ?>" style="color:#4ade80;">Mulai berlangganan sekarang →</a>
        </div>
        <?php else: ?>
            <?php foreach ($payments as $p): ?>
            <?php
                $st     = $p['status'];
                $isPaid = in_array($st, ['PAID', 'SUCCESS']);
                $isExp  = $st === 'EXPIRED';
                $iconBg = $isPaid ? 'rgba(74,222,128,0.15)' : ($isExp ? 'rgba(239,68,68,0.1)' : 'rgba(251,191,36,0.1)');
                $iconCl = $isPaid ? '#4ade80' : ($isExp ? '#ef4444' : '#fbbf24');
                $iconFa = $isPaid ? 'fa-check-circle' : ($isExp ? 'fa-times-circle' : 'fa-clock');
            ?>
            <a href="<?= base_url('payment/status/' . esc($p['order_id'])) ?>" class="text-decoration-none">
                <div class="tx-card">
                    <div class="tx-icon" style="background:<?= $iconBg ?>;">
                        <i class="fas <?= $iconFa ?>" style="color:<?= $iconCl ?>;"></i>
                    </div>
                    <div class="tx-body">
                        <div class="tx-desc"><?= esc($p['keterangan'] ?: 'Pembayaran SawitSmart') ?></div>
                        <div class="tx-order"><?= esc($p['order_id']) ?></div>
                        <div class="tx-date"><?= $p['created_at'] ?></div>
                    </div>
                    <div class="tx-right">
                        <div class="tx-amount">Rp <?= number_format($p['total_amount'] ?? $p['amount'], 0, ',', '.') ?></div>
                        <div>
                            <span class="tx-status s-<?= strtolower($st === 'SUCCESS' ? 'paid' : $st) ?>">
                                <?= $st ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
