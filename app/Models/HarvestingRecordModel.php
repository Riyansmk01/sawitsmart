<?php

namespace App\Models;

use CodeIgniter\Model;

class HarvestingRecordModel extends Model
{
    protected $table = 'harvesting_records';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'farm_id',
        'zone_id',
        'harvest_date',
        'harvesting_time_start',
        'harvesting_time_end',
        'crew_size',
        'bunches_harvested',
        'weight_harvested_kg',
        'labor_hours',
        'waste_branches_kg',
        'weather_conditions',
        'equipment_used',
        'notes',
        'status',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'farm_id' => 'required|integer|greater_than[0]',
        'zone_id' => 'required|integer|greater_than[0]',
        'harvest_date' => 'required|valid_date[Y-m-d]',
        'bunches_harvested' => 'integer|greater_than_equal_to[0]',
        'weight_harvested_kg' => 'decimal|greater_than_equal_to[0]',
        'labor_hours' => 'decimal|greater_than_equal_to[0]',
    ];

    protected array $casts = [
        'farm_id' => 'integer',
        'zone_id' => 'integer',
        'crew_size' => 'integer',
        'bunches_harvested' => 'integer',
        'weight_harvested_kg' => 'float',
        'labor_hours' => 'float',
    ];

    // Relationships
    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id', 'id');
    }

    public function zone()
    {
        return $this->belongsTo(ZoneModel::class, 'zone_id', 'id');
    }
}
