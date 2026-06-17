<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $meta_description ?? 'SawitSmart - Platform Digital Terintegrasi untuk Manajemen Kebun Sawit' ?>">
    <meta name="keywords" content="<?= $meta_keywords ?? 'sawit, platform digital, manajemen kebun, koperasi, pertanian' ?>">
    <title><?= $title ?? 'SawitSmart - Platform Manajemen Sawit Digital' ?></title>
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/neobrutalism.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/refined.css') ?>">
</head>
<body>
    <!-- Navigation Header - Clean Modern Design -->
    <nav class="navbar navbar-expand-lg navbar-clean">
        <div class="container-fluid px-3 px-md-4">
            <!-- Logo -->
            <a class="navbar-brand-clean" href="<?= base_url('/') ?>">
                <i class="fas fa-leaf"></i>
                <span>SawitSmart</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler-clean" id="navbarToggler" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- Main Navigation Menu -->
            <div class="navbar-collapse-clean" id="navbarCollapse">
                <ul class="navbar-nav-clean">
                    <!-- Main Navigation Items -->
                    <li><a href="<?= base_url('/') ?>" class="nav-link-clean"><i class="fas fa-home"></i>Beranda</a></li>

                    <!-- Produk Dropdown -->
                    <li class="nav-dropdown">
                        <a href="#" class="nav-link-clean" data-dropdown="produk">
                            <i class="fas fa-cube"></i>Produk<i class="fas fa-chevron-down ms-1"></i>
                        </a>
                        <div class="dropdown-menu-clean" id="produk-dropdown">
                            <a href="<?= base_url('produk/sim-sawit') ?>"><i class="fas fa-leaf"></i>SIM Sawit</a>
                            <a href="<?= base_url('produk/sim-koperasi') ?>"><i class="fas fa-users"></i>SIM Koperasi</a>
                            <a href="<?= base_url('produk/analytics') ?>"><i class="fas fa-chart-line"></i>Analytics</a>
                        </div>
                    </li>

                    <!-- Tentang Dropdown -->
                    <li class="nav-dropdown">
                        <a href="#" class="nav-link-clean" data-dropdown="tentang">
                            <i class="fas fa-info-circle"></i>Tentang<i class="fas fa-chevron-down ms-1"></i>
                        </a>
                        <div class="dropdown-menu-clean" id="tentang-dropdown">
                            <a href="<?= base_url('tentang/visi-misi') ?>"><i class="fas fa-target"></i>Visi & Misi</a>
                            <a href="<?= base_url('tentang/tim') ?>"><i class="fas fa-people"></i>Tim Kami</a>
                            <a href="<?= base_url('berita') ?>"><i class="fas fa-newspaper"></i>Berita</a>
                        </div>
                    </li>

                    <!-- Konten Dropdown -->
                    <li class="nav-dropdown">
                        <a href="#" class="nav-link-clean" data-dropdown="konten">
                            <i class="fas fa-book"></i>Konten<i class="fas fa-chevron-down ms-1"></i>
                        </a>
                        <div class="dropdown-menu-clean" id="konten-dropdown">
                            <a href="<?= base_url('kegiatan') ?>"><i class="fas fa-calendar-check"></i>Kegiatan</a>
                            <a href="<?= base_url('panduan') ?>"><i class="fas fa-graduation-cap"></i>Panduan</a>
                        </div>
                    </li>

                    <!-- Kontak Link -->
                    <li><a href="<?= base_url('kontak') ?>" class="nav-link-clean"><i class="fas fa-envelope"></i>Kontak</a></li>

                    <!-- Mobile Menu Auth Buttons -->
                    <li class="nav-divider d-lg-none"></li>
                    <?php if (session()->has('user_id')): ?>
                        <li class="d-lg-none">
                            <a href="<?= base_url('dashboard') ?>" class="nav-link-clean nav-link-btn">
                                <i class="fas fa-chart-line"></i>Dashboard
                            </a>
                        </li>
                        <li class="d-lg-none">
                            <a href="<?= base_url('auth/logout') ?>" class="nav-link-clean nav-link-btn nav-link-btn-primary">
                                <i class="fas fa-sign-out-alt"></i>Logout
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="d-lg-none">
                            <a href="<?= base_url('auth/login') ?>" class="nav-link-clean nav-link-btn">
                                <i class="fas fa-sign-in-alt"></i>Masuk
                            </a>
                        </li>
                        <li class="d-lg-none">
                            <a href="<?= base_url('auth/register') ?>" class="nav-link-clean nav-link-btn nav-link-btn-primary">
                                <i class="fas fa-user-plus"></i>Daftar
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Desktop Auth Buttons -->
            <div class="navbar-auth-clean d-none d-lg-flex">
                <?php if (session()->has('user_id')): ?>
                    <!-- User Profile Dropdown -->
                    <div class="nav-dropdown" style="position: relative;">
                        <a href="#" class="btn-nav-clean btn-nav-outline" data-dropdown="userprofile" style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-user-circle"></i>
                            <span><?= esc(session()->get('user_name')) ?></span>
                            <i class="fas fa-chevron-down" style="font-size: 0.75rem;"></i>
                        </a>
                        <div class="dropdown-menu-clean" id="userprofile-dropdown" style="position: absolute; right: 0; width: 200px; z-index: 100;">
                            <a href="<?= base_url('dashboard') ?>"><i class="fas fa-chart-line me-2"></i>Dashboard</a>
                            <a href="<?= base_url('dashboard') ?>"><i class="fas fa-user me-2"></i>Profil Saya</a>
                            <div style="border-top: 1px solid rgba(0,255,65,0.2); margin: 0.5rem 0;"></div>
                            <a href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a class="btn-nav-clean btn-nav-outline" href="<?= base_url('auth/login') ?>">
                        <i class="fas fa-sign-in-alt"></i>Masuk
                    </a>
                    <a class="btn-nav-clean btn-nav-primary" href="<?= base_url('auth/register') ?>">
                        <i class="fas fa-user-plus"></i>Daftar
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer - Neobrutalism -->
    <footer>
        <div class="container-fluid px-3 px-md-5">
            <div class="row mb-5">
                <!-- Brand & Contact Info -->
                <div class="col-md-4 mb-4">
                    <h5 class="navbar-brand-footer mb-3">
                        <i class="fas fa-leaf"></i>SawitSmart
                    </h5>
                    <p style="color: #b0b0b0; line-height: 1.8;">Platform digital terintegrasi untuk manajemen kebun sawit yang membantu koperasi dan petani meningkatkan produktivitas.</p>
                    
                    <h6 style="margin-top: 2rem; margin-bottom: 1rem; font-size: 1rem;">
                        <i class="fas fa-building me-2"></i>Universitas Jambi
                    </h6>
                    
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>0852-6804-1096</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:admin@sawitsmart.com">admin@sawitsmart.com</a>
                    </div>
                </div>

                <!-- Products -->
                <div class="col-md-2 mb-4">
                    <h6 class="mb-3">
                        <i class="fas fa-box me-2"></i>Produk
                    </h6>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('produk/sim-sawit') ?>" class="text-white-50"><i class="fas fa-leaf me-2" style="color: var(--primary);"></i>SIM Sawit</a></li>
                        <li><a href="<?= base_url('produk/sim-koperasi') ?>" class="text-white-50"><i class="fas fa-users me-2" style="color: var(--primary);"></i>SIM Koperasi</a></li>
                        <li><a href="<?= base_url('produk/analytics') ?>" class="text-white-50"><i class="fas fa-chart-line me-2" style="color: var(--primary);"></i>Laporan & Analitik</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div class="col-md-2 mb-4">
                    <h6 class="mb-3">
                        <i class="fas fa-building me-2"></i>Perusahaan
                    </h6>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('tentang/visi-misi') ?>" class="text-white-50"><i class="fas fa-target me-2" style="color: var(--primary);"></i>Visi & Misi</a></li>
                        <li><a href="<?= base_url('tentang/tim') ?>" class="text-white-50"><i class="fas fa-people me-2" style="color: var(--primary);"></i>Tim Kami</a></li>
                        <li><a href="<?= base_url('berita') ?>" class="text-white-50"><i class="fas fa-newspaper me-2" style="color: var(--primary);"></i>Berita</a></li>
                        <li><a href="<?= base_url('kegiatan') ?>" class="text-white-50"><i class="fas fa-calendar-check me-2" style="color: var(--primary);"></i>Kegiatan</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="col-md-4 mb-4">
                    <h6 class="mb-3">
                        <i class="fas fa-envelope-open me-2"></i>Newsletter
                    </h6>
                    <p style="color: #b0b0b0; font-size: 0.95rem;">Dapatkan update terbaru tentang fitur dan perkembangan SawitSmart langsung ke email Anda.</p>
                    <form id="newsletter-form" class="d-flex" action="<?= base_url('api/subscribe') ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="email" class="form-control form-control-sm" placeholder="Email Anda" required style="background-color: rgba(255,255,255,0.05); border: 2px solid rgba(0,255,65,0.3); color: white; flex: 1;">
                        <button class="btn btn-success btn-sm" type="submit" style="white-space: nowrap;">
                            <i class="fas fa-paper-plane me-1"></i>Kirim
                        </button>
                    </form>
                </div>
            </div>

            <!-- Footer Bottom Divider -->
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <!-- Copyright -->
                    <div class="col-md-6 mb-3 mb-md-0">
                        <p class="footer-bottom-left mb-0">
                            <i class="fas fa-copyright me-2" style="color: var(--primary);"></i>&copy; 2024 SawitSmart. Hak cipta dilindungi.
                        </p>
                    </div>

                    <!-- Social Media -->
                    <div class="col-md-6 text-md-end">
                        <div class="social-links">
                            <a href="#" title="Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" title="Twitter" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="#" title="LinkedIn" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" title="YouTube" target="_blank"><i class="fab fa-youtube"></i></a>
                            <a href="#" title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Footer Links -->
                <div class="row mt-3 pt-3" style="border-top: 2px solid rgba(0, 255, 65, 0.2);">
                    <div class="col-12 text-center">
                        <small style="color: #777777;">
                            <a href="#" style="color: #b0b0b0;">Syarat & Ketentuan</a>
                            <span style="color: #555555; margin: 0 1rem;">|</span>
                            <a href="#" style="color: #b0b0b0;">Kebijakan Privasi</a>
                            <span style="color: #555555; margin: 0 1rem;">|</span>
                            <a href="#" style="color: #b0b0b0;">Hubungi Kami</a>
                            <span style="color: #555555; margin: 0 1rem;">|</span>
                            <a href="#" style="color: #b0b0b0;">Laporkan Bug</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/header-clean.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>
