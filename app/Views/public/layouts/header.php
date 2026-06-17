<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'SawitSmart') ?></title>
    <meta name="description" content="<?= esc($meta_description ?? 'SawitSmart adalah platform digital terintegrasi untuk manajemen kebun sawit.') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/site.css">
</head>
<body>
<header class="site-header">
    <div class="container-fluid header-wrapper">
        <div class="header-content">
            <a class="brand" href="<?= site_url() ?>">
                <i class="fas fa-leaf"></i> SawitSmart
            </a>
            
            <!-- Hamburger Menu for Mobile -->
            <button class="hamburger" id="mobileMenuBtn" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <!-- Main Navigation -->
            <nav class="main-nav" id="mainNav">
                <div class="nav-wrapper">
                    <a href="<?= site_url() ?>" class="nav-link">
                        <i class="fas fa-home"></i> Beranda
                    </a>
                    
                    <div class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" id="produkDropdown" aria-expanded="false">
                            <i class="fas fa-box"></i> Produk <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="produkDropdown">
                            <a href="<?= site_url('product/sim-sawit') ?>">
                                <i class="fas fa-leaf"></i> SIM Sawit
                            </a>
                            <a href="<?= site_url('product/sim-koperasi') ?>">
                                <i class="fas fa-users"></i> SIM Koperasi
                            </a>
                            <a href="<?= site_url('product/analytics') ?>">
                                <i class="fas fa-chart-line"></i> Laporan & Analitik
                            </a>
                        </div>
                    </div>
                    
                    <div class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" id="tentangDropdown" aria-expanded="false">
                            <i class="fas fa-info-circle"></i> Tentang Kami <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="tentangDropdown">
                            <a href="<?= site_url('pages/view/visi-misi') ?>">
                                <i class="fas fa-target"></i> Visi & Misi
                            </a>
                            <a href="<?= site_url('pages/view/tim') ?>">
                                <i class="fas fa-people"></i> Tim Kami
                            </a>
                        </div>
                    </div>
                    
                    <a href="<?= site_url('news') ?>" class="nav-link">
                        <i class="fas fa-newspaper"></i> Berita
                    </a>
                    
                    <a href="<?= site_url('pages/view/panduan') ?>" class="nav-link">
                        <i class="fas fa-book"></i> Panduan
                    </a>
                    
                    <a href="<?= site_url('contact') ?>" class="nav-link">
                        <i class="fas fa-envelope"></i> Kontak
                    </a>
                </div>
            </nav>
            
            <!-- Right Side Actions -->
            <div class="header-actions">
                <!-- More Menu (Three Dots) -->
                <div class="more-menu dropdown">
                    <button class="menu-trigger" id="moreMenuBtn" title="Menu Lainnya" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu more-dropdown" id="moreMenuDropdown">
                        <a href="<?= site_url('pages/view/syarat-ketentuan') ?>" class="dropdown-item">
                            <i class="fas fa-file-contract"></i> Syarat & Ketentuan
                        </a>
                        <a href="<?= site_url('pages/view/kebijakan-privasi') ?>" class="dropdown-item">
                            <i class="fas fa-shield-alt"></i> Kebijakan Privasi
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-language"></i> Bahasa (ID)
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-headset"></i> Dukungan
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-bug"></i> Laporkan Bug
                        </a>
                    </div>
                </div>
                
                <!-- Authentication Buttons -->
                <div class="auth-buttons">
                    <a href="<?= site_url('login') ?>" class="btn btn-outline">
                        <i class="fas fa-sign-in-alt"></i> Masuk
                    </a>
                    <a href="<?= site_url('register') ?>" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="container">
