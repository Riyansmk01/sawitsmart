<?php

namespace App\Libraries;

class ActivityLogger
{
    protected $db;
    protected $table = 'activity_logs';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Log an activity
     * 
     * @param string $action - Action performed (create, update, delete, view)
     * @param string $entity - Entity type (tbs_record, production_record, etc)
     * @param int $entityId - ID of entity
     * @param int $userId - User performing action
     * @param array $details - Additional details
     */
    public function log($action, $entity, $entityId, $userId, $details = [])
    {
        $data = [
            'user_id' => $userId,
            'action' => $action,
            'entity_type' => $entity,
            'entity_id' => $entityId,
            'details' => json_encode($details),
            'ip_address' => \Config\Services::request()->getIPAddress(),
            'user_agent' => \Config\Services::request()->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $this->db->table($this->table)->insert($data);
    }

    /**
     * Get activity logs with filters
     */
    public function getLogs($filters = [])
    {
        $query = $this->db->table($this->table);

        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (!empty($filters['entity_type'])) {
            $query->where('entity_type', $filters['entity_type']);
        }

        if (!empty($filters['action'])) {
            $query->where('action', $filters['action']);
        }

        if (!empty($filters['date_from'])) {
            $query->where('created_at >=', $filters['date_from'] . ' 00:00:00');
        }

        if (!empty($filters['date_to'])) {
            $query->where('created_at <=', $filters['date_to'] . ' 23:59:59');
        }

        return $query->orderBy('created_at', 'DESC')
            ->limit($filters['limit'] ?? 100)
            ->get()
            ->getResultArray();
    }

    /**
     * Get activity count for dashboard
     */
    public function getActivityStats($daysBack = 30)
    {
        $date = date('Y-m-d', strtotime("-$daysBack days"));

        $query = $this->db->table($this->table)
            ->selectCount('id', 'total_activities')
            ->selectCount('id', 'creates', 'action = "create"')
            ->selectCount('id', 'updates', 'action = "update"')
            ->selectCount('id', 'deletes', 'action = "delete"')
            ->where('created_at >=', $date)
            ->get()
            ->getRow();

        return $query;
    }

    /**
     * Clear old logs (retention policy)
     */
    public function clearOldLogs($daysOld = 90)
    {
        $date = date('Y-m-d', strtotime("-$daysOld days"));
        return $this->db->table($this->table)
            ->where('created_at <', $date)
            ->delete();
    }
}
