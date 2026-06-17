<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="mb-2">Produk & Layanan Kami</h1>
        <p class="lead">Platform terintegrasi untuk meningkatkan efisiensi dan produktivitas pertanian sawit</p>
    </div>
</section>

<!-- Products Grid -->
<section class="ss-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="ss-card h-100 text-center">
                    <div class="card-body p-4 text-center">
                        <i class="fas fa-leaf fa-3x text-success mb-3"></i>
                        <h4 class="card-title fw-bold">SIM Sawit</h4>
                        <p class="card-text text-muted mb-3">
                            Sistem Informasi Manajemen berbasis web untuk kebun sawit dengan fitur monitoring real-time, pencatatan produksi, manajemen karyawan, dan laporan analitik.
                        </p>
                        <div class="mb-3">
                            <small class="text-success fw-bold">Fitur Utama:</small>
                            <ul class="text-sm text-muted mt-2">
                                <li>Monitoring Kebun Real-Time</li>
                                <li>Manajemen Produksi</li>
                                <li>Laporan Analitik</li>
                                <li>Akses Mobile</li>
                            </ul>
                        </div>
                        <a href="<?= base_url('produk/sim-sawit') ?>" class="btn btn-success">
                            Pelajari Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="ss-card h-100 text-center">
                    <div class="card-body p-4 text-center">
                        <i class="fas fa-users fa-3x text-success mb-3"></i>
                        <h4 class="card-title fw-bold">SIM Koperasi</h4>
                        <p class="card-text text-muted mb-3">
                            Platform manajemen koperasi untuk pengelolaan anggota, transaksi, distribusi, dan kemitraan petani dengan fitur terintegrasi.
                        </p>
                        <div class="mb-3">
                            <small class="text-success fw-bold">Fitur Utama:</small>
                            <ul class="text-sm text-muted mt-2">
                                <li>Manajemen Anggota</li>
                                <li>Pencatatan Transaksi</li>
                                <li>Manajemen Distribusi</li>
                                <li>Laporan Keuangan</li>
                            </ul>
                        </div>
                        <a href="<?= base_url('produk/sim-koperasi') ?>" class="btn btn-success">
                            Pelajari Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="ss-card h-100 text-center">
                    <div class="card-body p-4 text-center">
                        <i class="fas fa-chart-line fa-3x text-success mb-3"></i>
                        <h4 class="card-title fw-bold">Laporan & Analitik</h4>
                        <p class="card-text text-muted mb-3">
                            Dashboard komprehensif untuk analisis kinerja kebun, analisis trend produksi, dan strategi pengembangan bisnis.
                        </p>
                        <div class="mb-3">
                            <small class="text-success fw-bold">Fitur Utama:</small>
                            <ul class="text-sm text-muted mt-2">
                                <li>Dashboard Interaktif</li>
                                <li>Analisis Trend</li>
                                <li>Visualisasi Data</li>
                                <li>Export Laporan</li>
                            </ul>
                        </div>
                        <a href="<?= base_url('produk/analytics') ?>" class="btn btn-success">
                            Pelajari Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="ss-section ss-section-alt text-center">
    <div class="container text-center">
        <h3 class="fw-bold mb-3">Ingin Mencoba Sekarang?</h3>
        <p class="lead text-muted mb-4">Hubungi tim kami untuk demo gratis atau mulai trial 30 hari.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="<?= base_url('kontak') ?>" class="btn btn-success btn-lg">
                <i class="fas fa-envelope me-2"></i>Hubungi Kami
            </a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
