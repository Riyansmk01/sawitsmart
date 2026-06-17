<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;

class StatusController extends BaseController
{
    use ResponseTrait;

    // GET /api/status/health - Health check
    public function health()
    {
        $db = \Config\Database::connect();
        
        try {
            // Test database connection
            $db->connect();
            $dbStatus = 'healthy';
        } catch (\Exception $e) {
            $dbStatus = 'unhealthy';
        }

        return $this->respond([
            'success' => true,
            'status' => 'operational',
            'database' => $dbStatus,
            'database_connected' => $dbStatus === 'healthy',
            'timestamp' => date('Y-m-d H:i:s'),
        ]);
    }

    // GET /api/status/system - System information
    public function system()
    {
        if (! session()->has('user_id')) {
            return $this->failUnauthorized('Login diperlukan');
        }

        $db = \Config\Database::connect();

        // Database stats
        $tables = [
            'farms' => $db->table('farms')->countAllResults(),
            'zones' => $db->table('zones')->countAllResults(),
            'tbs_records' => $db->table('tbs_records')->countAllResults(),
            'production_records' => $db->table('production_records')->countAllResults(),
            'harvesting_records' => $db->table('harvesting_records')->countAllResults(),
        ];

        $latestRecords = [
            'tbs' => $db->table('tbs_records')
                ->orderBy('created_at', 'DESC')
                ->limit(1)
                ->get()
                ->getRow(),
            'production' => $db->table('production_records')
                ->orderBy('created_at', 'DESC')
                ->limit(1)
                ->get()
                ->getRow(),
        ];

        return $this->respond([
            'success' => true,
            'system' => [
                'php_version' => phpversion(),
                'php_sapi' => php_sapi_name(),
                'os' => php_uname('s'),
                'memory_limit' => ini_get('memory_limit'),
                'max_execution_time' => ini_get('max_execution_time'),
            ],
            'database' => [
                'driver' => $db->DBDriver,
                'version' => $db->getVersion(),
            ],
            'records' => $tables,
            'latest_records' => $latestRecords,
            'timestamp' => date('Y-m-d H:i:s'),
        ]);
    }

    // GET /api/status/summary - Overall summary
    public function summary()
    {
        if (! session()->has('user_id')) {
            return $this->failUnauthorized('Login diperlukan');
        }

        $db = \Config\Database::connect();

        $farms = $db->table('farms')->countAllResults();
        $tbsTotal = $db->table('tbs_records')
            ->selectSum('weight_kg', 'total')
            ->get()
            ->getRow()->total ?? 0;
        $oilTotal = $db->table('production_records')
            ->selectSum('crude_oil_kg', 'total')
            ->get()
            ->getRow()->total ?? 0;

        return $this->respond([
            'success' => true,
            'summary' => [
                'total_farms' => $farms,
                'total_tbs_kg' => round($tbsTotal, 2),
                'total_oil_kg' => round($oilTotal, 2),
                'average_extraction_rate' => round($oilTotal > 0 && $tbsTotal > 0 ? ($oilTotal / $tbsTotal) * 100 : 0, 2),
            ],
            'timestamp' => date('Y-m-d H:i:s'),
        ]);
    }
}
