<?php

namespace App\Controllers\Api;

use App\Models\TbsRecordModel;
use App\Models\ProductionRecordModel;
use CodeIgniter\API\ResponseTrait;

class ImportExportController extends BaseController
{
    use ResponseTrait;

    protected $tbsModel;
    protected $productionModel;

    public function __construct()
    {
        $this->tbsModel = new TbsRecordModel();
        $this->productionModel = new ProductionRecordModel();
    }

    // POST /api/import/tbs - Import TBS records from CSV
    public function importTbs()
    {
        $file = $this->request->getFile('file');
        
        if (!$file || !$file->isValid()) {
            return $this->fail('No file uploaded', 400);
        }

        if ($file->getMimeType() !== 'text/csv' && $file->getExtension() !== 'csv') {
            return $this->fail('Only CSV files allowed', 400);
        }

        $farmId = $this->request->getVar('farm_id');
        if (!$farmId) {
            return $this->fail('farm_id required', 400);
        }

        $handle = fopen($file->getTempName(), 'r');
        if (!$handle) {
            return $this->fail('Cannot read file', 500);
        }

        $header = fgetcsv($handle);
        $imported = 0;
        $errors = [];
        $row = 0;

        while (($data = fgetcsv($handle)) !== false) {
            $row++;
            
            if (count($data) < 6) {
                $errors[] = "Row $row: Insufficient columns";
                continue;
            }

            $record = [
                'farm_id' => $farmId,
                'record_date' => trim($data[0]),
                'quantity_bunches' => (int) trim($data[1]),
                'weight_kg' => (float) trim($data[2]),
                'quality_grade' => strtoupper(trim($data[3])),
                'ripeness_level' => trim($data[4]) ?: 'ripe',
                'damage_percentage' => (float) trim($data[5]) ?: 0,
                'received_by' => trim($data[6] ?? ''),
                'status' => 'received'
            ];

            if (!$this->tbsModel->validate($record)) {
                $errors[] = "Row $row: " . implode(', ', $this->tbsModel->errors());
                continue;
            }

            try {
                $this->tbsModel->insert($record);
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Row $row: " . $e->getMessage();
            }
        }

        fclose($handle);

        return $this->respond([
            'success' => true,
            'message' => "$imported records imported",
            'imported' => $imported,
            'errors' => $errors,
            'total_rows' => $row
        ]);
    }

    // POST /api/import/production - Import production records from CSV
    public function importProduction()
    {
        $file = $this->request->getFile('file');
        
        if (!$file || !$file->isValid()) {
            return $this->fail('No file uploaded', 400);
        }

        if ($file->getMimeType() !== 'text/csv' && $file->getExtension() !== 'csv') {
            return $this->fail('Only CSV files allowed', 400);
        }

        $farmId = $this->request->getVar('farm_id');
        if (!$farmId) {
            return $this->fail('farm_id required', 400);
        }

        $handle = fopen($file->getTempName(), 'r');
        if (!$handle) {
            return $this->fail('Cannot read file', 500);
        }

        $header = fgetcsv($handle);
        $imported = 0;
        $errors = [];
        $row = 0;

        while (($data = fgetcsv($handle)) !== false) {
            $row++;
            
            if (count($data) < 4) {
                $errors[] = "Row $row: Insufficient columns";
                continue;
            }

            $record = [
                'farm_id' => $farmId,
                'production_date' => trim($data[0]),
                'input_tbs_kg' => (float) trim($data[1]),
                'crude_oil_kg' => (float) trim($data[2]),
                'kernel_kg' => (float) trim($data[3]) ?: null,
                'processing_hours' => (float) trim($data[4]) ?: null,
                'equipment_used' => trim($data[5] ?? ''),
                'operator_name' => trim($data[6] ?? ''),
                'quality_rating' => trim($data[7] ?? 'good'),
                'status' => 'completed'
            ];

            if (!$this->productionModel->validate($record)) {
                $errors[] = "Row $row: " . implode(', ', $this->productionModel->errors());
                continue;
            }

            try {
                $this->productionModel->insert($record);
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Row $row: " . $e->getMessage();
            }
        }

        fclose($handle);

        return $this->respond([
            'success' => true,
            'message' => "$imported records imported",
            'imported' => $imported,
            'errors' => $errors,
            'total_rows' => $row
        ]);
    }

    // GET /api/export/tbs - Export TBS records to CSV
    public function exportTbs()
    {
        $farmId = $this->request->getVar('farm_id');
        $dateFrom = $this->request->getVar('date_from');
        $dateTo = $this->request->getVar('date_to');

        if (!$farmId) {
            return $this->fail('farm_id required', 400);
        }

        $query = $this->tbsModel->where('farm_id', $farmId);

        if ($dateFrom) {
            $query = $query->where('record_date >=', $dateFrom);
        }
        if ($dateTo) {
            $query = $query->where('record_date <=', $dateTo);
        }

        $records = $query->findAll();

        return $this->generateCsv('tbs_records', $records, [
            'record_date',
            'quantity_bunches',
            'weight_kg',
            'quality_grade',
            'ripeness_level',
            'damage_percentage',
            'received_by',
            'status'
        ]);
    }

    // GET /api/export/production - Export production records to CSV
    public function exportProduction()
    {
        $farmId = $this->request->getVar('farm_id');
        $dateFrom = $this->request->getVar('date_from');
        $dateTo = $this->request->getVar('date_to');

        if (!$farmId) {
            return $this->fail('farm_id required', 400);
        }

        $query = $this->productionModel->where('farm_id', $farmId);

        if ($dateFrom) {
            $query = $query->where('production_date >=', $dateFrom);
        }
        if ($dateTo) {
            $query = $query->where('production_date <=', $dateTo);
        }

        $records = $query->findAll();

        return $this->generateCsv('production_records', $records, [
            'production_date',
            'input_tbs_kg',
            'crude_oil_kg',
            'kernel_kg',
            'oil_extraction_rate',
            'processing_hours',
            'equipment_used',
            'operator_name',
            'quality_rating',
            'status'
        ]);
    }

    // Helper function to generate CSV response
    protected function generateCsv($filename, $records, $columns)
    {
        $output = fopen('php://temp', 'w');
        
        // Write header
        fputcsv($output, $columns);
        
        // Write data
        foreach ($records as $record) {
            $row = [];
            foreach ($columns as $col) {
                $row[] = $record[$col] ?? '';
            }
            fputcsv($output, $row);
        }

        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);

        // Return file response
        return $this->response
            ->setHeader('Content-Type', 'text/csv')
            ->setHeader('Content-Disposition', "attachment; filename=\"{$filename}_" . date('Y-m-d_His') . ".csv\"")
            ->setBody($csv);
    }
}
