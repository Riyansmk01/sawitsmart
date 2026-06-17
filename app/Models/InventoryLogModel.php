<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryLogModel extends Model
{
    protected $table = 'inventory_logs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'farm_id',
        'product_type',
        'movement_type',
        'quantity_kg',
        'previous_balance',
        'new_balance',
        'reason',
        'reference_id',
        'reference_table',
        'recorded_by',
        'transaction_date',
    ];

    protected array $casts = [
        'farm_id' => 'integer',
        'quantity_kg' => 'float',
        'previous_balance' => 'float',
        'new_balance' => 'float',
        'reference_id' => 'integer',
        'transaction_date' => 'datetime',
    ];

    // Relationships
    public function farm()
    {
        return $this->belongsTo(FarmModel::class, 'farm_id', 'id');
    }

    // Queries
    public function getMovementByProductType($farmId, $productType)
    {
        return $this->where('farm_id', $farmId)
                    ->where('product_type', $productType)
                    ->orderBy('transaction_date', 'DESC')
                    ->findAll();
    }

    public function getBalance($farmId, $productType)
    {
        $log = $this->where('farm_id', $farmId)
                   ->where('product_type', $productType)
                   ->orderBy('transaction_date', 'DESC')
                   ->first();
        
        return $log ? $log['new_balance'] : 0;
    }
}
