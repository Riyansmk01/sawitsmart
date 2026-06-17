<?php

namespace App\Models;

use CodeIgniter\Model;

class FarmSettingsModel extends Model
{
    protected $table = 'farm_settings';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'farm_id',
        'target_tbs_daily_kg',
        'target_extraction_rate',
        'target_oil_yield_percentage',
        'maintenance_schedule_days',
        'storage_capacity_kg',
        'operating_hours_per_day',
        'quality_threshold_percentage',
        'alert_inventory_level',
        'currency_code',
        'language_preference',
        'auto_backup_enabled',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'farm_id' => 'required|integer|greater_than[0]',
        'target_tbs_daily_kg' => 'decimal',
        'target_extraction_rate' => 'decimal|greater_than[15]|less_than_equal_to[30]',
        'target_oil_yield_percentage' => 'decimal|greater_than[0]|less_than_equal_to[100]',
        'quality_threshold_percentage' => 'decimal|greater_than_equal_to[50]|less_than_equal_to[100]',
    ];

    protected array $casts = [
        'farm_id' => 'integer',
        'target_tbs_daily_kg' => 'float',
        'target_extraction_rate' => 'float',
        'target_oil_yield_percentage' => 'float',
        'maintenance_schedule_days' => 'integer',
        'storage_capacity_kg' => 'float',
        'operating_hours_per_day' => 'integer',
        'quality_threshold_percentage' => 'float',
        'alert_inventory_level' => 'float',
        'auto_backup_enabled' => 'boolean',
    ];

    // Relationships
    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id', 'id');
    }
}
