<?php

namespace App\Controllers\Api;

use App\Libraries\AlertManager;
use CodeIgniter\API\ResponseTrait;

class AlertsController extends BaseController
{
    use ResponseTrait;

    protected $alertManager;

    public function __construct()
    {
        $this->alertManager = new AlertManager();
    }

    // GET /api/alerts/all - Get all alerts for a farm
    public function getAllAlerts()
    {
        $farmId = $this->request->getVar('farm_id');

        if (!$farmId) {
            return $this->fail('farm_id required', 400);
        }

        try {
            $raw = $this->alertManager->generateAllAlerts($farmId);
            $alerts = $this->formatAlerts($raw);

            return $this->respond([
                'success' => true,
                'data' => $alerts,
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }

    // GET /api/alerts/tbs-target - Check TBS daily target
    public function checkTbsTarget()
    {
        $farmId = $this->request->getVar('farm_id');
        $date = $this->request->getVar('date');

        if (!$farmId) {
            return $this->fail('farm_id required', 400);
        }

        try {
            $alert = $this->alertManager->checkTbsTarget($farmId, $date);

            return $this->respond([
                'success' => true,
                'data' => $alert,
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }

    // GET /api/alerts/extraction-rate - Check extraction rate
    public function checkExtractionRate()
    {
        $farmId = $this->request->getVar('farm_id');
        $days = (int) ($this->request->getVar('days') ?? 7);

        if (!$farmId) {
            return $this->fail('farm_id required', 400);
        }

        try {
            $alert = $this->alertManager->checkExtractionRate($farmId, $days);

            return $this->respond([
                'success' => true,
                'data' => $alert,
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }

    // GET /api/alerts/inventory - Check inventory levels
    public function checkInventory()
    {
        $farmId = $this->request->getVar('farm_id');

        if (!$farmId) {
            return $this->fail('farm_id required', 400);
        }

        try {
            $alert = $this->alertManager->checkInventoryLevels($farmId);

            return $this->respond([
                'success' => true,
                'data' => $alert,
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }

    // GET /api/alerts/quality - Check quality metrics
    public function checkQuality()
    {
        $farmId = $this->request->getVar('farm_id');
        $days = (int) ($this->request->getVar('days') ?? 30);

        if (!$farmId) {
            return $this->fail('farm_id required', 400);
        }

        try {
            $alert = $this->alertManager->checkQualityMetrics($farmId, $days);

            return $this->respond([
                'success' => true,
                'data' => $alert,
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }

    private function formatAlerts(array $raw): array
    {
        $alerts = [];

        if (! empty($raw['tbs_target']) && ($raw['tbs_target']['alert'] ?? '') === 'warning') {
            $alerts[] = [
                'type' => 'Target TBS',
                'severity' => 'warning',
                'message' => 'Penerimaan TBS hari ini ' . ($raw['tbs_target']['percentage'] ?? 0) . '% dari target',
            ];
        }

        if (! empty($raw['extraction_rate']) && ($raw['extraction_rate']['alert'] ?? '') === 'warning') {
            $alerts[] = [
                'type' => 'Rendemen',
                'severity' => 'warning',
                'message' => 'Rendemen minyak di bawah target',
            ];
        }

        if (! empty($raw['inventory']) && ($raw['inventory']['alert'] ?? '') === 'warning') {
            $alerts[] = [
                'type' => 'Inventori',
                'severity' => 'critical',
                'message' => $raw['inventory']['message'] ?? 'Kapasitas penyimpanan hampir penuh',
            ];
        }

        if (! empty($raw['quality']) && ($raw['quality']['alert'] ?? '') === 'warning') {
            $alerts[] = [
                'type' => 'Kualitas',
                'severity' => 'warning',
                'message' => 'Kualitas TBS perlu perhatian',
            ];
        }

        return $alerts;
    }
}
