<?php

namespace App\Controllers\Api;

use App\Models\TbsRecordModel;
use App\Models\ProductionRecordModel;
use App\Models\FarmSettingsModel;
use App\Models\HarvestingRecordModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class DashboardController extends Controller
{
    use ResponseTrait;

    /**
     * GET /api/dashboard/daily-summary
     * Get daily TBS and production summary
     */
    public function dailySummary()
    {
        try {
            $farmId = (int) $this->request->getVar('farm_id');
            $date = $this->request->getVar('date') ?? date('Y-m-d');

            if (!$farmId) {
                return $this->fail('Farm ID is required', 400);
            }

            $tbsModel = new TbsRecordModel();
            $prodModel = new ProductionRecordModel();

            $tbsSummary = $tbsModel->getDailySummary($farmId, $date);
            
            $prodSummary = $prodModel->selectSum('input_tbs_kg', 'input_tbs')
                                     ->selectSum('crude_oil_kg', 'oil_produced')
                                     ->selectAvg('oil_extraction_rate', 'avg_extraction')
                                     ->where('farm_id', $farmId)
                                     ->where('DATE(production_date)', $date)
                                     ->first();

            return $this->respond([
                'success' => true,
                'date' => $date,
                'tbs' => $tbsSummary,
                'production' => $prodSummary,
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error: ' . $e->getMessage(), 500);
        }
    }

    /**
     * GET /api/dashboard/monthly-stats
     * Get monthly production statistics
     */
    public function monthlySummary()
    {
        try {
            $farmId = (int) $this->request->getVar('farm_id');
            $month = (int) ($this->request->getVar('month') ?? date('m'));
            $year = (int) ($this->request->getVar('year') ?? date('Y'));

            if (!$farmId) {
                return $this->fail('Farm ID is required', 400);
            }

            $prodModel = new ProductionRecordModel();
            $stats = $prodModel->getMonthlyStats($farmId, $month, $year);

            return $this->respond([
                'success' => true,
                'period' => "{$year}-{$month}",
                'data' => $stats,
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error: ' . $e->getMessage(), 500);
        }
    }

    /**
     * GET /api/dashboard/quality-distribution
     * Get TBS quality grade distribution
     */
    public function qualityDistribution()
    {
        try {
            $farmId = (int) $this->request->getVar('farm_id');
            $days = (int) ($this->request->getVar('days') ?? 7);

            if (!$farmId) {
                return $this->fail('Farm ID is required', 400);
            }

            $tbsModel = new TbsRecordModel();
            $date = date('Y-m-d', strtotime("-{$days} days"));

            $data = $tbsModel->select('quality_grade, COUNT(*) as count, SUM(weight_kg) as weight')
                            ->where('farm_id', $farmId)
                            ->where('record_date >=', $date)
                            ->groupBy('quality_grade')
                            ->findAll();

            return $this->respond([
                'success' => true,
                'days' => $days,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error: ' . $e->getMessage(), 500);
        }
    }

    /**
     * GET /api/dashboard/harvesting-stats
     * Get harvesting statistics
     */
    public function harvestingStats()
    {
        try {
            $farmId = (int) $this->request->getVar('farm_id');
            $days = (int) ($this->request->getVar('days') ?? 30);

            if (!$farmId) {
                return $this->fail('Farm ID is required', 400);
            }

            $harvestModel = new HarvestingRecordModel();
            $date = date('Y-m-d', strtotime("-{$days} days"));

            $stats = $harvestModel->selectSum('bunches_harvested', 'total_bunches')
                                 ->selectSum('weight_harvested_kg', 'total_weight')
                                 ->selectSum('labor_hours', 'total_hours')
                                 ->selectAvg('labor_hours', 'avg_hours')
                                 ->where('farm_id', $farmId)
                                 ->where('harvest_date >=', $date)
                                 ->where('status', 'completed')
                                 ->first();

            return $this->respond([
                'success' => true,
                'period_days' => $days,
                'data' => $stats,
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error: ' . $e->getMessage(), 500);
        }
    }

    /**
     * GET /api/dashboard/top-performing-days
     * Get top production days
     */
    public function topPerformingDays()
    {
        try {
            $farmId = (int) $this->request->getVar('farm_id');
            $days = (int) ($this->request->getVar('days') ?? 30);
            $limit = (int) ($this->request->getVar('limit') ?? 10);

            if (!$farmId) {
                return $this->fail('Farm ID is required', 400);
            }

            $prodModel = new ProductionRecordModel();
            $date = date('Y-m-d', strtotime("-{$days} days"));

            $data = $prodModel->select('DATE(production_date) as date, COUNT(*) as runs, SUM(crude_oil_kg) as oil_kg, ROUND((SUM(crude_oil_kg) / SUM(input_tbs_kg)) * 100, 2) as extraction_rate')
                             ->where('farm_id', $farmId)
                             ->where('production_date >=', $date)
                             ->where('status !=', 'archived')
                             ->groupBy('DATE(production_date)')
                             ->orderBy('oil_kg', 'DESC')
                             ->limit($limit)
                             ->findAll();

            return $this->respond([
                'success' => true,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error: ' . $e->getMessage(), 500);
        }
    }

    /**
     * GET /api/dashboard/kpi
     * Get key performance indicators
     */
    public function getKPI()
    {
        try {
            $farmId = (int) $this->request->getVar('farm_id');

            if (!$farmId) {
                return $this->fail('Farm ID is required', 400);
            }

            $tbsModel = new TbsRecordModel();
            $prodModel = new ProductionRecordModel();
            $farmSettingsModel = new FarmSettingsModel();

            $lastMonth = date('Y-m-d', strtotime('-30 days'));

            $tbsLast30 = $tbsModel->selectSum('weight_kg', 'total')
                                 ->where('farm_id', $farmId)
                                 ->where('record_date >=', $lastMonth)
                                 ->first();

            $oilLast30 = $prodModel->selectSum('crude_oil_kg', 'total')
                                  ->where('farm_id', $farmId)
                                  ->where('production_date >=', $lastMonth)
                                  ->first();

            $avgExtractionRow = $prodModel->selectAvg('oil_extraction_rate', 'avg')
                                      ->where('farm_id', $farmId)
                                      ->where('production_date >=', $lastMonth)
                                      ->first();

            $qualityA_B = $tbsModel->selectCount('id', 'count')
                                  ->whereIn('quality_grade', ['A', 'B'])
                                  ->where('farm_id', $farmId)
                                  ->where('record_date >=', $lastMonth)
                                  ->first();

            $totalRecords = $tbsModel->where('farm_id', $farmId)
                                    ->where('record_date >=', $lastMonth)
                                    ->countAllResults();

            $settings = $farmSettingsModel->where('farm_id', $farmId)->first();
            $targetTbs = (float) ($settings['target_tbs_daily_kg'] ?? 0);
            $targetExtraction = (float) ($settings['target_extraction_rate'] ?? 0);

            $tbsTotal = (float) ($tbsLast30['total'] ?? 0);
            $oilTotal = (float) ($oilLast30['total'] ?? 0);
            $avgExtraction = round((float) ($avgExtractionRow['avg'] ?? 0), 2);
            $qualityPct = $totalRecords > 0 ? round(($qualityA_B['count'] / $totalRecords) * 100, 2) : 0;

            return $this->respond([
                'success' => true,
                'kpi' => [
                    'tbs_received_30d' => $tbsTotal,
                    'oil_produced_30d' => $oilTotal,
                    'avg_extraction_rate' => $avgExtraction,
                    'quality_percentage' => $qualityPct,
                    'tbs_target_met' => $targetTbs > 0 ? $tbsTotal >= ($targetTbs * 30 * 0.8) : true,
                    'oil_target_met' => $oilTotal > 0,
                    'extraction_ok' => $targetExtraction > 0 ? $avgExtraction >= ($targetExtraction * 0.9) : $avgExtraction >= 18,
                    'quality_ok' => $qualityPct >= 70,
                ],
            ]);
        } catch (\Exception $e) {
            return $this->fail('Error: ' . $e->getMessage(), 500);
        }
    }
}
