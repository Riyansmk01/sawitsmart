<?php echo $this->extend('layouts/app'); ?>

<?php echo $this->section('content'); ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>TBS Management</h2>
            <p class="text-muted">Fresh Palm Bunches (Tandan Buah Segar) Tracking</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTbsModal">
                <i class="fas fa-plus"></i> Add New TBS Record
            </button>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-2">
                    <label class="form-label">Date From</label>
                    <input type="date" class="form-control" id="filterDateFrom">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Date To</label>
                    <input type="date" class="form-control" id="filterDateTo">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Quality Grade</label>
                    <select class="form-select" id="filterQuality">
                        <option value="">All Grades</option>
                        <option value="A">Grade A</option>
                        <option value="B">Grade B</option>
                        <option value="C">Grade C</option>
                        <option value="Reject">Reject</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-secondary w-100" onclick="filterRecords()">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-info w-100" onclick="exportRecords()">
                        <i class="fas fa-download"></i> Export CSV
                    </button>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="fas fa-upload"></i> Import CSV
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- TBS Records Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="tbsTable">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Bunches</th>
                        <th>Weight (kg)</th>
                        <th>Grade</th>
                        <th>Ripeness</th>
                        <th>Damage %</th>
                        <th>Received By</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tbsTableBody">
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <nav class="mt-4" aria-label="Page navigation">
        <ul class="pagination" id="pagination">
        </ul>
    </nav>
</div>

<!-- Add/Edit TBS Modal -->
<div class="modal fade" id="addTbsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add TBS Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="tbsForm">
                    <div class="mb-3">
                        <label class="form-label">Record Date *</label>
                        <input type="date" class="form-control" name="record_date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity (Bunches) *</label>
                        <input type="number" class="form-control" name="quantity_bunches" placeholder="0" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Weight (kg) *</label>
                        <input type="number" step="0.01" class="form-control" name="weight_kg" placeholder="0.00" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quality Grade *</label>
                        <select class="form-select" name="quality_grade" required>
                            <option value="">Select Grade</option>
                            <option value="A">Grade A</option>
                            <option value="B">Grade B</option>
                            <option value="C">Grade C</option>
                            <option value="Reject">Reject</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ripeness Level</label>
                        <select class="form-select" name="ripeness_level">
                            <option value="ripe">Ripe</option>
                            <option value="underripe">Underripe</option>
                            <option value="overripe">Overripe</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Damage Percentage</label>
                        <input type="number" step="0.01" class="form-control" name="damage_percentage" placeholder="0.00">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Received By</label>
                        <input type="text" class="form-control" name="received_by" placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" name="notes" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveTbsRecord()">Save Record</button>
            </div>
        </div>
    </div>
</div>

<!-- Import CSV Modal -->
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import TBS Records from CSV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <small>CSV format: record_date, quantity_bunches, weight_kg, quality_grade, ripeness_level, damage_percentage, received_by</small>
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
    let currentPage = 1;
    const farmId = 1; // Get from session

    async function loadTbsRecords(page = 1) {
        try {
            let url = apiUrl(`api/tbs?farm_id=${farmId}&page=${page}&per_page=20`);
            
            const dateFrom = document.getElementById('filterDateFrom').value;
            const dateTo = document.getElementById('filterDateTo').value;
            const quality = document.getElementById('filterQuality').value;
            
            if (dateFrom) url += `&date_from=${dateFrom}`;
            if (dateTo) url += `&date_to=${dateTo}`;
            if (quality) url += `&quality_grade=${quality}`;

            const response = await fetch(url);
            const data = await response.json();

            if (data.success) {
                renderTable(data.data);
                renderPagination(data.pagination);
                currentPage = page;
            }
        } catch (e) {
            alert('Error loading records: ' + e.message);
        }
    }

    function renderTable(records) {
        const tbody = document.getElementById('tbsTableBody');
        if (records.length === 0) {
            tbody.innerHTML = '<tr><td colspan="9" class="text-center py-4">No records found</td></tr>';
            return;
        }

        tbody.innerHTML = records.map(record => `
            <tr>
                <td>${record.record_date}</td>
                <td>${record.quantity_bunches}</td>
                <td>${parseFloat(record.weight_kg).toLocaleString()}</td>
                <td><span class="badge bg-info">${record.quality_grade}</span></td>
                <td>${record.ripeness_level}</td>
                <td>${parseFloat(record.damage_percentage).toFixed(2)}%</td>
                <td>${record.received_by || '-'}</td>
                <td><span class="badge bg-success">${record.status}</span></td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editTbs(${record.id})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteTbs(${record.id})">Delete</button>
                </td>
            </tr>
        `).join('');
    }

    function renderPagination(pagination) {
        const paginationDiv = document.getElementById('pagination');
        paginationDiv.innerHTML = '';

        if (pagination.total_pages <= 1) return;

        if (pagination.page > 1) {
            paginationDiv.innerHTML += `<li class="page-item"><a class="page-link" onclick="loadTbsRecords(1)">First</a></li>`;
            paginationDiv.innerHTML += `<li class="page-item"><a class="page-link" onclick="loadTbsRecords(${pagination.page - 1})">Previous</a></li>`;
        }

        for (let i = 1; i <= pagination.total_pages; i++) {
            if (i === pagination.page) {
                paginationDiv.innerHTML += `<li class="page-item active"><span class="page-link">${i}</span></li>`;
            } else {
                paginationDiv.innerHTML += `<li class="page-item"><a class="page-link" onclick="loadTbsRecords(${i})">${i}</a></li>`;
            }
        }

        if (pagination.page < pagination.total_pages) {
            paginationDiv.innerHTML += `<li class="page-item"><a class="page-link" onclick="loadTbsRecords(${pagination.page + 1})">Next</a></li>`;
            paginationDiv.innerHTML += `<li class="page-item"><a class="page-link" onclick="loadTbsRecords(${pagination.total_pages})">Last</a></li>`;
        }
    }

    async function saveTbsRecord() {
        const form = document.getElementById('tbsForm');
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        data.farm_id = farmId;

        try {
            const response = await fetch(apiUrl('api/tbs'), {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            });
            const result = await response.json();

            if (result.success) {
                alert('Record saved successfully');
                bootstrap.Modal.getInstance(document.getElementById('addTbsModal')).hide();
                form.reset();
                loadTbsRecords(1);
            } else {
                alert('Error: ' + JSON.stringify(result.errors || result.message));
            }
        } catch (e) {
            alert('Error saving record: ' + e.message);
        }
    }

    async function deleteTbs(id) {
        if (!confirm('Are you sure?')) return;
        
        try {
            const response = await fetch(apiUrl(`api/tbs/${id}`), { method: 'DELETE' });
            const data = await response.json();
            if (data.success) {
                alert('Record deleted');
                loadTbsRecords(currentPage);
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    }

    function filterRecords() {
        loadTbsRecords(1);
    }

    async function exportRecords() {
        let url = apiUrl(`api/export/tbs?farm_id=${farmId}`);
        
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
            a.download = `tbs_records_${new Date().toISOString().split('T')[0]}.csv`;
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
            const response = await fetch(apiUrl('api/import/tbs'), {
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
                    loadTbsRecords(1);
                }, 2000);
            } else {
                alert('Import failed: ' + data.message);
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    }

    // Load on page load
    window.addEventListener('load', () => loadTbsRecords(1));
</script>

<?php echo $this->endSection(); ?>
