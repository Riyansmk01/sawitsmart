<?php echo $this->extend('layouts/app'); ?>

<?php echo $this->section('content'); ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Harvesting Records</h2>
            <p class="text-muted">Track harvesting operations and labor metrics</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHarvestModal">
                <i class="fas fa-plus"></i> Add Harvest Record
            </button>
        </div>
    </div>

    <!-- Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Harvest Date From</label>
                    <input type="date" class="form-control" id="filterDateFrom">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Harvest Date To</label>
                    <input type="date" class="form-control" id="filterDateTo">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="filterStatus">
                        <option value="">All Status</option>
                        <option value="planned">Planned</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="postponed">Postponed</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-secondary w-100" onclick="filterHarvests()">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Harvesting Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="harvestingTable">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Crew Size</th>
                        <th>Bunches</th>
                        <th>Weight (kg)</th>
                        <th>Labor Hours</th>
                        <th>Productivity/Hour</th>
                        <th>Weather</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="harvestingTableBody">
                    <tr>
                        <td colspan="10" class="text-center py-4">
                            <span class="spinner-border spinner-border-sm"></span> Loading...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <nav id="paginationNav"></nav>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">This Month Summary</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Total Bunches:</strong> <span id="monthBunches">0</span></p>
                            <p><strong>Total Weight:</strong> <span id="monthWeight">0</span> kg</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Total Labor Hours:</strong> <span id="monthLabor">0</span></p>
                            <p><strong>Harvests Completed:</strong> <span id="monthHarvests">0</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Performance Metrics (Last 30 Days)</h6>
                </div>
                <div class="card-body">
                    <p><strong>Avg Crew Size:</strong> <span id="avgCrew">0</span> people</p>
                    <p><strong>Avg Productivity:</strong> <span id="avgProductivity">0</span> kg/hour</p>
                    <p><strong>Avg Bunches/Day:</strong> <span id="avgBunches">0</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Harvesting Modal -->
<div class="modal fade" id="addHarvestModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Harvesting Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="harvestingForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harvest Date *</label>
                            <input type="date" class="form-control" name="harvest_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Zone ID *</label>
                            <input type="number" class="form-control" name="zone_id" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Time</label>
                            <input type="time" class="form-control" name="harvesting_time_start">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Time</label>
                            <input type="time" class="form-control" name="harvesting_time_end">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Crew Size</label>
                            <input type="number" class="form-control" name="crew_size" placeholder="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bunches Harvested *</label>
                            <input type="number" class="form-control" name="bunches_harvested" placeholder="0" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Weight Harvested (kg) *</label>
                            <input type="number" step="0.01" class="form-control" name="weight_harvested_kg" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Labor Hours</label>
                            <input type="number" step="0.01" class="form-control" name="labor_hours">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Waste Branches (kg)</label>
                            <input type="number" step="0.01" class="form-control" name="waste_branches_kg">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Weather Conditions</label>
                            <select class="form-select" name="weather_conditions">
                                <option value="clear">Clear</option>
                                <option value="cloudy">Cloudy</option>
                                <option value="rainy">Rainy</option>
                                <option value="stormy">Stormy</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Equipment Used</label>
                        <input type="text" class="form-control" name="equipment_used" placeholder="e.g., Manual cutters, machete">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" name="notes" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveHarvesting()">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    const farmId = 1;
    let currentPage = 1;

    async function loadHarvestingRecords(page = 1) {
        try {
            let url = apiUrl(`api/harvesting?farm_id=${farmId}&page=${page}&per_page=20`;
            
            const dateFrom = document.getElementById('filterDateFrom').value;
            const dateTo = document.getElementById('filterDateTo').value;
            const status = document.getElementById('filterStatus').value;
            
            if (dateFrom) url += `&date_from=${dateFrom}`;
            if (dateTo) url += `&date_to=${dateTo}`;
            if (status) url += `&status=${status}`;

            const response = await fetch(url);
            const data = await response.json();

            if (data.success) {
                renderTable(data.data);
                if (data.pager) {
                    renderPagination(data.pager);
                }
                currentPage = page;
            }
        } catch (e) {
            console.error('Error:', e);
        }
    }

    function renderPagination(pager) {
        const nav = document.getElementById('paginationNav');
        if (!pager || pager.pageCount <= 1) {
            nav.innerHTML = '';
            return;
        }

        let html = '<ul class="pagination mb-0">';

        if (pager.currentPage > 1) {
            html += `<li class="page-item"><a class="page-link" href="#" onclick="loadHarvestingRecords(1)">First</a></li>`;
            html += `<li class="page-item"><a class="page-link" href="#" onclick="loadHarvestingRecords(${pager.currentPage - 1})">Previous</a></li>`;
        }

        for (let i = Math.max(1, pager.currentPage - 2); i <= Math.min(pager.pageCount, pager.currentPage + 2); i++) {
            if (i === pager.currentPage) {
                html += `<li class="page-item active"><span class="page-link">${i}</span></li>`;
            } else {
                html += `<li class="page-item"><a class="page-link" href="#" onclick="loadHarvestingRecords(${i})">${i}</a></li>`;
            }
        }

        if (pager.currentPage < pager.pageCount) {
            html += `<li class="page-item"><a class="page-link" href="#" onclick="loadHarvestingRecords(${pager.currentPage + 1})">Next</a></li>`;
            html += `<li class="page-item"><a class="page-link" href="#" onclick="loadHarvestingRecords(${pager.pageCount})">Last</a></li>`;
        }

        html += '</ul>';
        nav.innerHTML = html;
    }

    function renderTable(records) {
        const tbody = document.getElementById('harvestingTableBody');
        if (records.length === 0) {
            tbody.innerHTML = '<tr><td colspan="10" class="text-center">No records found</td></tr>';
            return;
        }

        tbody.innerHTML = records.map(r => {
            const productivity = r.labor_hours && r.labor_hours > 0 
                ? (r.weight_harvested_kg / r.labor_hours).toFixed(2)
                : '-';
            
            return `
                <tr>
                    <td>${r.harvest_date}</td>
                    <td>${r.harvesting_time_start ? r.harvesting_time_start.substring(0, 5) : '-'}</td>
                    <td>${r.crew_size || '-'}</td>
                    <td>${r.bunches_harvested || '-'}</td>
                    <td>${parseFloat(r.weight_harvested_kg).toLocaleString()}</td>
                    <td>${r.labor_hours || '-'}</td>
                    <td>${productivity} kg/h</td>
                    <td>${r.weather_conditions || '-'}</td>
                    <td><span class="badge bg-success">${r.status}</span></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editHarvest(${r.id})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteHarvest(${r.id})">Delete</button>
                    </td>
                </tr>
            `;
        }).join('');
    }

    async function saveHarvesting() {
        const form = document.getElementById('harvestingForm');
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        data.farm_id = farmId;

        try {
            const response = await fetch(apiUrl('api/harvesting'), {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            });
            const result = await response.json();

            if (result.success) {
                alert('Record saved successfully');
                bootstrap.Modal.getInstance(document.getElementById('addHarvestModal')).hide();
                form.reset();
                loadHarvestingRecords(1);
            } else {
                alert('Error: ' + JSON.stringify(result));
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    }

    async function deleteHarvest(id) {
        if (!confirm('Delete this record?')) return;
        try {
            const response = await fetch(apiUrl(`api/harvesting/${id}`), { method: 'DELETE' });
            const data = await response.json();
            if (data.success) {
                loadHarvestingRecords(currentPage);
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    }

    async function loadHarvestingStats() {
        try {
            const response = await fetch(apiUrl(`api/dashboard/harvesting-stats?farm_id=${farmId}&days=30`));
            const data = await response.json();

            if (data.success && data.stats) {
                const stats = data.stats;
                document.getElementById('monthBunches').textContent = (stats.total_bunches || 0).toLocaleString();
                document.getElementById('monthWeight').textContent = (stats.total_weight || 0).toLocaleString();
                document.getElementById('monthLabor').textContent = (stats.total_labor_hours || 0).toFixed(2);
                document.getElementById('monthHarvests').textContent = stats.total_harvests || 0;
                document.getElementById('avgCrew').textContent = (stats.avg_crew_size || 0).toFixed(1);
                document.getElementById('avgProductivity').textContent = (stats.avg_productivity_per_hour || 0).toFixed(2);
                document.getElementById('avgBunches').textContent = (stats.avg_bunches_per_day || 0).toFixed(0);
            }
        } catch (e) {
            console.error('Error:', e);
        }
    }

    function filterHarvests() {
        loadHarvestingRecords(1);
    }

    window.addEventListener('load', () => {
        loadHarvestingRecords(1);
        loadHarvestingStats();
    });
</script>

<?php echo $this->endSection(); ?>
