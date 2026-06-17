<?php

namespace App\Controllers;

use App\Models\ActivityLogModel;
use App\Libraries\ActivityLogger;

class ActivityLogs extends BaseController
{
    protected $model;
    protected $logger;

    public function __construct()
    {
        $this->model = new ActivityLogModel();
        $this->logger = new ActivityLogger();
    }

    public function index()
    {
        $page = $this->request->getVar('page', 1);
        $perPage = 50;

        $logs = $this->model
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage, 'default', $page);

        $data = [
            'title' => 'Activity Logs',
            'logs' => $logs,
            'pager' => $this->model->pager,
        ];

        return view('admin/activity_logs', $data);
    }

    public function stats()
    {
        $days = $this->request->getVar('days', 30);
        
        $stats = $this->model->getActivityStats($days);
        $recent = $this->model->getRecentActivity(20);

        $data = [
            'title' => 'Activity Statistics',
            'stats' => $stats,
            'recent' => $recent,
            'days' => $days,
        ];

        return view('admin/activity_stats', $data);
    }

    public function byEntity($entityType = null, $entityId = null)
    {
        if (!$entityType || !$entityId) {
            return redirect()->back()->with('error', 'Invalid parameters');
        }

        $logs = $this->model->getActivityByEntity($entityType, $entityId);

        $data = [
            'title' => "Activity: $entityType #$entityId",
            'logs' => $logs,
        ];

        return view('admin/activity_logs', $data);
    }

    public function clear()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->back();
        }

        $days = $this->request->getPost('days', 90);
        
        $deleted = $this->logger->clearOldLogs($days);

        return redirect()->back()->with('success', "Deleted $deleted old activity logs");
    }
}
