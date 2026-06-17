<?php echo $this->extend('layouts/app'); ?>

<?php echo $this->section('content'); ?>

<div class="container-fluid py-4">
    <h2 class="mb-4">Analytics & Reporting</h2>

    <!-- Key Metrics -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class="text-muted">Quality A/B Percentage</h6>
                    <h3 id="qualityMetric">0%</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class="text-muted">Avg Extraction Rate</h6>
                    <h3 id="extractionMetric">0%</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class="text-muted">TBS Processed (30d)</h6>
                    <h3 id="tbsMetric">0 kg</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class="text-muted">Oil Produced (30d)</h6>
                    <h3 id="oilMetric">0 kg</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quality Distribution (Last 7 Days)</h5>
                </div>
                <div class="card-body">
                    <canvas id="qualityChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Top 10 Performing Days</h5>
                </div>
                <div class="card-body" style="height: 300px; overflow-y: auto;">
                    <table class="table table-sm mb-0" id="topDaysTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Oil (kg)</th>
                                <th>Rate %</th>
                            </tr>
                        </thead>
                        <tbody id="topDaysBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Monthly Production Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Month</label>
                            <input type="month" class="form-control" id="monthSelect">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary w-100" onclick="loadMonthlyStats()">Load Report</button>
                        </div>
                    </div>
                    <div id="monthlySummary">
                        <div class="text-center text-muted">Select a month to view report</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const farmId = 1;
    let qualityChart = null;

    async function loadMetrics() {
        try {
            const response = await fetch(apiUrl(`api/dashboard/kpi?farm_id=${farmId}`));
            const data = await response.json();
            
            if (data.success) {
                document.getElementById('qualityMetric').textContent = (data.kpi.quality_percentage || 0) + '%';
                document.getElementById('extractionMetric').textContent = (data.kpi.avg_extraction_rate || 0).toFixed(2) + '%';
                document.getElementById('tbsMetric').textContent = (data.kpi.tbs_received_30d || 0).toLocaleString() + ' kg';
                document.getElementById('oilMetric').textContent = (data.kpi.oil_produced_30d || 0).toLocaleString() + ' kg';
            }
        } catch (e) {
            console.error('Error loading KPI:', e);
        }
    }

    async function loadQualityDistribution() {
        try {
            const response = await fetch(apiUrl(`api/dashboard/quality-distribution?farm_id=${farmId}&days=7`));
            const data = await response.json();

            if (data.success && data.data.length > 0) {
                const labels = data.data.map(d => `Grade ${d.quality_grade}`);
                const weights = data.data.map(d => parseFloat(d.weight));

                if (qualityChart) {
                    qualityChart.destroy();
                }

                const ctx = document.getElementById('qualityChart').getContext('2d');
                qualityChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: weights,
                            backgroundColor: ['#28a745', '#17a2b8', '#ffc107', '#dc3545']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }
        } catch (e) {
            console.error('Error loading quality chart:', e);
        }
    }

    async function loadTopPerformingDays() {
        try {
            const response = await fetch(apiUrl(`api/dashboard/top-days?farm_id=${farmId}&days=30&limit=10`));
            const data = await response.json();

            if (data.success) {
                const tbody = document.getElementById('topDaysBody');
                tbody.innerHTML = data.data.map(d => `
                    <tr>
                        <td>${d.date}</td>
                        <td>${parseFloat(d.oil_kg).toLocaleString()}</td>
                        <td>${parseFloat(d.extraction_rate).toFixed(2)}%</td>
                    </tr>
                `).join('');
            }
        } catch (e) {
            console.error('Error loading top days:', e);
        }
    }

    async function loadMonthlyStats() {
        const monthSelect = document.getElementById('monthSelect').value;
        if (!monthSelect) {
            alert('Please select a month');
            return;
        }

        const [year, month] = monthSelect.split('-');

        try {
            const response = await fetch(apiUrl(`api/dashboard/monthly-stats?farm_id=${farmId}&month=${month}&year=${year}`));
            const data = await response.json();

            if (data.success && data.data) {
                const stats = data.data;
                document.getElementById('monthlySummary').innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Total TBS Input:</strong> ${(stats.total_input || 0).toLocaleString()} kg</p>
                            <p><strong>Total Oil Produced:</strong> ${(stats.total_oil || 0).toLocaleString()} kg</p>
                            <p><strong>Total Kernel:</strong> ${(stats.total_kernel || 0).toLocaleString()} kg</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Average Extraction Rate:</strong> ${(stats.avg_extraction || 0).toFixed(2)}%</p>
                        </div>
                    </div>
                `;
            }
        } catch (e) {
            console.error('Error loading monthly stats:', e);
        }
    }

    window.addEventListener('load', () => {
        const today = new Date();
        document.getElementById('monthSelect').valueAsDate = today;
        
        loadMetrics();
        loadQualityDistribution();
        loadTopPerformingDays();
    });
</script>

<?php echo $this->endSection(); ?>
