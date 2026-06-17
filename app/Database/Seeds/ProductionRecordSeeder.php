<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductionRecordSeeder extends Seeder
{
    public function run()
    {
        $baseDate = date('Y-m-d', strtotime('-30 days'));
        $data = [];

        for ($i = 0; $i < 25; $i++) {
            $currentDate = date('Y-m-d', strtotime($baseDate . " +$i days"));
            $inputTbs = rand(4000, 6000);
            $crudOil = round($inputTbs * 0.20, 2);
            $kernel = round($inputTbs * 0.07, 2);
            $extractionRate = round(($crudOil / $inputTbs) * 100, 2);

            $data[] = [
                'farm_id' => 1,
                'production_date' => $currentDate,
                'production_time' => '09:00:00',
                'input_tbs_kg' => $inputTbs,
                'crude_oil_kg' => $crudOil,
                'kernel_kg' => $kernel,
                'waste_percentage' => rand(5, 10),
                'oil_extraction_rate' => $extractionRate,
                'processing_hours' => round(rand(7, 9) + (rand(0, 59) / 60), 2),
                'equipment_used' => 'Main Press',
                'operator_name' => ['Operator A', 'Operator B', 'Operator C'][rand(0, 2)],
                'quality_rating' => ['good', 'excellent', 'fair'][rand(0, 2)],
                'defects_noted' => null,
                'status' => 'completed',
            ];
        }

        $this->db->table('production_records')->insertBatch($data);
    }
}
