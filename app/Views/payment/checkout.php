<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
/* ── Payment Checkout Page ── */
.checkout-hero {
    background: linear-gradient(135deg, #0a0a0a 0%, #111827 50%, #0d1f0d 100%);
    padding: 5rem 0 3rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.checkout-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 80% 50% at 50% 0%, rgba(74,222,128,0.12) 0%, transparent 70%);
    pointer-events: none;
}
.checkout-hero h1 {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 800;
    background: linear-gradient(135deg, #4ade80, #22d3ee);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
}
.checkout-hero p {
    color: #94a3b8;
    font-size: 1.15rem;
    max-width: 540px;
    margin: 0 auto;
}
/* Badge populer */
.badge-popular {
    display: inline-block;
    background: linear-gradient(135deg, #4ade80, #22d3ee);
    color: #000;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    padding: 0.2rem 0.7rem;
    border-radius: 999px;
    text-transform: uppercase;
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
}
/* Cards */
.pricing-section { padding: 4rem 0 6rem; background: #0a0a0a; }
.pricing-card {
    background: #111827;
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 20px;
    padding: 2.5rem 2rem;
    transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.pricing-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 60px rgba(74,222,128,0.12);
    border-color: rgba(74,222,128,0.35);
}
.pricing-card.popular {
    border-color: rgba(74,222,128,0.5);
    box-shadow: 0 0 40px rgba(74,222,128,0.08);
}
.plan-icon {
    width: 56px; height: 56px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem;
    margin-bottom: 1.2rem;
}
.plan-name {
    font-size: 1.25rem;
    font-weight: 700;
    color: #f1f5f9;
    margin-bottom: 0.4rem;
}
.plan-desc { color: #64748b; font-size: 0.9rem; margin-bottom: 1.5rem; }
.plan-price {
    font-size: 2.4rem;
    font-weight: 800;
    color: #f1f5f9;
    margin-bottom: 0.2rem;
    line-height: 1;
}
.plan-price span { font-size: 1rem; font-weight: 400; color: #64748b; }
.plan-features {
    list-style: none;
    padding: 0;
    margin: 1.5rem 0 2rem;
    flex: 1;
}
.plan-features li {
    padding: 0.45rem 0;
    color: #94a3b8;
    font-size: 0.92rem;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
.plan-features li i { color: #4ade80; flex-shrink: 0; }
.btn-choose {
    width: 100%;
    padding: 0.85rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.95rem;
    border: none;
    cursor: pointer;
    transition: all 0.25s ease;
    letter-spacing: 0.02em;
}
.btn-choose-primary {
    background: linear-gradient(135deg, #4ade80, #22d3ee);
    color: #000;
}
.btn-choose-primary:hover { transform: scale(1.02); opacity: 0.9; }
.btn-choose-outline {
    background: transparent;
    color: #4ade80;
    border: 2px solid rgba(74,222,128,0.4);
}
.btn-choose-outline:hover {
    background: rgba(74,222,128,0.08);
    border-color: #4ade80;
}

/* Modal QRIS */
.modal-payment {
    display: none; position: fixed; inset: 0; z-index: 9999;
    background: rgba(0,0,0,0.75);
    backdrop-filter: blur(8px);
    align-items: center; justify-content: center;
}
.modal-payment.active { display: flex; }
.modal-payment-box {
    background: #111827;
    border: 1px solid rgba(74,222,128,0.25);
    border-radius: 24px;
    padding: 2.5rem;
    max-width: 440px;
    width: 90%;
    text-align: center;
    position: relative;
    animation: modalIn 0.35s cubic-bezier(0.34,1.56,0.64,1);
}
@keyframes modalIn {
    from { opacity: 0; transform: scale(0.85) translateY(20px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}
.modal-close-btn {
    position: absolute; top: 1rem; right: 1rem;
    background: rgba(255,255,255,0.08);
    border: none; border-radius: 8px;
    width: 32px; height: 32px;
    color: #fff; cursor: pointer; font-size: 1rem;
    display: flex; align-items: center; justify-content: center;
    transition: background 0.2s;
}
.modal-close-btn:hover { background: rgba(255,255,255,0.15); }
.qris-amount {
    font-size: 2rem; font-weight: 800;
    background: linear-gradient(135deg, #4ade80, #22d3ee);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    margin: 0.5rem 0;
}
.qris-img-wrap {
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    display: inline-block;
    padding: 1rem;
    margin: 1.2rem 0;
    box-shadow: 0 8px 32px rgba(74,222,128,0.15);
}
.qris-img-wrap img { width: 200px; height: 200px; object-fit: contain; }
.status-badge {
    display: inline-flex; align-items: center; gap: 0.4rem;
    padding: 0.3rem 0.9rem; border-radius: 999px;
    font-size: 0.8rem; font-weight: 600; margin: 0.5rem 0;
}
.status-pending  { background: rgba(251,191,36,0.15); color: #fbbf24; border: 1px solid rgba(251,191,36,0.3); }
.status-paid     { background: rgba(74,222,128,0.15); color: #4ade80; border: 1px solid rgba(74,222,128,0.3); }
.status-expired  { background: rgba(239,68,68,0.15);  color: #ef4444; border: 1px solid rgba(239,68,68,0.3); }
.expired-info { color: #64748b; font-size: 0.82rem; margin-top: 0.4rem; }
.btn-direct-pay {
    display: block; margin-top: 1rem;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #4ade80, #22d3ee);
    color: #000; border: none; border-radius: 12px;
    font-weight: 700; font-size: 0.92rem;
    text-decoration: none; cursor: pointer;
    transition: opacity 0.2s, transform 0.2s;
}
.btn-direct-pay:hover { opacity: 0.9; transform: scale(1.02); color: #000; }
.spinner {
    width: 28px; height: 28px;
    border: 3px solid rgba(74,222,128,0.2);
    border-top-color: #4ade80;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin: 1rem auto;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* Guarantee strip */
.guarantee-strip {
    background: #0d1f0d;
    border-top: 1px solid rgba(74,222,128,0.12);
    border-bottom: 1px solid rgba(74,222,128,0.12);
    padding: 1.5rem 0;
}
.guarantee-strip .item {
    display: flex; align-items: center; gap: 0.6rem;
    color: #94a3b8; font-size: 0.88rem;
    justify-content: center;
}
.guarantee-strip .item i { color: #4ade80; font-size: 1.1rem; }
</style>

<!-- Hero -->
<section class="checkout-hero">
    <div class="container">
        <div class="mb-3">
            <span class="status-badge status-paid"><i class="fas fa-shield-alt"></i> Pembayaran Aman via QRIS</span>
        </div>
        <h1>Pilih Paket Anda</h1>
        <p>Mulai perjalanan digital kebun sawit Anda hari ini. Bayar mudah dengan QRIS, langsung aktif.</p>
    </div>
</section>

<!-- Guarantee strip -->
<div class="guarantee-strip">
    <div class="container">
        <div class="row g-3">
            <div class="col-6 col-md-3"><div class="item"><i class="fas fa-qrcode"></i> Bayar via QRIS</div></div>
            <div class="col-6 col-md-3"><div class="item"><i class="fas fa-bolt"></i> Aktivasi Instan</div></div>
            <div class="col-6 col-md-3"><div class="item"><i class="fas fa-lock"></i> Transaksi Aman</div></div>
            <div class="col-6 col-md-3"><div class="item"><i class="fas fa-headset"></i> Support 24/7</div></div>
        </div>
    </div>
</div>

<!-- Pricing Cards -->
<section class="pricing-section">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <?php foreach ($packages as $pkg): ?>
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card <?= $pkg['popular'] ? 'popular' : '' ?>">
                    <?php if ($pkg['popular']): ?>
                        <span class="badge-popular"><i class="fas fa-star me-1"></i>Paling Populer</span>
                    <?php endif; ?>

                    <div class="plan-icon" style="background: <?= $pkg['color'] ?>22;">
                        <i class="fas <?= $pkg['icon'] ?>" style="color: <?= $pkg['color'] ?>;"></i>
                    </div>

                    <div class="plan-name"><?= $pkg['name'] ?></div>
                    <div class="plan-desc"><?= $pkg['description'] ?></div>

                    <div class="plan-price">
                        Rp <?= number_format($pkg['price'], 0, ',', '.') ?>
                        <span>/ bulan</span>
                    </div>

                    <ul class="plan-features">
                        <?php foreach ($pkg['features'] as $f): ?>
                        <li><i class="fas fa-check-circle"></i> <?= $f ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <button
                        class="btn-choose <?= $pkg['popular'] ? 'btn-choose-primary' : 'btn-choose-outline' ?>"
                        onclick="startPayment(<?= $pkg['price'] ?>, '<?= esc($pkg['name']) ?>')"
                        id="btn-<?= $pkg['id'] ?>">
                        <i class="fas fa-qrcode me-2"></i>Bayar Sekarang
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Catatan kecil -->
        <div class="text-center mt-5" style="color: #475569; font-size: 0.85rem;">
            <i class="fas fa-info-circle me-1" style="color: #4ade80;"></i>
            Harga sudah termasuk kode unik QRIS. Nominal yang tertera di QR mungkin sedikit berbeda — 
            <strong style="color: #94a3b8;">gunakan nominal dari QR yang ditampilkan.</strong>
        </div>
    </div>
</section>

<!-- ══ MODAL PEMBAYARAN ════════════════════════════════════════════ -->
<div class="modal-payment" id="paymentModal" role="dialog" aria-modal="true" aria-label="Dialog Pembayaran QRIS">
    <div class="modal-payment-box">
        <button class="modal-close-btn" id="closeModal" aria-label="Tutup"><i class="fas fa-times"></i></button>

        <!-- Loading state -->
        <div id="stateLoading">
            <div class="spinner"></div>
            <p style="color:#64748b; margin-top:0.5rem;">Membuat transaksi QRIS…</p>
        </div>

        <!-- QR state -->
        <div id="stateQr" style="display:none;">
            <div style="color:#94a3b8; font-size:0.85rem; margin-bottom:0.25rem;">Total Pembayaran</div>
            <div class="qris-amount" id="modalAmount">Rp 0</div>
            <div class="status-badge status-pending" id="modalStatusBadge">
                <span class="pulse-dot"></span> Menunggu Pembayaran
            </div>
            <div class="qris-img-wrap" id="qrisImgWrap">
                <img id="qrisImg" src="" alt="QR Code Pembayaran" loading="lazy">
            </div>
            <div class="expired-info" id="modalExpiry"></div>
            <a href="#" class="btn-direct-pay" id="directPayBtn" target="_blank">
                <i class="fas fa-external-link-alt me-2"></i>Buka Halaman Pembayaran
            </a>
            <div style="color:#475569; font-size:0.78rem; margin-top:1rem;">
                <i class="fas fa-sync fa-spin me-1" style="color:#4ade80;"></i>
                Otomatis memperbarui status…
            </div>
        </div>

        <!-- Success state -->
        <div id="stateSuccess" style="display:none;">
            <div style="font-size:3.5rem; margin-bottom:1rem;">✅</div>
            <h3 style="color:#4ade80; font-weight:800;">Pembayaran Berhasil!</h3>
            <p style="color:#94a3b8;">Terima kasih! Langganan Anda telah aktif.</p>
            <a href="<?= base_url('dashboard') ?>" class="btn-direct-pay" style="display:inline-block; margin-top:1rem; text-decoration:none;">
                <i class="fas fa-chart-line me-2"></i>Ke Dashboard
            </a>
        </div>

        <!-- Expired state -->
        <div id="stateExpired" style="display:none;">
            <div style="font-size:3.5rem; margin-bottom:1rem;">⏰</div>
            <h3 style="color:#ef4444; font-weight:700;">QR Kadaluarsa</h3>
            <p style="color:#94a3b8;">Waktu pembayaran habis. Silakan buat transaksi baru.</p>
            <button onclick="closeModal()" class="btn-direct-pay" style="border:none;">
                Coba Lagi
            </button>
        </div>
    </div>
</div>

<script>
let currentOrderId = null;
let pollInterval   = null;
let pollCount      = 0;
const MAX_POLLS    = 60; // 5 menit @ 5 detik

function formatRupiah(n) {
    return 'Rp ' + parseFloat(n).toLocaleString('id-ID');
}

function showState(name) {
    ['Loading','Qr','Success','Expired'].forEach(s => {
        document.getElementById('state'+s).style.display = s === name ? 'block' : 'none';
    });
}

async function startPayment(amount, keterangan) {
    currentOrderId = null;
    stopPolling();
    document.getElementById('paymentModal').classList.add('active');
    showState('Loading');

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const fd = new FormData();
    fd.append('amount', amount);
    fd.append('keterangan', keterangan);
    fd.append(getCsrfName(), csrfToken);

    try {
        const res  = await fetch('<?= base_url('payment/create') ?>', { method:'POST', body: fd });
        const json = await res.json();

        if (!json.success) {
            alert('Gagal membuat transaksi: ' + (json.message || 'Unknown error'));
            closeModal();
            return;
        }

        currentOrderId = json.order_id;

        // Tampilkan QR
        document.getElementById('modalAmount').textContent    = formatRupiah(json.total_amount);
        document.getElementById('qrisImg').src                = json.qris_url || '';
        document.getElementById('directPayBtn').href          = json.direct_url || '#';
        document.getElementById('modalExpiry').textContent    = 'Berlaku hingga: ' + (json.expired_at || '-');
        document.getElementById('modalStatusBadge').innerHTML = '<span>⏳</span> Menunggu Pembayaran';
        document.getElementById('modalStatusBadge').className = 'status-badge status-pending';

        showState('Qr');
        startPolling();

    } catch (err) {
        console.error(err);
        alert('Terjadi kesalahan jaringan. Silakan coba lagi.');
        closeModal();
    }
}

function startPolling() {
    pollCount = 0;
    pollInterval = setInterval(async () => {
        pollCount++;
        if (!currentOrderId || pollCount > MAX_POLLS) { stopPolling(); return; }

        try {
            const res  = await fetch('<?= base_url('payment/check-status') ?>/' + currentOrderId);
            const json = await res.json();

            if (!json.success) return;

            const st = json.status;
            if (st === 'PAID' || st === 'SUCCESS') {
                stopPolling();
                showState('Success');
            } else if (st === 'EXPIRED') {
                stopPolling();
                showState('Expired');
            }
        } catch(e) { /* silent */ }
    }, 5000);
}

function stopPolling() {
    if (pollInterval) { clearInterval(pollInterval); pollInterval = null; }
}

function closeModal() {
    stopPolling();
    document.getElementById('paymentModal').classList.remove('active');
}

function getCsrfName() {
    // Ambil nama field CSRF dari cookie atau bisa di-hardcode
    return '<?= csrf_token() ?>';
}

document.getElementById('closeModal').addEventListener('click', closeModal);
document.getElementById('paymentModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
});
</script>

<?= $this->endSection() ?>
