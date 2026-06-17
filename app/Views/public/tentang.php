<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="mb-2">Tentang SawitSmart</h1>
        <p class="lead">Mengenal lebih dekat tentang misi dan visi kami</p>
    </div>
</section>

<!-- About SawitSmart -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5 mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Platform Digital untuk Transformasi Pertanian Sawit</h2>
                <p class="lead text-muted mb-4">
                    SawitSmart adalah inisiatif dari Universitas Jambi untuk digitalisasi industri pertanian sawit di Indonesia. Kami berkomitmen untuk membantu petani dan koperasi sawit meningkatkan produktivitas dan profitabilitas melalui teknologi digital yang inovatif dan mudah digunakan.
                </p>
                <p class="text-muted mb-4">
                    Sejak didirikan pada tahun 2023, SawitSmart telah berkembang menjadi platform terpercaya dengan ribuan pengguna aktif di seluruh Indonesia. Tim kami terdiri dari para profesional berpengalaman di bidang teknologi, pertanian, dan bisnis.
                </p>
                <a href="<?= base_url('tentang/visi-misi') ?>" class="btn btn-success btn-lg">
                    <i class="fas fa-target me-2"></i>Lihat Visi & Misi
                </a>
            </div>
            <div class="col-lg-6">
                <img src="<?= base_url('assets/images/about-feature.svg') ?>" alt="Tentang SawitSmart" class="img-fluid rounded-3 shadow">
            </div>
        </div>

        <!-- Statistics -->
        <div class="row g-4 mt-5">
            <div class="col-md-3">
                <div class="stat-card text-center p-4 rounded-3 bg-light">
                    <h3 class="fw-bold text-success display-4">5000+</h3>
                    <p class="text-muted">Pengguna Aktif</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center p-4 rounded-3 bg-light">
                    <h3 class="fw-bold text-success display-4">150+</h3>
                    <p class="text-muted">Koperasi Terlayani</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center p-4 rounded-3 bg-light">
                    <h3 class="fw-bold text-success display-4">500K+</h3>
                    <p class="text-muted">Hektar Terkelola</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center p-4 rounded-3 bg-light">
                    <h3 class="fw-bold text-success display-4">98%</h3>
                    <p class="text-muted">Kepuasan Pengguna</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose SawitSmart -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold mb-5 text-center">Mengapa Memilih SawitSmart?</h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="benefit-card p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-brain fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Teknologi Terdepan</h5>
                    <p class="text-muted">Menggunakan teknologi AI dan machine learning untuk memberikan insights yang actionable.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="benefit-card p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-graduation-cap fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Dukungan Pelatihan</h5>
                    <p class="text-muted">Tim kami siap memberikan pelatihan dan support untuk memaksimalkan penggunaan platform.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="benefit-card p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-shield-alt fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Keamanan Data</h5>
                    <p class="text-muted">Data Anda dilindungi dengan enkripsi tingkat enterprise dan compliance internasional.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="benefit-card p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-headset fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Support 24/7</h5>
                    <p class="text-muted">Tim support profesional kami siap membantu kapan saja Anda membutuhkan.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="benefit-card p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-chart-line fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">ROI Terbukti</h5>
                    <p class="text-muted">Rata-rata pengguna melihat peningkatan produktivitas hingga 40% dalam 6 bulan pertama.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="benefit-card p-4 rounded-3 bg-white shadow-sm h-100">
                    <i class="fas fa-leaf fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Berkelanjutan</h5>
                    <p class="text-muted">Kami mendukung praktik pertanian yang berkelanjutan dan ramah lingkungan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Bergabunglah dengan Ribuan Pengguna SawitSmart</h2>
        <p class="lead text-muted mb-5">Mulai transformasi digital kebun atau koperasi Anda hari ini</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="<?= base_url('tentang/tim') ?>" class="btn btn-success btn-lg">
                <i class="fas fa-people me-2"></i>Lihat Tim Kami
            </a>
            <a href="<?= base_url('kontak') ?>" class="btn btn-outline-success btn-lg">
                <i class="fas fa-envelope me-2"></i>Hubungi Kami
            </a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
