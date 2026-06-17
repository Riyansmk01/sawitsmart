<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="mb-2">Laporan & Analitik</h1>
        <p class="lead">Dashboard Komprehensif untuk Analisis dan Keputusan Bisnis yang Lebih Baik</p>
    </div>
</section>

<!-- Product Overview -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Insight Mendalam untuk Pertumbuhan Bisnis</h2>
                <p class="lead text-muted mb-4">
                    Platform Laporan & Analitik kami menyediakan dashboard interaktif dan visualisasi data yang mudah dipahami. Analisis performa kebun, tren produksi, dan strategi bisnis dengan data real-time untuk pengambilan keputusan yang lebih akurat dan strategis.
                </p>
                
                <h5 class="fw-bold mt-5 mb-3">Keunggulan Utama:</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Dashboard Interaktif</strong> - Visualisasi data real-time yang mudah dipahami
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Analisis Trend</strong> - Pantau trend performa dari waktu ke waktu
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Visualisasi Data</strong> - Grafik dan chart untuk insight yang lebih baik
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Export Laporan</strong> - Unduh laporan dalam berbagai format (PDF, Excel, CSV)
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Customizable Reports</strong> - Buat laporan custom sesuai kebutuhan bisnis
                    </li>
                </ul>

                <div class="mt-5">
                    <a href="<?= base_url('kontak') ?>" class="btn btn-success btn-lg me-3">
                        <i class="fas fa-envelope me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="<?= base_url('assets/images/analytics-feature.svg') ?>" alt="Fitur Analytics" class="img-fluid rounded-3 shadow">
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
                    <i class="fas fa-chart-line fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Dashboard Interaktif</h5>
                    <p class="text-muted">Lihat metrik penting dalam satu dashboard dengan visualisasi yang intuitif dan mudah dipahami.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-arrow-trend-up fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Analisis Trend</h5>
                    <p class="text-muted">Pantau trend performa kebun, produksi, dan keuangan untuk identifikasi peluang dan risiko.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-chart-pie fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Visualisasi Data</h5>
                    <p class="text-muted">Grafik, chart, dan infografis untuk membuat data lebih mudah dipahami dan actionable.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-download fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Export Laporan</h5>
                    <p class="text-muted">Unduh laporan dalam format PDF, Excel, CSV untuk analisis lebih lanjut dan presentasi.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-sliders-h fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Customizable Reports</h5>
                    <p class="text-muted">Buat laporan custom sesuai kebutuhan spesifik bisnis dan parameter yang diinginkan.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-bell fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Alert & Notifikasi</h5>
                    <p class="text-muted">Terima notifikasi real-time untuk metrik penting yang memerlukan perhatian atau action.</p>
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
                                <td><strong>Paket Starter</strong></td>
                                <td class="text-end">Rp 300.000/bulan</td>
                            </tr>
                            <tr>
                                <td><strong>Paket Business</strong></td>
                                <td class="text-end">Rp 750.000/bulan</td>
                            </tr>
                            <tr>
                                <td><strong>Paket Premium</strong></td>
                                <td class="text-end">Hubungi Kami</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="text-muted mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Semua paket dilengkapi dengan trial 30 hari gratis, dukungan pelanggan 24/7, dan update fitur rutin.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="bg-light p-5 rounded-3 text-center">
                    <h4 class="fw-bold mb-4">Hubungi Tim Penjualan Kami</h4>
                    <p class="text-muted mb-4">
                        Dapatkan demo live dan konsultasi gratis tentang bagaimana platform Laporan & Analitik dapat membantu bisnis Anda membuat keputusan yang lebih baik.
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
