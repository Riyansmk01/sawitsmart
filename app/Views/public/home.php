<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Hero -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="hero-badge">
                    <i class="fas fa-leaf"></i> Platform Digital Sawit Indonesia
                </div>
                <h1>Manajemen Sawit Lebih Mudah & Efisien</h1>
                <p class="lead">Meningkatkan produktivitas perkebunan Anda dengan teknologi digital terintegrasi</p>
                <p>
                    SawitSmart membantu koperasi dan petani sawit mengelola operasional, memantau produksi, dan mengambil keputusan berbasis data — semua dalam satu platform.
                </p>
                <div class="d-flex gap-3 flex-wrap mt-4">
                    <a href="<?= base_url('auth/register') ?>" class="btn btn-success btn-lg">
                        <i class="fas fa-rocket me-2"></i>Mulai Gratis
                    </a>
                    <a href="#fitur" class="btn btn-outline-success btn-lg" style="border-color: rgba(255,255,255,0.3); color: white;">
                        <i class="fas fa-arrow-down me-2"></i>Jelajahi Fitur
                    </a>
                </div>
                <div class="ss-stats">
                    <div class="ss-stat">
                        <strong>500+</strong>
                        <span>Hektar Terkelola</span>
                    </div>
                    <div class="ss-stat">
                        <strong>24/7</strong>
                        <span>Monitoring Data</span>
                    </div>
                    <div class="ss-stat">
                        <strong>100%</strong>
                        <span>Berbasis Web</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-visual">
                    <i class="fas fa-seedling"></i>
                    <p class="mt-3 mb-0" style="color: rgba(255,255,255,0.6); font-size: 0.9rem;">Dashboard Manajemen Kebun Sawit</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fitur -->
<section class="ss-section ss-section-alt" id="fitur">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-3">
                <div class="ss-sidebar-card">
                    <h6><i class="fas fa-building me-2"></i>Tentang Kami</h6>
                    <p class="mb-4">Inisiatif Universitas Jambi untuk digitalisasi industri pertanian sawit Indonesia.</p>
                    <h6><i class="fas fa-phone me-2"></i>Hubungi Kami</h6>
                    <p class="mb-1"><strong>Universitas Jambi</strong></p>
                    <p class="mb-1"><a href="tel:085268041096" class="text-decoration-none text-dark">0852-6804-1096</a></p>
                    <p class="mb-0"><a href="mailto:admin@sawitsmart.com" class="text-decoration-none text-dark">admin@sawitsmart.com</a></p>
                </div>
            </div>
            <div class="col-lg-9">
                <span class="section-label">Solusi Kami</span>
                <h2>Apa yang Kami Sediakan</h2>
                <p class="mb-5">Platform lengkap untuk setiap aspek manajemen kebun sawit modern.</p>
                <div class="row g-4">
                    <?php foreach ($features as $feature): ?>
                    <div class="col-md-4">
                        <div class="ss-card text-center">
                            <div class="ss-card-icon mx-auto">
                                <i class="fas <?= $feature['icon'] ?>"></i>
                            </div>
                            <h5><?= $feature['title'] ?></h5>
                            <p><?= $feature['desc'] ?></p>
                            <a href="<?= $feature['link'] ?>" class="btn btn-outline-success w-100">
                                Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Produk -->
<section class="ss-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label">Produk</span>
            <h2>Solusi Terintegrasi untuk Petani & Koperasi</h2>
            <p class="lead mx-auto" style="max-width: 600px;">Teknologi terdepan untuk meningkatkan efisiensi dan produktivitas perkebunan sawit Anda.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="ss-card">
                    <div class="ss-card-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h5>SIM Sawit</h5>
                    <p>Sistem informasi manajemen kebun sawit berbasis digital dengan monitoring real-time.</p>
                    <a href="<?= base_url('produk/sim-sawit') ?>" class="btn btn-outline-success w-100">
                        Buka Aplikasi <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ss-card">
                    <div class="ss-card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5>SIM Koperasi</h5>
                    <p>Platform manajemen koperasi untuk transaksi, distribusi, dan kemitraan petani.</p>
                    <a href="<?= base_url('produk/sim-koperasi') ?>" class="btn btn-outline-success w-100">
                        Buka Aplikasi <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ss-card">
                    <div class="ss-card-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5>Laporan & Analitik</h5>
                    <p>Dashboard komprehensif untuk analisis kinerja kebun dan strategi bisnis.</p>
                    <a href="<?= base_url('produk/analytics') ?>" class="btn btn-outline-success w-100">
                        Jelajahi <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="ss-section ss-section-dark text-center">
    <div class="container">
        <h2>Siap Meningkatkan Produktivitas Kebun Anda?</h2>
        <p class="lead mb-4">Bergabunglah dengan petani dan koperasi yang telah mempercayai SawitSmart.</p>
        <a href="<?= base_url('auth/register') ?>" class="btn btn-success btn-lg">
            <i class="fas fa-check-circle me-2"></i>Daftar Sekarang
        </a>
    </div>
</section>

<?= $this->endSection() ?>
