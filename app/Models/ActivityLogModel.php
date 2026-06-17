<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'user_id',
        'action',
        'entity_type',
        'entity_id',
        'details',
        'ip_address',
        'user_agent',
        'created_at',
    ];
    protected $useTimestamps = false;

    // Relationships
    public function user()
    {
        return $this->belongsTo('App\Models\UserModel', 'user_id', 'id');
    }

    // Custom Methods
    public function getActivityByUser($userId, $limit = 50)
    {
        return $this->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function getActivityByEntity($entityType, $entityId)
    {
        return $this->where('entity_type', $entityType)
            ->where('entity_id', $entityId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function getActivityByDateRange($from, $to, $limit = 100)
    {
        return $this->where('created_at >=', $from . ' 00:00:00')
            ->where('created_at <=', $to . ' 23:59:59')
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function getActivityStats($days = 30)
    {
        $dateFrom = date('Y-m-d', strtotime("-$days days"));

        return $this->selectCount('id', 'total')
            ->selectCount('id', 'creates', 'action = "create"')
            ->selectCount('id', 'updates', 'action = "update"')
            ->selectCount('id', 'deletes', 'action = "delete"')
            ->where('created_at >=', $dateFrom)
            ->first();
    }

    public function getRecentActivity($limit = 10)
    {
        return $this->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }
}
