<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;

class DocumentationController extends BaseController
{
    use ResponseTrait;

    // GET /api/docs/schema - Database schema documentation
    public function schema()
    {
        $schema = [
            'version' => '1.0',
            'tables' => [
                'farms' => [
                    'description' => 'Farm master data',
                    'fields' => [
                        'id' => 'Primary key',
                        'name' => 'Farm name',
                        'location' => 'Geographic location',
                        'area_hectares' => 'Farm area in hectares',
                        'established_date' => 'When farm was established',
                        'contact_person' => 'Contact name',
                        'contact_phone' => 'Contact phone number',
                        'contact_email' => 'Contact email',
                        'status' => 'Farm status (active/inactive/maintenance)',
                    ],
                ],
                'zones' => [
                    'description' => 'Farm zones/divisions',
                    'fields' => [
                        'id' => 'Primary key',
                        'farm_id' => 'Foreign key to farms',
                        'zone_code' => 'Unique zone code',
                        'name' => 'Zone name',
                        'area_hectares' => 'Zone area',
                        'planted_date' => 'When zone was planted',
                        'crop_age_months' => 'Crop age in months',
                        'soil_type' => 'Type of soil',
                    ],
                ],
                'tbs_records' => [
                    'description' => 'Fresh palm bunch records',
                    'fields' => [
                        'id' => 'Primary key',
                        'farm_id' => 'Foreign key to farms',
                        'zone_id' => 'Foreign key to zones',
                        'record_date' => 'Date of TBS receipt',
                        'quantity_bunches' => 'Number of bunches',
                        'weight_kg' => 'Weight in kilograms',
                        'quality_grade' => 'Quality grade (A/B/C/Reject)',
                        'ripeness_level' => 'Ripeness (ripe/underripe/overripe)',
                        'damage_percentage' => 'Damage percentage',
                        'loose_fruits_percentage' => 'Loose fruits percentage',
                        'received_by' => 'Person who received TBS',
                        'storage_location' => 'Where TBS is stored',
                        'notes' => 'Additional notes',
                        'status' => 'Record status',
                    ],
                ],
                'production_records' => [
                    'description' => 'Oil and kernel production records',
                    'fields' => [
                        'id' => 'Primary key',
                        'farm_id' => 'Foreign key to farms',
                        'tbs_record_id' => 'Link to TBS record',
                        'production_date' => 'Date of production',
                        'input_tbs_kg' => 'Input TBS weight',
                        'crude_oil_kg' => 'Crude oil output',
                        'kernel_kg' => 'Kernel output',
                        'oil_extraction_rate' => 'Calculated extraction rate %',
                        'processing_hours' => 'Hours spent on processing',
                        'equipment_used' => 'Equipment names',
                        'operator_name' => 'Operator name',
                        'quality_rating' => 'Quality rating',
                        'defects_noted' => 'Any defects',
                        'status' => 'Record status',
                    ],
                ],
                'harvesting_records' => [
                    'description' => 'Harvesting operation records',
                    'fields' => [
                        'id' => 'Primary key',
                        'farm_id' => 'Foreign key to farms',
                        'zone_id' => 'Foreign key to zones',
                        'harvest_date' => 'Date of harvest',
                        'crew_size' => 'Number of crew members',
                        'bunches_harvested' => 'Number of bunches',
                        'weight_harvested_kg' => 'Weight harvested',
                        'labor_hours' => 'Total labor hours',
                        'weather_conditions' => 'Weather conditions',
                        'waste_branches_kg' => 'Waste branches weight',
                        'equipment_used' => 'Equipment used',
                        'status' => 'Record status',
                    ],
                ],
                'farm_settings' => [
                    'description' => 'Farm operational settings',
                    'fields' => [
                        'id' => 'Primary key',
                        'farm_id' => 'Foreign key to farms (unique)',
                        'target_tbs_daily_kg' => 'Daily TBS target',
                        'target_extraction_rate' => 'Target extraction rate %',
                        'target_oil_yield_percentage' => 'Target oil yield %',
                        'maintenance_schedule_days' => 'Maintenance schedule interval',
                        'storage_capacity_kg' => 'Storage capacity',
                        'operating_hours_per_day' => 'Daily operating hours',
                        'quality_threshold_percentage' => 'Quality threshold %',
                        'alert_inventory_level' => 'Alert level for inventory',
                        'currency_code' => 'Currency code',
                        'language_preference' => 'UI language',
                        'auto_backup_enabled' => 'Auto backup flag',
                    ],
                ],
                'inventory_logs' => [
                    'description' => 'Inventory movement tracking',
                    'fields' => [
                        'id' => 'Primary key',
                        'farm_id' => 'Foreign key to farms',
                        'product_type' => 'Type of product',
                        'movement_type' => 'Type of movement',
                        'quantity_kg' => 'Quantity in kg',
                        'previous_balance' => 'Previous inventory balance',
                        'new_balance' => 'New balance after movement',
                        'reason' => 'Reason for movement',
                        'recorded_by' => 'Who recorded this',
                        'transaction_date' => 'Date of transaction',
                    ],
                ],
                'activity_logs' => [
                    'description' => 'Audit trail for all activities',
                    'fields' => [
                        'id' => 'Primary key',
                        'user_id' => 'User who performed action',
                        'action' => 'Action type',
                        'entity_type' => 'Type of entity modified',
                        'entity_id' => 'ID of entity modified',
                        'details' => 'JSON details of changes',
                        'ip_address' => 'IP address of user',
                        'user_agent' => 'Browser user agent',
                        'created_at' => 'Timestamp of action',
                    ],
                ],
            ],
        ];

        return $this->respond($schema);
    }

    // GET /api/docs/endpoints - API endpoints documentation
    public function endpoints()
    {
        $endpoints = [
            'Farms API' => [
                'GET /api/farms' => 'List all farms with pagination',
                'POST /api/farms' => 'Create new farm',
                'GET /api/farms/:id' => 'Get farm details',
                'PUT /api/farms/:id' => 'Update farm',
                'DELETE /api/farms/:id' => 'Delete farm',
                'GET /api/farms/:id/summary' => 'Get farm summary with stats',
            ],
            'Zones API' => [
                'GET /api/zones' => 'List zones for a farm',
                'POST /api/zones' => 'Create new zone',
                'GET /api/zones/:id' => 'Get zone details',
                'PUT /api/zones/:id' => 'Update zone',
                'DELETE /api/zones/:id' => 'Delete zone',
            ],
            'TBS Records API' => [
                'GET /api/tbs' => 'List TBS records with filtering',
                'POST /api/tbs' => 'Create TBS record',
                'GET /api/tbs/:id' => 'Get TBS record',
                'PUT /api/tbs/:id' => 'Update TBS record',
                'DELETE /api/tbs/:id' => 'Delete TBS record',
                'GET /api/tbs/farm/daily-summary' => 'Get daily TBS summary',
            ],
            'Production API' => [
                'GET /api/production' => 'List production records',
                'POST /api/production' => 'Create production record',
                'GET /api/production/:id' => 'Get production record',
                'PUT /api/production/:id' => 'Update production record',
                'DELETE /api/production/:id' => 'Delete production record',
            ],
            'Harvesting API' => [
                'GET /api/harvesting' => 'List harvesting records',
                'POST /api/harvesting' => 'Create harvesting record',
                'GET /api/harvesting/:id' => 'Get harvesting record',
                'PUT /api/harvesting/:id' => 'Update harvesting record',
                'DELETE /api/harvesting/:id' => 'Delete harvesting record',
            ],
            'Dashboard API' => [
                'GET /api/dashboard/daily-summary' => 'Get daily summary',
                'GET /api/dashboard/monthly-stats' => 'Get monthly statistics',
                'GET /api/dashboard/quality-distribution' => 'Get quality distribution',
                'GET /api/dashboard/harvesting-stats' => 'Get harvesting stats',
                'GET /api/dashboard/top-days' => 'Get top performing days',
                'GET /api/dashboard/kpi' => 'Get KPI metrics',
            ],
            'Alerts API' => [
                'GET /api/alerts/all' => 'Get all active alerts',
                'GET /api/alerts/tbs-target' => 'Check TBS target alerts',
                'GET /api/alerts/extraction-rate' => 'Check extraction rate alerts',
                'GET /api/alerts/inventory' => 'Check inventory alerts',
                'GET /api/alerts/quality' => 'Check quality alerts',
            ],
            'Import/Export API' => [
                'POST /api/import/tbs' => 'Import TBS from CSV',
                'POST /api/import/production' => 'Import production from CSV',
                'GET /api/export/tbs' => 'Export TBS to CSV',
                'GET /api/export/production' => 'Export production to CSV',
            ],
            'System Status API' => [
                'GET /api/status/health' => 'Health check',
                'GET /api/status/system' => 'System information',
                'GET /api/status/summary' => 'Overall summary',
            ],
        ];

        return $this->respond($endpoints);
    }

    // GET /api/docs/models - Available models documentation
    public function models()
    {
        $models = [
            'Farm' => 'app/Models/FarmModel.php',
            'Zone' => 'app/Models/ZoneModel.php',
            'TbsRecord' => 'app/Models/TbsRecordModel.php',
            'ProductionRecord' => 'app/Models/ProductionRecordModel.php',
            'HarvestingRecord' => 'app/Models/HarvestingRecordModel.php',
            'FarmSettings' => 'app/Models/FarmSettingsModel.php',
            'InventoryLog' => 'app/Models/InventoryLogModel.php',
            'ActivityLog' => 'app/Models/ActivityLogModel.php',
            'ApiKey' => 'app/Models/ApiKeyModel.php',
        ];

        return $this->respond([
            'models' => $models,
            'count' => count($models),
        ]);
    }
}
