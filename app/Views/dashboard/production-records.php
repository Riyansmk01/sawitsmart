<?php echo $this->extend('layouts/app'); ?>

<?php echo $this->section('content'); ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Production Records</h2>
            <p class="text-muted">Oil and Kernel Production Tracking</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProdModal">
                <i class="fas fa-plus"></i> Add Production Record
            </button>
        </div>
    </div>

    <!-- Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Date From</label>
                    <input type="date" class="form-control" id="filterDateFrom">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Date To</label>
                    <input type="date" class="form-control" id="filterDateTo">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="filterStatus">
                        <option value="">All Status</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="quality_check">Quality Check</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button class="btn btn-secondary flex-grow-1" onclick="filterProduction()">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <button class="btn btn-success" onclick="exportRecords()" title="Export to CSV">
                        <i class="fas fa-download"></i>
                    </button>
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#importModal" title="Import from CSV">
                        <i class="fas fa-upload"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Production Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="productionTable">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Input TBS (kg)</th>
                        <th>Crude Oil (kg)</th>
                        <th>Kernel (kg)</th>
                        <th>Extraction %</th>
                        <th>Processing Hours</th>
                        <th>Equipment</th>
                        <th>Quality</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productionTableBody">
                    <tr>
                        <td colspan="10" class="text-center py-4">
                            <span class="spinner-border spinner-border-sm"></span> Loading...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Production Modal -->
<div class="modal fade" id="addProdModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Production Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="productionForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Production Date *</label>
                            <input type="date" class="form-control" name="production_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Production Time</label>
                            <input type="time" class="form-control" name="production_time">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Input TBS (kg) *</label>
                            <input type="number" step="0.01" class="form-control" name="input_tbs_kg" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Crude Oil (kg) *</label>
                            <input type="number" step="0.01" class="form-control" name="crude_oil_kg" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kernel (kg)</label>
                            <input type="number" step="0.01" class="form-control" name="kernel_kg">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Processing Hours</label>
                            <input type="number" step="0.01" class="form-control" name="processing_hours">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Equipment Used</label>
                            <input type="text" class="form-control" name="equipment_used">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Operator Name</label>
                            <input type="text" class="form-control" name="operator_name">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quality Rating</label>
                        <select class="form-select" name="quality_rating">
                            <option value="good">Good</option>
                            <option value="excellent">Excellent</option>
                            <option value="fair">Fair</option>
                            <option value="poor">Poor</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveProduction()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Import CSV Modal -->
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Production Records from CSV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <small>CSV format: production_date, input_tbs_kg, crude_oil_kg, kernel_kg, processing_hours, equipment_used, operator_name, quality_rating</small>
                </div>
                <form id="importForm">
                    <div class="mb-3">
                        <label class="form-label">Select CSV File *</label>
                        <input type="file" class="form-control" id="importFile" accept=".csv" required>
                    </div>
                    <div id="importProgress" class="progress" style="display:none;">
                        <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                    </div>
                    <div id="importResults" style="display:none;"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="importRecords()">Import</button>
            </div>
        </div>
    </div>
</div>

<script>
    const farmId = 1;
    let currentPage = 1;

    async function loadProduction(page = 1) {
        try {
            let url = apiUrl(`api/production?farm_id=${farmId}&page=${page}&per_page=20`);
            
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
                currentPage = page;
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    }

    function renderTable(records) {
        const tbody = document.getElementById('productionTableBody');
        if (records.length === 0) {
            tbody.innerHTML = '<tr><td colspan="10" class="text-center">No records</td></tr>';
            return;
        }

        tbody.innerHTML = records.map(r => `
            <tr>
                <td>${r.production_date}</td>
                <td>${parseFloat(r.input_tbs_kg).toLocaleString()}</td>
                <td>${parseFloat(r.crude_oil_kg).toLocaleString()}</td>
                <td>${r.kernel_kg ? parseFloat(r.kernel_kg).toLocaleString() : '-'}</td>
                <td>${r.oil_extraction_rate ? parseFloat(r.oil_extraction_rate).toFixed(2) : '-'}%</td>
                <td>${r.processing_hours || '-'}</td>
                <td>${r.equipment_used || '-'}</td>
                <td><span class="badge bg-info">${r.quality_rating}</span></td>
                <td><span class="badge bg-success">${r.status}</span></td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editProd(${r.id})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteProd(${r.id})">Delete</button>
                </td>
            </tr>
        `).join('');
    }

    async function saveProduction() {
        const form = document.getElementById('productionForm');
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        data.farm_id = farmId;

        try {
            const response = await fetch(apiUrl('api/production'), {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            });
            const result = await response.json();

            if (result.success) {
                alert('Saved successfully');
                bootstrap.Modal.getInstance(document.getElementById('addProdModal')).hide();
                form.reset();
                loadProduction(1);
            } else {
                alert('Error: ' + JSON.stringify(result));
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    }

    async function deleteProd(id) {
        if (!confirm('Delete?')) return;
        try {
            const response = await fetch(apiUrl(`api/production/${id}`), { method: 'DELETE' });
            const data = await response.json();
            if (data.success) {
                loadProduction(currentPage);
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    }

    function filterProduction() {
        loadProduction(1);
    }

    async function exportRecords() {
        let url = apiUrl(`api/export/production?farm_id=${farmId}`);
        
        const dateFrom = document.getElementById('filterDateFrom').value;
        const dateTo = document.getElementById('filterDateTo').value;
        
        if (dateFrom) url += `&date_from=${dateFrom}`;
        if (dateTo) url += `&date_to=${dateTo}`;

        try {
            const response = await fetch(url);
            const blob = await response.blob();
            const downloadUrl = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = downloadUrl;
            a.download = `production_records_${new Date().toISOString().split('T')[0]}.csv`;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(downloadUrl);
            document.body.removeChild(a);
        } catch (e) {
            alert('Error exporting: ' + e.message);
        }
    }

    async function importRecords() {
        const fileInput = document.getElementById('importFile');
        const file = fileInput.files[0];

        if (!file) {
            alert('Please select a file');
            return;
        }

        const formData = new FormData();
        formData.append('file', file);
        formData.append('farm_id', farmId);

        document.getElementById('importProgress').style.display = 'block';

        try {
            const response = await fetch(apiUrl('api/import/production'), {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            const resultsDiv = document.getElementById('importResults');
            if (data.success) {
                resultsDiv.innerHTML = `
                    <div class="alert alert-success">
                        <strong>Import Complete!</strong><br>
                        Imported: ${data.imported} records<br>
                        Total rows: ${data.total_rows}<br>
                        ${data.errors.length > 0 ? `Errors: ${data.errors.length}` : ''}
                    </div>
                    ${data.errors.length > 0 ? `<div class="alert alert-warning"><strong>Errors:</strong><ul>${data.errors.map(e => `<li>${e}</li>`).join('')}</ul></div>` : ''}
                `;
                resultsDiv.style.display = 'block';
                
                setTimeout(() => {
                    bootstrap.Modal.getInstance(document.getElementById('importModal')).hide();
                    document.getElementById('importForm').reset();
                    document.getElementById('importResults').style.display = 'none';
                    document.getElementById('importProgress').style.display = 'none';
                    loadProduction(1);
                }, 2000);
            } else {
                alert('Import failed: ' + data.message);
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    }

    window.addEventListener('load', () => loadProduction(1));
</script>

<?php echo $this->endSection(); ?>
