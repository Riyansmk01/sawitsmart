<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="mb-2">Panduan Penggunaan</h1>
        <p class="lead">Tutorial lengkap untuk memaksimalkan penggunaan SawitSmart</p>
    </div>
</section>

<!-- Guide Categories -->
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-5 text-center">Kategori Panduan</h2>
        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3">
                <a href="#sim-sawit-guides" class="guide-category p-4 rounded-3 bg-light text-center text-decoration-none h-100">
                    <i class="fas fa-leaf fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold text-dark mb-2">SIM Sawit</h5>
                    <p class="text-muted small">Panduan lengkap menggunakan sistem manajemen kebun sawit.</p>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#sim-koperasi-guides" class="guide-category p-4 rounded-3 bg-light text-center text-decoration-none h-100">
                    <i class="fas fa-users fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold text-dark mb-2">SIM Koperasi</h5>
                    <p class="text-muted small">Panduan manajemen koperasi dan transaksi anggota.</p>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#analytics-guides" class="guide-category p-4 rounded-3 bg-light text-center text-decoration-none h-100">
                    <i class="fas fa-chart-line fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold text-dark mb-2">Analytics</h5>
                    <p class="text-muted small">Panduan membuat laporan dan analisis data bisnis.</p>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#general-guides" class="guide-category p-4 rounded-3 bg-light text-center text-decoration-none h-100">
                    <i class="fas fa-book fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold text-dark mb-2">Umum</h5>
                    <p class="text-muted small">Panduan umum dan troubleshooting masalah umum.</p>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Guide List -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 id="sim-sawit-guides" class="fw-bold mb-4">Panduan SIM Sawit</h3>
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="guide-item p-4 rounded-3 bg-white shadow-sm h-100">
                    <h5 class="fw-bold mb-2"><i class="fas fa-book-open me-2 text-success"></i>Memulai Dengan SIM Sawit</h5>
                    <p class="text-muted small">Panduan langkah demi langkah untuk setup awal dan konfigurasi dasar sistem.</p>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3">Baca Selengkapnya</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="guide-item p-4 rounded-3 bg-white shadow-sm h-100">
                    <h5 class="fw-bold mb-2"><i class="fas fa-book-open me-2 text-success"></i>Monitoring Kebun Real-Time</h5>
                    <p class="text-muted small">Pelajari cara menggunakan fitur monitoring dan tracking lokasi kebun.</p>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3">Baca Selengkapnya</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="guide-item p-4 rounded-3 bg-white shadow-sm h-100">
                    <h5 class="fw-bold mb-2"><i class="fas fa-book-open me-2 text-success"></i>Input Data Produksi</h5>
                    <p class="text-muted small">Tutorial lengkap untuk mencatat data produksi, panen, dan pengolahan.</p>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3">Baca Selengkapnya</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="guide-item p-4 rounded-3 bg-white shadow-sm h-100">
                    <h5 class="fw-bold mb-2"><i class="fas fa-book-open me-2 text-success"></i>Membuat Laporan</h5>
                    <p class="text-muted small">Panduan membuat laporan custom dan export data dalam berbagai format.</p>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3">Baca Selengkapnya</a>
                </div>
            </div>
        </div>

        <h3 id="sim-koperasi-guides" class="fw-bold mb-4 mt-5">Panduan SIM Koperasi</h3>
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="guide-item p-4 rounded-3 bg-white shadow-sm h-100">
                    <h5 class="fw-bold mb-2"><i class="fas fa-book-open me-2 text-success"></i>Manajemen Anggota Koperasi</h5>
                    <p class="text-muted small">Cara mengelola data anggota dan riwayat kontribusi anggota.</p>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3">Baca Selengkapnya</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="guide-item p-4 rounded-3 bg-white shadow-sm h-100">
                    <h5 class="fw-bold mb-2"><i class="fas fa-book-open me-2 text-success"></i>Pencatatan Transaksi</h5>
                    <p class="text-muted small">Panduan mencatat transaksi koperasi dengan detail dan transparansi.</p>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3">Baca Selengkapnya</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="guide-item p-4 rounded-3 bg-white shadow-sm h-100">
                    <h5 class="fw-bold mb-2"><i class="fas fa-book-open me-2 text-success"></i>Distribusi Produk</h5>
                    <p class="text-muted small">Tutorial mengelola alur distribusi dan tracking pengiriman produk.</p>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3">Baca Selengkapnya</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="guide-item p-4 rounded-3 bg-white shadow-sm h-100">
                    <h5 class="fw-bold mb-2"><i class="fas fa-book-open me-2 text-success"></i>Laporan Keuangan</h5>
                    <p class="text-muted small">Panduan membuat laporan keuangan koperasi untuk transparansi anggota.</p>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3">Baca Selengkapnya</a>
                </div>
            </div>
        </div>

        <h3 id="analytics-guides" class="fw-bold mb-4 mt-5">Panduan Analytics</h3>
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="guide-item p-4 rounded-3 bg-white shadow-sm h-100">
                    <h5 class="fw-bold mb-2"><i class="fas fa-book-open me-2 text-success"></i>Menggunakan Dashboard</h5>
                    <p class="text-muted small">Panduan menggunakan dashboard interaktif dan membaca visualisasi data.</p>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3">Baca Selengkapnya</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="guide-item p-4 rounded-3 bg-white shadow-sm h-100">
                    <h5 class="fw-bold mb-2"><i class="fas fa-book-open me-2 text-success"></i>Analisis Trend</h5>
                    <p class="text-muted small">Tutorial menganalisis trend produksi dan performa kebun dari waktu ke waktu.</p>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3">Baca Selengkapnya</a>
                </div>
            </div>
        </div>

        <h3 id="general-guides" class="fw-bold mb-4 mt-5">Panduan Umum</h3>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="guide-item p-4 rounded-3 bg-white shadow-sm h-100">
                    <h5 class="fw-bold mb-2"><i class="fas fa-book-open me-2 text-success"></i>Troubleshooting Umum</h5>
                    <p class="text-muted small">Solusi untuk masalah-masalah umum yang sering dihadapi pengguna.</p>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3">Baca Selengkapnya</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="guide-item p-4 rounded-3 bg-white shadow-sm h-100">
                    <h5 class="fw-bold mb-2"><i class="fas fa-book-open me-2 text-success"></i>Keamanan Akun</h5>
                    <p class="text-muted small">Panduan menjaga keamanan akun dan password Anda di SawitSmart.</p>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ CTA -->
<section class="py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Masih Ada Pertanyaan?</h2>
        <p class="lead text-muted mb-5">Tim support kami siap membantu Anda</p>
        <a href="<?= base_url('kontak') ?>" class="btn btn-success btn-lg">
            <i class="fas fa-envelope me-2"></i>Hubungi Support
        </a>
    </div>
</section>

<?= $this->endSection() ?>
