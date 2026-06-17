<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Page Header -->
<section class="page-header bg-success text-white py-5">
    <div class="container">
        <h1>Dashboard</h1>
        <p class="lead">Selamat datang, <?= esc($user_name) ?></p>
    </div>
</section>

<!-- Dashboard Content -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Welcome Card -->
            <div class="col-lg-8">
                <div class="bg-light p-5 rounded-3 border border-success mb-4">
                    <h3 class="fw-bold mb-3">Halo, <?= esc($user_name) ?>! 👋</h3>
                    <p class="text-muted mb-3">
                        Selamat datang di Dashboard SawitSmart. Di sini Anda dapat mengelola akun dan mengakses semua fitur platform kami.
                    </p>
                    <div class="alert alert-info" role="alert">
                        <strong>Email Anda:</strong> <?= esc($user_email) ?>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mb-5">
                    <h4 class="fw-bold mb-3">Akses Cepat</h4>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <a href="<?= base_url('produk/sim-sawit') ?>" class="btn btn-success btn-lg w-100">
                                <i class="fas fa-leaf me-2"></i>SIM Sawit
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="<?= base_url('produk/sim-koperasi') ?>" class="btn btn-success btn-lg w-100">
                                <i class="fas fa-handshake me-2"></i>SIM Koperasi
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="<?= base_url('produk/analytics') ?>" class="btn btn-success btn-lg w-100">
                                <i class="fas fa-chart-bar me-2"></i>Analitik
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="<?= base_url('kontak') ?>" class="btn btn-success btn-lg w-100">
                                <i class="fas fa-phone me-2"></i>Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Account Information -->
                <div>
                    <h4 class="fw-bold mb-3">Informasi Akun</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td><?= esc($user_name) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td><?= esc($user_email) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Help & Support -->
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm mb-4">
                    <i class="fas fa-question-circle fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Bantuan & Dukungan</h5>
                    <p class="text-muted text-sm mb-3">Butuh bantuan? Lihat panduan lengkap kami atau hubungi tim support.</p>
                    <a href="<?= base_url('panduan') ?>" class="btn btn-sm btn-outline-success">Buka Panduan</a>
                </div>

                <!-- News -->
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm mb-4">
                    <i class="fas fa-newspaper fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Berita Terbaru</h5>
                    <p class="text-muted text-sm mb-3">Ikuti perkembangan terbaru dan update dari SawitSmart.</p>
                    <a href="<?= base_url('berita') ?>" class="btn btn-sm btn-outline-success">Baca Berita</a>
                </div>

                <!-- Events -->
                <div class="feature-box p-4 rounded-3 bg-white shadow-sm">
                    <i class="fas fa-calendar-alt fa-2x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Kegiatan & Event</h5>
                    <p class="text-muted text-sm mb-3">Jangan lewatkan webinar dan workshop eksklusif kami.</p>
                    <a href="<?= base_url('kegiatan') ?>" class="btn btn-sm btn-outline-success">Lihat Kegiatan</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Logout Button -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger btn-lg">
            <i class="fas fa-sign-out-alt me-2"></i>Logout
        </a>
    </div>
</section>

<?= $this->endSection() ?>
