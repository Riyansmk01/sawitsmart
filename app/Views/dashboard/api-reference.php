<?php echo $this->extend('layouts/app'); ?>

<?php echo $this->section('content'); ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>API Reference & Documentation</h2>
            <p class="text-muted">Complete API endpoints and database schema reference</p>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs mb-4" id="refTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="schema-tab" data-bs-toggle="tab" href="#schema">Database Schema</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="endpoints-tab" data-bs-toggle="tab" href="#endpoints">API Endpoints</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="models-tab" data-bs-toggle="tab" href="#models">Models</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="examples-tab" data-bs-toggle="tab" href="#examples">Usage Examples</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Schema Tab -->
        <div class="tab-pane fade show active" id="schema">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Database Tables & Fields</h5>
                </div>
                <div class="card-body">
                    <div id="schemaContent" class="row">
                        <div class="col-12 text-center py-4">
                            <span class="spinner-border"></span> Loading schema...
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Endpoints Tab -->
        <div class="tab-pane fade" id="endpoints">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Available API Endpoints</h5>
                </div>
                <div class="card-body">
                    <div id="endpointsContent" class="row">
                        <div class="col-12 text-center py-4">
                            <span class="spinner-border"></span> Loading endpoints...
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Models Tab -->
        <div class="tab-pane fade" id="models">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Available Models</h5>
                </div>
                <div class="card-body">
                    <div id="modelsContent" class="row">
                        <div class="col-12 text-center py-4">
                            <span class="spinner-border"></span> Loading models...
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Examples Tab -->
        <div class="tab-pane fade" id="examples">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Usage Examples</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Fetch TBS Records</h6>
                            <pre><code>fetch('/api/tbs?farm_id=1&page=1')
  .then(r => r.json())
  .then(d => console.log(d))</code></pre>
                        </div>
                        <div class="col-md-6">
                            <h6>Create Production Record</h6>
                            <pre><code>fetch('/api/production', {
  method: 'POST',
  headers: {'Content-Type': 'application/json'},
  body: JSON.stringify({
    farm_id: 1,
    production_date: '2024-01-15',
    input_tbs_kg: 5000,
    crude_oil_kg: 1025
  })
}).then(r => r.json())</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Export TBS to CSV</h6>
                            <pre><code>fetch('/api/export/tbs?farm_id=1&date_from=2024-01-01')
  .then(r => r.blob())
  .then(blob => {
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'tbs_records.csv';
    a.click();
  })</code></pre>
                        </div>
                        <div class="col-md-6">
                            <h6>Get Dashboard KPI</h6>
                            <pre><code>fetch('/api/dashboard/kpi?farm_id=1')
  .then(r => r.json())
  .then(data => {
    console.log('TBS 30d:', data.kpi.tbs_received_30d);
    console.log('Oil 30d:', data.kpi.oil_produced_30d);
    console.log('Extraction:', data.kpi.avg_extraction_rate + '%');
  })</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Load schema
    async function loadSchema() {
        try {
            const response = await fetch(apiUrl('api/docs/schema'));
            const data = await response.json();
            
            let html = '';
            Object.entries(data.tables).forEach(([tableName, table]) => {
                html += `
                    <div class="col-md-6 mb-4">
                        <h6 class="bg-light p-2">${tableName}</h6>
                        <p class="small text-muted">${table.description}</p>
                        <ul class="small">
                            ${Object.entries(table.fields).map(([field, desc]) => 
                                `<li><code>${field}</code>: ${desc}</li>`
                            ).join('')}
                        </ul>
                    </div>
                `;
            });
            document.getElementById('schemaContent').innerHTML = html;
        } catch (e) {
            document.getElementById('schemaContent').innerHTML = `<div class="col-12 alert alert-danger">Error loading schema: ${e.message}</div>`;
        }
    }

    // Load endpoints
    async function loadEndpoints() {
        try {
            const response = await fetch(apiUrl('api/docs/endpoints'));
            const data = await response.json();
            
            let html = '';
            Object.entries(data).forEach(([group, endpoints]) => {
                html += `
                    <div class="col-12 mb-4">
                        <h6 class="bg-light p-2">${group}</h6>
                        <ul class="small">
                            ${Object.entries(endpoints).map(([endpoint, desc]) => 
                                `<li><code style="color: #007bff;">${endpoint}</code> - ${desc}</li>`
                            ).join('')}
                        </ul>
                    </div>
                `;
            });
            document.getElementById('endpointsContent').innerHTML = html;
        } catch (e) {
            document.getElementById('endpointsContent').innerHTML = `<div class="col-12 alert alert-danger">Error loading endpoints: ${e.message}</div>`;
        }
    }

    // Load models
    async function loadModels() {
        try {
            const response = await fetch(apiUrl('api/docs/models'));
            const data = await response.json();
            
            let html = '<div class="col-12"><table class="table table-sm"><tbody>';
            Object.entries(data.models).forEach(([name, path]) => {
                html += `<tr><td><strong>${name}</strong></td><td><code>${path}</code></td></tr>`;
            });
            html += '</tbody></table></div>';
            document.getElementById('modelsContent').innerHTML = html;
        } catch (e) {
            document.getElementById('modelsContent').innerHTML = `<div class="col-12 alert alert-danger">Error loading models: ${e.message}</div>`;
        }
    }

    // Load all on page load
    window.addEventListener('load', () => {
        loadSchema();
        loadEndpoints();
        loadModels();
    });
</script>

<?php echo $this->endSection(); ?>
