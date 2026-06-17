<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4" data-page="dashboard">
    <div class="dash-page-header">
        <h1>Dashboard Kebun Sawit</h1>
        <p>Ringkasan operasional dan kinerja produksi farm Anda</p>
    </div>

    <!-- KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="kpi-card">
                <div class="kpi-icon kpi-icon-green"><i class="fas fa-leaf"></i></div>
                <div class="kpi-label">TBS Diterima (30 hari)</div>
                <div class="kpi-value" id="kpi-tbs">—</div>
                <div class="kpi-sub text-success" id="kpi-tbs-status"></div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="kpi-card">
                <div class="kpi-icon kpi-icon-blue"><i class="fas fa-oil-can"></i></div>
                <div class="kpi-label">Minyak Produksi (30 hari)</div>
                <div class="kpi-value" id="kpi-oil">—</div>
                <div class="kpi-sub text-success" id="kpi-oil-status"></div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="kpi-card">
                <div class="kpi-icon kpi-icon-amber"><i class="fas fa-percentage"></i></div>
                <div class="kpi-label">Rata-rata Rendemen</div>
                <div class="kpi-value" id="kpi-extraction">—</div>
                <div class="kpi-sub text-success" id="kpi-extraction-status"></div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="kpi-card">
                <div class="kpi-icon kpi-icon-purple"><i class="fas fa-star"></i></div>
                <div class="kpi-label">Kualitas Grade A/B</div>
                <div class="kpi-value" id="kpi-quality">—</div>
                <div class="kpi-sub text-success" id="kpi-quality-status"></div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-bell text-warning me-2"></i> Peringatan Sistem
                </div>
                <div class="card-body" id="alertsContainer">
                    <small class="text-muted">Memuat peringatan...</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Nav -->
    <div class="row mb-4">
        <div class="col-12">
            <nav class="nav nav-tabs">
                <a class="nav-link active" href="<?= base_url('palm-dashboard/tbs') ?>">
                    <i class="fas fa-leaf me-1"></i> Manajemen TBS
                </a>
                <a class="nav-link" href="<?= base_url('palm-dashboard/production') ?>">
                    <i class="fas fa-industry me-1"></i> Produksi
                </a>
                <a class="nav-link" href="<?= base_url('palm-dashboard/harvesting') ?>">
                    <i class="fas fa-tractor me-1"></i> Panen
                </a>
                <a class="nav-link" href="<?= base_url('palm-dashboard/analytics') ?>">
                    <i class="fas fa-chart-bar me-1"></i> Analitik
                </a>
                <a class="nav-link" href="<?= base_url('palm-dashboard/settings') ?>">
                    <i class="fas fa-cog me-1"></i> Pengaturan
                </a>
            </nav>
        </div>
    </div>

    <!-- Today Stats -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <i class="fas fa-calendar-day me-2 text-success"></i> Penerimaan TBS Hari Ini
                </div>
                <div class="card-body">
                    <div class="row text-center g-3">
                        <div class="col-6">
                            <div class="kpi-label">Janjang</div>
                            <div class="kpi-value" style="font-size: 1.5rem;" id="today-bunches">0</div>
                        </div>
                        <div class="col-6">
                            <div class="kpi-label">Berat (kg)</div>
                            <div class="kpi-value" style="font-size: 1.5rem;" id="today-weight">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <i class="fas fa-industry me-2 text-success"></i> Produksi Hari Ini
                </div>
                <div class="card-body">
                    <div class="row text-center g-3">
                        <div class="col-6">
                            <div class="kpi-label">Minyak Mentah (kg)</div>
                            <div class="kpi-value" style="font-size: 1.5rem;" id="today-oil">0</div>
                        </div>
                        <div class="col-6">
                            <div class="kpi-label">Rendemen</div>
                            <div class="kpi-value" style="font-size: 1.5rem;" id="today-extraction">0%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function loadKPI() {
        try {
            const response = await fetch(apiUrl('api/dashboard/kpi?farm_id=1'));
            const data = await response.json();
            if (data.success) {
                document.getElementById('kpi-tbs').textContent = Number(data.kpi.tbs_received_30d || 0).toLocaleString('id-ID') + ' kg';
                document.getElementById('kpi-oil').textContent = Number(data.kpi.oil_produced_30d || 0).toLocaleString('id-ID') + ' kg';
                document.getElementById('kpi-extraction').textContent = (data.kpi.avg_extraction_rate || 0) + '%';
                document.getElementById('kpi-quality').textContent = (data.kpi.quality_percentage || 0) + '%';
                document.getElementById('kpi-tbs-status').textContent = data.kpi.tbs_target_met ? '✓ Target tercapai' : '⚠ Di bawah target';
                document.getElementById('kpi-oil-status').textContent = data.kpi.oil_target_met ? '✓ Produksi baik' : '⚠ Perlu perhatian';
                document.getElementById('kpi-extraction-status').textContent = data.kpi.extraction_ok ? '✓ Normal' : '⚠ Periksa mesin';
                document.getElementById('kpi-quality-status').textContent = data.kpi.quality_ok ? '✓ Kualitas baik' : '⚠ Perlu perhatian';
            }
        } catch (e) {
            console.error('Error loading KPI:', e);
        }
    }

    async function loadDailySummary() {
        try {
            const response = await fetch(apiUrl('api/dashboard/daily-summary?farm_id=1'));
            const data = await response.json();
            if (data.success) {
                document.getElementById('today-bunches').textContent = Number(data.tbs?.total_bunches || 0).toLocaleString('id-ID');
                document.getElementById('today-weight').textContent = Number(data.tbs?.total_weight || 0).toLocaleString('id-ID');
                document.getElementById('today-oil').textContent = Number(data.tbs?.total_weight ? (data.production?.oil_produced || 0) : 0).toLocaleString('id-ID');
                document.getElementById('today-extraction').textContent = (data.production?.avg_extraction || 0).toFixed(1) + '%';
            }
        } catch (e) {
            console.error('Error loading daily summary:', e);
        }
    }

    async function loadAlerts() {
        try {
            const response = await fetch(apiUrl('api/alerts/all?farm_id=1'));
            const data = await response.json();
            const container = document.getElementById('alertsContainer');

            if (data.success && data.data && data.data.length > 0) {
                container.innerHTML = data.data.map(alert => {
                    const sev = alert.severity || 'info';
                    const cls = sev === 'critical' ? 'danger' : sev === 'warning' ? 'warning' : 'info';
                    return `<div class="alert alert-${cls} mb-2 py-2"><i class="fas fa-circle-exclamation me-2"></i><strong>${alert.type || 'Info'}</strong>: ${alert.message}</div>`;
                }).join('');
            } else {
                container.innerHTML = '<div class="alert alert-success mb-0 py-2"><i class="fas fa-check-circle me-2"></i>Semua sistem beroperasi normal</div>';
            }
        } catch (e) {
            document.getElementById('alertsContainer').innerHTML = '<small class="text-danger">Gagal memuat peringatan</small>';
        }
    }

    window.addEventListener('load', () => {
        loadKPI();
        loadDailySummary();
        loadAlerts();
        setInterval(loadKPI, 300000);
        setInterval(loadDailySummary, 300000);
        setInterval(loadAlerts, 300000);
    });
</script>

<?= $this->endSection() ?>
