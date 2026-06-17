<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="mb-2">SIM Sawit</h1>
        <p class="lead">Sistem Informasi Manajemen Kebun Sawit Berbasis Digital</p>
    </div>
</section>

<!-- Product Overview -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Transformasi Manajemen Kebun Anda</h2>
                <p class="lead text-muted mb-4">
                    SIM Sawit adalah platform terintegrasi yang dirancang khusus untuk memenuhi kebutuhan manajemen perkebunan sawit di era digital. Dengan antarmuka yang user-friendly dan fitur-fitur canggih, SIM Sawit membantu Anda meningkatkan efisiensi operasional, produktivitas, dan profitabilitas kebun.
                </p>
                
                <h5 class="fw-bold mt-5 mb-3">Keunggulan Utama:</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Berbasis Web & Mobile</strong> - Akses dari mana saja kapan saja
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>User-Friendly</strong> - Mudah digunakan tanpa pelatihan teknis rumit
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Real-Time Monitoring</strong> - Pantau kondisi kebun secara real-time
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Analitik Komprehensif</strong> - Dashboard dengan visualisasi data yang mudah dipahami
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Laporan Detail</strong> - Laporan produksi, kualitas, dan finansial
                    </li>
                </ul>

                <div class="mt-5">
                    <a href="<?= base_url('kontak') ?>" class="btn btn-success btn-lg me-3">
                        <i class="fas fa-envelope me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="<?= base_url('assets/images/sim-sawit-feature.svg') ?>" alt="Fitur SIM Sawit" class="img-fluid rounded-3 shadow">
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
                    <i class="fas fa-map-location-dot fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Monitoring Kebun</h5>
                    <p class="text-muted">Pantau kondisi kebun secara real-time dengan data lokasi dan kondisi lapangan yang akurat.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-tasks fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Manajemen Produksi</h5>
                    <p class="text-muted">Kelola data produksi, panen, dan pengolahan dengan sistem yang terstruktur dan efisien.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-users fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Manajemen Tim</h5>
                    <p class="text-muted">Kelola data karyawan, jadwal kerja, dan pengupahan dengan mudah dalam satu platform.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-chart-bar fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Laporan Analitik</h5>
                    <p class="text-muted">Dapatkan insights mendalam tentang performa kebun melalui dashboard yang intuitif.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-mobile-alt fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Akses Mobile</h5>
                    <p class="text-muted">Aplikasi mobile tersedia untuk iOS dan Android agar lebih fleksibel di lapangan.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-lock fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Keamanan Terjamin</h5>
                    <p class="text-muted">Data Anda dilindungi dengan enkripsi tingkat enterprise dan backup otomatis.</p>
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
                                <td class="text-end">Rp 500.000/bulan</td>
                            </tr>
                            <tr>
                                <td><strong>Paket Profesional</strong></td>
                                <td class="text-end">Rp 1.000.000/bulan</td>
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
                        Dapatkan penawaran spesial dan konsultasi gratis tentang bagaimana SIM Sawit dapat membantu bisnis Anda.
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
