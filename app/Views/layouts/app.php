<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SawitSmart - Palm Oil Management Dashboard">
    <meta name="theme-color" content="#2ecc71">
    <title><?= $title ?? 'Dashboard' ?> - SawitSmart</title>
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard-refined.css') ?>">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <span class="navbar-brand">SawitSmart</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('palm-dashboard') ?>" title="Kembali ke Dashboard">
                            <i class="fas fa-home"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown user-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i>
                            <span><?= session()->get('user_name') ?? 'User' ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('palm-dashboard/settings') ?>"><i class="fas fa-cog"></i> Pengaturan</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('palm-dashboard/farm-settings') ?>"><i class="fas fa-sliders-h"></i> Preferensi Farm</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="d-flex" style="margin-top: 72px; min-height: calc(100vh - 72px);">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h5 class="mb-0">Menu</h5>
                <button class="sidebar-toggle" type="button" aria-label="Toggle sidebar">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="<?= base_url('palm-dashboard') ?>" class="nav-link" data-page="dashboard">
                        <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                        <span class="nav-text">Dashboard Utama</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('palm-dashboard/tbs') ?>" class="nav-link" data-page="tbs">
                        <span class="nav-icon"><i class="fas fa-leaf"></i></span>
                        <span class="nav-text">Manajemen TBS</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('palm-dashboard/production') ?>" class="nav-link" data-page="production">
                        <span class="nav-icon"><i class="fas fa-industry"></i></span>
                        <span class="nav-text">Produksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('palm-dashboard/harvesting') ?>" class="nav-link" data-page="harvesting">
                        <span class="nav-icon"><i class="fas fa-tractor"></i></span>
                        <span class="nav-text">Panen</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('palm-dashboard/analytics') ?>" class="nav-link" data-page="analytics">
                        <span class="nav-icon"><i class="fas fa-chart-bar"></i></span>
                        <span class="nav-text">Analitik</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('palm-dashboard/farm-settings') ?>" class="nav-link" data-page="settings">
                        <span class="nav-icon"><i class="fas fa-sliders-h"></i></span>
                        <span class="nav-text">Pengaturan Farm</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('api/docs/schema') ?>" class="nav-link" data-page="docs" target="_blank">
                        <span class="nav-icon"><i class="fas fa-book"></i></span>
                        <span class="nav-text">Dokumentasi API</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content flex-grow-1">
            <?= $this->renderSection('content'); ?>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-light border-top py-3 mt-5" style="margin-left: 280px;">
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <small class="text-muted">
                    &copy; 2024-2025 <strong>SawitSmart</strong> - Palm Oil Management Dashboard
                </small>
                <small class="text-muted">
                    <i class="fas fa-database"></i> Database: <span id="db-status">Checking...</span>
                </small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    
    <!-- jQuery (optional but useful for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Dashboard JS -->
    <script>
        window.APP_BASE = <?= json_encode(rtrim(base_url(), '/')) ?>;
        window.apiUrl = (path) => window.APP_BASE + '/' + String(path).replace(/^\//, '');
        window.csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        const originalFetch = window.fetch;
        window.fetch = function(url, options = {}) {
            if (typeof url === 'string' && url.includes('/api/') && options.method && options.method.toUpperCase() !== 'GET') {
                options.credentials = options.credentials || 'same-origin';
                options.headers = Object.assign({
                    'X-CSRF-TOKEN': window.csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }, options.headers || {});
            }
            return originalFetch(url, options);
        };

        // Sidebar Toggle
        document.querySelector('.sidebar-toggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('expanded');
        });

        // Active Page Indicator
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = document.body.dataset.page || 'dashboard';
            const navLink = document.querySelector(`[data-page="${currentPage}"]`);
            if (navLink) {
                document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
                navLink.classList.add('active');
            }

            // Check Database Status
            fetch('<?= base_url('api/status/health') ?>')
                .then(response => response.json())
                .then(data => {
                    const statusEl = document.getElementById('db-status');
                    if (data.database_connected) {
                        statusEl.innerHTML = '<span class="text-success"><i class="fas fa-check-circle"></i> Connected</span>';
                    } else {
                        statusEl.innerHTML = '<span class="text-danger"><i class="fas fa-times-circle"></i> Disconnected</span>';
                    }
                })
                .catch(() => {
                    document.getElementById('db-status').innerHTML = '<span class="text-warning"><i class="fas fa-exclamation-circle"></i> Unknown</span>';
                });
        });

        // Global AJAX Error Handler
        $(document).ajaxError(function(event, jqxhr, settings, thrownError) {
            console.error('AJAX Error:', thrownError);
            if (jqxhr.status === 401) {
                window.location.href = '<?= base_url('auth/login') ?>';
            }
        });
    </script>
</body>
</html>
