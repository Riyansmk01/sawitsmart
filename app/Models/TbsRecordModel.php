<?php

namespace App\Models;

use CodeIgniter\Model;

class TbsRecordModel extends Model
{
    protected $table = 'tbs_records';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'farm_id',
        'zone_id',
        'record_date',
        'collection_time',
        'quantity_bunches',
        'weight_kg',
        'quality_grade',
        'ripeness_level',
        'damage_percentage',
        'loose_fruits_percentage',
        'received_by',
        'storage_location',
        'notes',
        'status',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'farm_id' => 'required|integer|greater_than[0]',
        'record_date' => 'required|valid_date[Y-m-d]',
        'quantity_bunches' => 'required|integer|greater_than[0]|less_than_equal_to[10000]',
        'weight_kg' => 'required|decimal|greater_than[0]|less_than_equal_to[50000]',
        'quality_grade' => 'required|in_list[A,B,C,Reject]',
        'ripeness_level' => 'in_list[underripe,ripe,overripe]',
        'damage_percentage' => 'decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
        'loose_fruits_percentage' => 'decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
    ];

    protected array $casts = [
        'farm_id' => 'integer',
        'zone_id' => 'integer',
        'quantity_bunches' => 'integer',
        'weight_kg' => 'float',
        'damage_percentage' => 'float',
        'loose_fruits_percentage' => 'float',
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

    public function productionRecords()
    {
        return $this->hasMany(ProductionRecordModel::class, 'tbs_record_id', 'id');
    }

    // Scopes
    public function byFarm($farmId)
    {
        return $this->where('farm_id', $farmId);
    }

    public function byDateRange($fromDate, $toDate)
    {
        return $this->where('record_date >=', $fromDate)
                    ->where('record_date <=', $toDate);
    }

    public function byQualityGrade($grade)
    {
        return $this->where('quality_grade', $grade);
    }

    public function activeStatus()
    {
        return $this->whereIn('status', ['received', 'processed']);
    }

    // Queries
    public function getDailySummary($farmId, $date)
    {
        return $this->selectSum('quantity_bunches', 'total_bunches')
                    ->selectSum('weight_kg', 'total_weight')
                    ->selectAvg('damage_percentage', 'avg_damage')
                    ->where('farm_id', $farmId)
                    ->where('DATE(record_date)', $date)
                    ->first();
    }
}
