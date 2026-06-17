<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="mb-2">SIM Koperasi</h1>
        <p class="lead">Platform Manajemen Koperasi Terintegrasi untuk Petani Sawit</p>
    </div>
</section>

<!-- Product Overview -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Kelola Koperasi dengan Lebih Efisien</h2>
                <p class="lead text-muted mb-4">
                    SIM Koperasi adalah platform digital komprehensif yang dirancang untuk memudahkan manajemen koperasi pertanian. Dari pengelolaan anggota, transaksi, distribusi, hingga kemitraan petani, semua dapat dikelola dalam satu sistem terintegrasi yang mudah digunakan.
                </p>
                
                <h5 class="fw-bold mt-5 mb-3">Keunggulan Utama:</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Manajemen Anggota</strong> - Database anggota lengkap dengan riwayat transaksi
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Pencatatan Transaksi</strong> - Sistem pencatatan yang akurat dan transparan
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Manajemen Distribusi</strong> - Pantau alur distribusi produk secara real-time
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Laporan Keuangan</strong> - Laporan detail yang akurat untuk manajemen keuangan
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Kemitraan Petani</strong> - Sistem kerjasama yang terstruktur dan saling menguntungkan
                    </li>
                </ul>

                <div class="mt-5">
                    <a href="<?= base_url('kontak') ?>" class="btn btn-success btn-lg me-3">
                        <i class="fas fa-envelope me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="<?= base_url('assets/images/sim-koperasi-feature.svg') ?>" alt="Fitur SIM Koperasi" class="img-fluid rounded-3 shadow">
            </div>
        </div>
    </div>
</section>

<!-- Features in Detail -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="fw-bold mb-5 text-center">Fitur-Fitur Unggulan</h3>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-users-cog fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Manajemen Anggota</h5>
                    <p class="text-muted">Kelola data anggota koperasi lengkap dengan profil, kontribusi, dan riwayat transaksi.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-exchange-alt fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Pencatatan Transaksi</h5>
                    <p class="text-muted">Catat semua transaksi koperasi dengan detail dan transparansi penuh untuk audit trail.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-truck fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Manajemen Distribusi</h5>
                    <p class="text-muted">Pantau alur distribusi produk dari pabrik hingga ke tangan konsumen secara real-time.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-calculator fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Laporan Keuangan</h5>
                    <p class="text-muted">Buat laporan keuangan yang detail untuk transparansi dan pengambilan keputusan strategis.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-handshake fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Kemitraan Petani</h5>
                    <p class="text-muted">Kelola hubungan kemitraan dengan petani dengan syarat dan benefit yang jelas.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-mobile-alt fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Akses Mobile</h5>
                    <p class="text-muted">Akses SIM Koperasi dari perangkat mobile untuk kemudahan manajemen di lapangan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing / CTA -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h3 class="fw-bold mb-4">Paket Berlangganan</h3>
                <div class="pricing-table">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Paket Dasar</strong></td>
                                <td class="text-end">Rp 750.000/bulan</td>
                            </tr>
                            <tr>
                                <td><strong>Paket Profesional</strong></td>
                                <td class="text-end">Rp 1.500.000/bulan</td>
                            </tr>
                            <tr>
                                <td><strong>Paket Enterprise</strong></td>
                                <td class="text-end">Hubungi Kami</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="text-muted mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Semua paket dilengkapi dengan trial 30 hari gratis, dukungan pelanggan, dan update rutin.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="bg-light p-5 rounded-3 text-center">
                    <h4 class="fw-bold mb-4">Hubungi Tim Penjualan Kami</h4>
                    <p class="text-muted mb-4">
                        Dapatkan demo eksklusif dan konsultasi gratis tentang bagaimana SIM Koperasi dapat meningkatkan efisiensi koperasi Anda.
                    </p>
                    <a href="<?= base_url('kontak') ?>" class="btn btn-success btn-lg">
                        <i class="fas fa-envelope me-2"></i>Hubungi Sales
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
