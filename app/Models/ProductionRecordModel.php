<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductionRecordModel extends Model
{
    protected $table = 'production_records';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'farm_id',
        'tbs_record_id',
        'production_date',
        'production_time',
        'input_tbs_kg',
        'crude_oil_kg',
        'kernel_kg',
        'waste_percentage',
        'oil_extraction_rate',
        'processing_hours',
        'equipment_used',
        'operator_name',
        'quality_rating',
        'defects_noted',
        'status',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'farm_id' => 'required|integer|greater_than[0]',
        'production_date' => 'required|valid_date[Y-m-d]',
        'input_tbs_kg' => 'required|decimal|greater_than[0]|less_than_equal_to[50000]',
        'crude_oil_kg' => 'required|decimal|greater_than[0]',
        'kernel_kg' => 'decimal|greater_than_equal_to[0]',
        'processing_hours' => 'decimal|greater_than_equal_to[0]|less_than_equal_to[24]',
        'quality_rating' => 'in_list[excellent,good,fair,poor]',
    ];

    protected array $casts = [
        'farm_id' => 'integer',
        'input_tbs_kg' => 'float',
        'crude_oil_kg' => 'float',
        'kernel_kg' => 'float',
        'oil_extraction_rate' => 'float',
        'processing_hours' => 'float',
    ];

    // Relationships
    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id', 'id');
    }

    public function tbsRecord()
    {
        return $this->belongsTo(TbsRecordModel::class, 'tbs_record_id', 'id');
    }

    // Queries
    public function getMonthlyStats($farmId, $month, $year)
    {
        return $this->selectSum('input_tbs_kg', 'total_input')
                    ->selectSum('crude_oil_kg', 'total_oil')
                    ->selectSum('kernel_kg', 'total_kernel')
                    ->selectAvg('oil_extraction_rate', 'avg_extraction')
                    ->where('farm_id', $farmId)
                    ->where('MONTH(production_date)', $month)
                    ->where('YEAR(production_date)', $year)
                    ->where('status !=', 'archived')
                    ->first();
    }

    public function calculateExtractionRate()
    {
        if ($this->attributes['input_tbs_kg'] > 0) {
            return ($this->attributes['crude_oil_kg'] / $this->attributes['input_tbs_kg']) * 100;
        }
        return 0;
    }
}
