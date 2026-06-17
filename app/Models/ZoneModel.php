<?php

namespace App\Models;

use CodeIgniter\Model;

class ZoneModel extends Model
{
    protected $table = 'zones';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'farm_id',
        'zone_code',
        'name',
        'area_hectares',
        'planted_date',
        'expected_harvest_start',
        'crop_age_months',
        'soil_type',
        'status',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'farm_id' => 'required|integer|greater_than[0]',
        'zone_code' => 'required|max_length[50]',
        'name' => 'required|max_length[255]',
        'area_hectares' => 'decimal',
        'status' => 'in_list[active,replanting,fallow,maintenance]',
    ];

    protected array $casts = [
        'farm_id' => 'integer',
        'area_hectares' => 'float',
        'crop_age_months' => 'integer',
    ];

    // Relationships
    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id', 'id');
    }

    public function tbsRecords()
    {
        return $this->hasMany(TbsRecordModel::class, 'zone_id', 'id');
    }

    public function harvestingRecords()
    {
        return $this->hasMany(HarvestingRecordModel::class, 'zone_id', 'id');
    }
}
