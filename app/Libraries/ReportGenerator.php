<?php

namespace App\Libraries;

/**
 * Report Generator Class
 */
class ReportGenerator
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Generate daily report
     */
    public function generateDailyReport($farmId, $date = null)
    {
        if (!$date) {
            $date = date('Y-m-d');
        }

        $tbs = $this->db->table('tbs_records')
            ->where('farm_id', $farmId)
            ->where('DATE(record_date)', 'DATE(?)', [$date])
            ->selectSum('quantity_bunches', 'total_bunches')
            ->selectSum('weight_kg', 'total_weight')
            ->selectAvg('damage_percentage', 'avg_damage')
            ->get()
            ->getRow();

        $production = $this->db->table('production_records')
            ->where('farm_id', $farmId)
            ->where('DATE(production_date)', 'DATE(?)', [$date])
            ->selectSum('crude_oil_kg', 'total_oil')
            ->selectSum('kernel_kg', 'total_kernel')
            ->selectAvg('oil_extraction_rate', 'avg_extraction')
            ->get()
            ->getRow();

        $harvesting = $this->db->table('harvesting_records')
            ->where('farm_id', $farmId)
            ->where('DATE(harvest_date)', 'DATE(?)', [$date])
            ->selectSum('bunches_harvested', 'total_harvested')
            ->selectSum('weight_harvested_kg', 'total_harvest_weight')
            ->selectSum('crew_size', 'total_crew')
            ->get()
            ->getRow();

        return [
            'date' => $date,
            'farm_id' => $farmId,
            'tbs' => $tbs,
            'production' => $production,
            'harvesting' => $harvesting,
        ];
    }

    /**
     * Generate monthly report
     */
    public function generateMonthlyReport($farmId, $month, $year)
    {
        $from = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
        $to = date('Y-m-d', mktime(0, 0, 0, $month + 1, 0, $year));

        $tbs = $this->db->table('tbs_records')
            ->where('farm_id', $farmId)
            ->where('record_date >=', $from)
            ->where('record_date <=', $to)
            ->selectSum('quantity_bunches', 'total_bunches')
            ->selectSum('weight_kg', 'total_weight')
            ->selectAvg('damage_percentage', 'avg_damage')
            ->get()
            ->getRow();

        $production = $this->db->table('production_records')
            ->where('farm_id', $farmId)
            ->where('production_date >=', $from)
            ->where('production_date <=', $to)
            ->selectSum('crude_oil_kg', 'total_oil')
            ->selectSum('kernel_kg', 'total_kernel')
            ->selectAvg('oil_extraction_rate', 'avg_extraction')
            ->get()
            ->getRow();

        $harvesting = $this->db->table('harvesting_records')
            ->where('farm_id', $farmId)
            ->where('harvest_date >=', $from)
            ->where('harvest_date <=', $to)
            ->selectSum('bunches_harvested', 'total_harvested')
            ->selectSum('weight_harvested_kg', 'total_harvest_weight')
            ->selectAvg('crew_size', 'avg_crew')
            ->get()
            ->getRow();

        // Quality distribution
        $qualityDist = $this->db->table('tbs_records')
            ->select('quality_grade, COUNT(*) as count')
            ->where('farm_id', $farmId)
            ->where('record_date >=', $from)
            ->where('record_date <=', $to)
            ->groupBy('quality_grade')
            ->get()
            ->getResultArray();

        return [
            'year' => $year,
            'month' => $month,
            'period_from' => $from,
            'period_to' => $to,
            'farm_id' => $farmId,
            'tbs' => $tbs,
            'production' => $production,
            'harvesting' => $harvesting,
            'quality_distribution' => $qualityDist,
        ];
    }

    /**
     * Generate quarterly report
     */
    public function generateQuarterlyReport($farmId, $quarter, $year)
    {
        $months = [
            1 => [1, 2, 3],
            2 => [4, 5, 6],
            3 => [7, 8, 9],
            4 => [10, 11, 12],
        ];

        $monthList = $months[$quarter];
        $reports = [];
        $totalTbs = 0;
        $totalOil = 0;

        foreach ($monthList as $month) {
            $report = $this->generateMonthlyReport($farmId, $month, $year);
            $reports[] = $report;
            $totalTbs += $report['tbs']->total_weight ?? 0;
            $totalOil += $report['production']->total_oil ?? 0;
        }

        return [
            'year' => $year,
            'quarter' => $quarter,
            'farm_id' => $farmId,
            'monthly_reports' => $reports,
            'total_tbs_kg' => $totalTbs,
            'total_oil_kg' => $totalOil,
            'total_extraction_rate' => $totalTbs > 0 ? ($totalOil / $totalTbs) * 100 : 0,
        ];
    }

    /**
     * Generate KPI report
     */
    public function generateKpiReport($farmId, $days = 30)
    {
        $fromDate = date('Y-m-d', strtotime("-$days days"));
        $toDate = date('Y-m-d');

        $settings = $this->db->table('farm_settings')
            ->where('farm_id', $farmId)
            ->first();

        $tbs = $this->db->table('tbs_records')
            ->where('farm_id', $farmId)
            ->where('record_date >=', $fromDate)
            ->where('record_date <=', $toDate)
            ->selectSum('weight_kg', 'total')
            ->get()
            ->getRow()->total ?? 0;

        $oil = $this->db->table('production_records')
            ->where('farm_id', $farmId)
            ->where('production_date >=', $fromDate)
            ->where('production_date <=', $toDate)
            ->selectSum('crude_oil_kg', 'total')
            ->get()
            ->getRow()->total ?? 0;

        $extraction = $tbs > 0 ? ($oil / $tbs) * 100 : 0;

        $goodQuality = $this->db->table('tbs_records')
            ->whereIn('quality_grade', ['A', 'B'])
            ->where('farm_id', $farmId)
            ->where('record_date >=', $fromDate)
            ->where('record_date <=', $toDate)
            ->countAllResults();

        $totalTbs = $this->db->table('tbs_records')
            ->where('farm_id', $farmId)
            ->where('record_date >=', $fromDate)
            ->where('record_date <=', $toDate)
            ->countAllResults();

        $qualityRatio = $totalTbs > 0 ? ($goodQuality / $totalTbs) * 100 : 0;

        return [
            'period_days' => $days,
            'from_date' => $fromDate,
            'to_date' => $toDate,
            'farm_id' => $farmId,
            'kpis' => [
                'tbs_total_kg' => round($tbs, 2),
                'tbs_daily_average' => round($tbs / $days, 2),
                'tbs_target' => $settings->target_tbs_daily_kg ?? 0,
                'tbs_achievement' => round((($tbs / $days) / ($settings->target_tbs_daily_kg ?? 1)) * 100, 2),
                'oil_total_kg' => round($oil, 2),
                'oil_daily_average' => round($oil / $days, 2),
                'extraction_rate' => round($extraction, 2),
                'extraction_target' => $settings->target_extraction_rate ?? 0,
                'quality_ratio' => round($qualityRatio, 2),
                'quality_target' => $settings->quality_threshold_percentage ?? 80,
            ],
            'status' => 'completed',
        ];
    }

    /**
     * Export report to JSON
     */
    public function exportToJson($report)
    {
        return json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Export report to CSV
     */
    public function exportToCsv($data, $headers = [])
    {
        $csv = '';
        
        // Add headers
        if (!empty($headers)) {
            $csv .= implode(',', $headers) . "\n";
        }

        // Add data rows
        if (is_array($data)) {
            foreach ($data as $row) {
                if (is_array($row)) {
                    $csv .= implode(',', array_values($row)) . "\n";
                }
            }
        }

        return $csv;
    }
}
