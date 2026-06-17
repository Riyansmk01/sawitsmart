<?php

namespace App\Libraries;

use App\Models\FarmSettingsModel;

class AlertManager
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Check if daily TBS target is met
     */
    public function checkTbsTarget($farmId, $date = null)
    {
        $date = $date ?? date('Y-m-d');
        $settingsModel = new FarmSettingsModel();
        $settings = $settingsModel->where('farm_id', $farmId)->first();

        if (!$settings) {
            return null;
        }

        $tbsModel = \Config\Database::connect()
            ->table('tbs_records')
            ->selectSum('weight_kg', 'total_weight')
            ->where('farm_id', $farmId)
            ->where('DATE(record_date)', $date)
            ->get()
            ->getRow();

        $received = $tbsModel->total_weight ?? 0;
        $target = $settings['target_tbs_daily_kg'];
        $percentage = ($received / $target) * 100;

        return [
            'target' => $target,
            'received' => $received,
            'percentage' => round($percentage, 2),
            'alert' => $percentage < 80 ? 'warning' : 'success',
        ];
    }

    /**
     * Check if extraction rate meets target
     */
    public function checkExtractionRate($farmId, $days = 7)
    {
        $settingsModel = new FarmSettingsModel();
        $settings = $settingsModel->where('farm_id', $farmId)->first();

        if (!$settings) {
            return null;
        }

        $dateFrom = date('Y-m-d', strtotime("-$days days"));

        $avgRate = \Config\Database::connect()
            ->table('production_records')
            ->selectAvg('oil_extraction_rate', 'avg_rate')
            ->where('farm_id', $farmId)
            ->where('production_date >=', $dateFrom)
            ->get()
            ->getRow();

        $average = $avgRate->avg_rate ?? 0;
        $target = $settings['target_extraction_rate'];
        $difference = $average - $target;

        return [
            'target' => $target,
            'average' => round($average, 2),
            'difference' => round($difference, 2),
            'alert' => $difference < -1 ? 'warning' : 'success',
            'period_days' => $days,
        ];
    }

    /**
     * Check inventory levels
     */
    public function checkInventoryLevels($farmId)
    {
        $settingsModel = new FarmSettingsModel();
        $settings = $settingsModel->where('farm_id', $farmId)->first();

        if (!$settings) {
            return null;
        }

        $alertLevel = $settings['alert_inventory_level'];

        $inventory = \Config\Database::connect()
            ->table('inventory_logs')
            ->selectMax('id', 'latest_id')
            ->select('product_type, new_balance')
            ->where('farm_id', $farmId)
            ->groupBy('product_type')
            ->get()
            ->getResultArray();

        $alerts = [];
        foreach ($inventory as $item) {
            if ($item['new_balance'] < $alertLevel) {
                $alerts[] = [
                    'product' => $item['product_type'],
                    'balance' => $item['new_balance'],
                    'alert_level' => $alertLevel,
                    'status' => 'warning',
                ];
            }
        }

        return [
            'inventory_items' => count($inventory),
            'alerts_count' => count($alerts),
            'alerts' => $alerts,
        ];
    }

    /**
     * Check quality metrics
     */
    public function checkQualityMetrics($farmId, $days = 30)
    {
        $settingsModel = new FarmSettingsModel();
        $settings = $settingsModel->where('farm_id', $farmId)->first();

        if (!$settings) {
            return null;
        }

        $dateFrom = date('Y-m-d', strtotime("-$days days"));

        $qualityData = \Config\Database::connect()
            ->table('tbs_records')
            ->selectSum('weight_kg', 'total_weight')
            ->where('farm_id', $farmId)
            ->where('record_date >=', $dateFrom)
            ->where('quality_grade IN ("A", "B")')
            ->get()
            ->getRow();

        $totalData = \Config\Database::connect()
            ->table('tbs_records')
            ->selectSum('weight_kg', 'total_weight')
            ->where('farm_id', $farmId)
            ->where('record_date >=', $dateFrom)
            ->get()
            ->getRow();

        $qualityWeight = $qualityData->total_weight ?? 0;
        $totalWeight = $totalData->total_weight ?? 0;
        $percentage = $totalWeight > 0 ? ($qualityWeight / $totalWeight) * 100 : 0;
        $threshold = $settings['quality_threshold_percentage'];

        return [
            'threshold' => $threshold,
            'quality_percentage' => round($percentage, 2),
            'alert' => $percentage < $threshold ? 'warning' : 'success',
            'period_days' => $days,
        ];
    }

    /**
     * Generate all alerts for farm
     */
    public function generateAllAlerts($farmId)
    {
        return [
            'tbs_target' => $this->checkTbsTarget($farmId),
            'extraction_rate' => $this->checkExtractionRate($farmId),
            'inventory' => $this->checkInventoryLevels($farmId),
            'quality' => $this->checkQualityMetrics($farmId),
            'generated_at' => date('Y-m-d H:i:s'),
        ];
    }
}
