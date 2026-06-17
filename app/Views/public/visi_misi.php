<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="mb-2">Visi & Misi</h1>
        <p class="lead">Komitmen kami untuk transformasi digital industri sawit Indonesia</p>
    </div>
</section>

<!-- Visi Misi Content -->
<section class="py-5">
    <div class="container">
        <div class="row g-5 mb-5">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-5 bg-light">
                        <h3 class="fw-bold text-success mb-3">
                            <i class="fas fa-binoculars me-2"></i>Visi
                        </h3>
                        <p class="fs-5 lh-lg">
                            Menjadi platform digital terdepan yang mengintegrasikan seluruh aspek industri pertanian sawit di Indonesia, meningkatkan efisiensi, produktivitas, dan kesejahteraan petani serta koperasi melalui teknologi inovatif dan berkelanjutan.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-5 bg-light">
                        <h3 class="fw-bold text-success mb-3">
                            <i class="fas fa-rocket me-2"></i>Misi
                        </h3>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <strong><i class="fas fa-check-circle text-success me-2"></i>Digitalisasi Pertanian</strong>
                                <p class="text-muted ms-4 mb-0">Menghadirkan solusi digital yang mudah digunakan untuk modernisasi industri sawit.</p>
                            </li>
                            <li class="mb-3">
                                <strong><i class="fas fa-check-circle text-success me-2"></i>Peningkatan Produktivitas</strong>
                                <p class="text-muted ms-4 mb-0">Meningkatkan efisiensi operasional dan hasil produksi melalui teknologi terintegrasi.</p>
                            </li>
                            <li class="mb-3">
                                <strong><i class="fas fa-check-circle text-success me-2"></i>Pemberdayaan Petani</strong>
                                <p class="text-muted ms-4 mb-0">Memberdayakan petani dan koperasi dengan akses informasi dan pasar yang lebih baik.</p>
                            </li>
                            <li>
                                <strong><i class="fas fa-check-circle text-success me-2"></i>Keberlanjutan</strong>
                                <p class="text-muted ms-4 mb-0">Mendukung praktik pertanian yang berkelanjutan dan ramah lingkungan.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Core Values -->
        <h3 class="fw-bold mb-4 text-center">Nilai-Nilai Inti Kami</h3>
        <div class="row g-4">
            <div class="col-md-4 col-lg-3">
                <div class="value-card text-center p-4 rounded-3 bg-light">
                    <i class="fas fa-lightbulb fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold">Inovasi</h5>
                    <p class="text-muted small">Terus berinovasi untuk solusi terbaik</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="value-card text-center p-4 rounded-3 bg-light">
                    <i class="fas fa-handshake fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold">Kepercayaan</h5>
                    <p class="text-muted small">Membangun kepercayaan dengan transparansi</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="value-card text-center p-4 rounded-3 bg-light">
                    <i class="fas fa-people-arrows fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold">Kolaborasi</h5>
                    <p class="text-muted small">Bekerja bersama untuk hasil optimal</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="value-card text-center p-4 rounded-3 bg-light">
                    <i class="fas fa-leaf fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold">Keberlanjutan</h5>
                    <p class="text-muted small">Komitmen pada lingkungan berkelanjutan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
