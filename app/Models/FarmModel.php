<?php

namespace App\Models;

use CodeIgniter\Model;

class FarmModel extends Model
{
    protected $table = 'farms';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'name',
        'location',
        'area_hectares',
        'total_zones',
        'established_date',
        'owner_contact',
        'manager_contact',
        'status',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]|is_unique[farms.name]',
        'location' => 'max_length[255]',
        'area_hectares' => 'decimal',
        'established_date' => 'valid_date[Y-m-d]',
        'status' => 'in_list[active,inactive,maintenance]',
    ];

    protected array $casts = [
        'area_hectares' => 'float',
        'total_zones' => 'integer',
    ];

    // Relationships
    public function zones()
    {
        return $this->hasMany(ZoneModel::class, 'farm_id', 'id');
    }

    public function tbsRecords()
    {
        return $this->hasMany(TbsRecordModel::class, 'farm_id', 'id');
    }

    public function productionRecords()
    {
        return $this->hasMany(ProductionRecordModel::class, 'farm_id', 'id');
    }

    public function settings()
    {
        return $this->hasOne(FarmSettingsModel::class, 'farm_id', 'id');
    }

    public function harvestingRecords()
    {
        return $this->hasMany(HarvestingRecordModel::class, 'farm_id', 'id');
    }
}
