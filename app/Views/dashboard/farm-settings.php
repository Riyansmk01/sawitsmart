<?php echo $this->extend('layouts/app'); ?>

<?php echo $this->section('content'); ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>Farm Settings</h2>
            <p class="text-muted">Configure farm parameters and operational targets</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Production Targets</h5>
                </div>
                <div class="card-body">
                    <form id="settingsForm">
                        <div class="mb-3">
                            <label class="form-label">Target TBS Daily (kg)</label>
                            <input type="number" step="0.01" class="form-control" name="target_tbs_daily_kg" placeholder="5000">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Target Extraction Rate (%)</label>
                            <input type="number" step="0.01" class="form-control" name="target_extraction_rate" placeholder="20.5" min="15" max="30">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Target Oil Yield (%)</label>
                            <input type="number" step="0.01" class="form-control" name="target_oil_yield_percentage" placeholder="22">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Storage Capacity (kg)</label>
                            <input type="number" step="0.01" class="form-control" name="storage_capacity_kg" placeholder="50000">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quality Threshold (%)</label>
                            <input type="number" step="0.01" class="form-control" name="quality_threshold_percentage" placeholder="80" min="50" max="100">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Operating Hours Per Day</label>
                            <input type="number" class="form-control" name="operating_hours_per_day" placeholder="8" min="1" max="24">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Maintenance Schedule (Days)</label>
                            <input type="number" class="form-control" name="maintenance_schedule_days" placeholder="30">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Language Preference</label>
                            <select class="form-select" name="language_preference">
                                <option value="en">English</option>
                                <option value="id">Indonesian</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="auto_backup_enabled" id="autoBackup" checked>
                                <label class="form-check-label" for="autoBackup">
                                    Enable Auto Backup
                                </label>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="saveSettings()">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quick Info</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Farm ID</small>
                        <p class="mb-0" id="farmId">-</p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Currency</small>
                        <p class="mb-0" id="currency">USD</p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Last Updated</small>
                        <p class="mb-0" id="lastUpdated">-</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const farmId = 1;

    async function loadSettings() {
        try {
            const response = await fetch(apiUrl(`api/farm-settings?farm_id=${farmId}`));
            const data = await response.json();

            if (data.success) {
                const settings = data.data;
                document.getElementById('farmId').textContent = settings.farm_id;
                document.getElementById('lastUpdated').textContent = settings.updated_at || settings.created_at;
                
                // Populate form
                Object.keys(settings).forEach(key => {
                    const field = document.querySelector(`[name="${key}"]`);
                    if (field) {
                        if (field.type === 'checkbox') {
                            field.checked = settings[key] == true || settings[key] == 1;
                        } else {
                            field.value = settings[key] || '';
                        }
                    }
                });
            }
        } catch (e) {
            console.error('Error loading settings:', e);
        }
    }

    async function saveSettings() {
        const form = document.getElementById('settingsForm');
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        data.farm_id = farmId;
        data.auto_backup_enabled = form.querySelector('[name="auto_backup_enabled"]').checked ? 1 : 0;

        try {
            const response = await fetch(apiUrl('api/farm-settings'), {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            });
            const result = await response.json();

            if (result.success) {
                alert('Settings saved successfully');
                loadSettings();
            } else {
                alert('Error: ' + JSON.stringify(result));
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    }

    window.addEventListener('load', () => loadSettings());
</script>

<?php echo $this->endSection(); ?>
