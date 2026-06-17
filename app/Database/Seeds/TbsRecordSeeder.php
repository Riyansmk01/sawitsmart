<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TbsRecordSeeder extends Seeder
{
    public function run()
    {
        $baseDate = date('Y-m-d', strtotime('-30 days'));
        $data = [];

        for ($i = 0; $i < 30; $i++) {
            $currentDate = date('Y-m-d', strtotime($baseDate . " +$i days"));
            $randomGrade = ['A', 'A', 'B', 'C'][rand(0, 3)];
            $randomZone = rand(1, 3);

            $data[] = [
                'farm_id' => 1,
                'zone_id' => $randomZone,
                'record_date' => $currentDate,
                'collection_time' => '08:00:00',
                'quantity_bunches' => rand(400, 600),
                'weight_kg' => rand(4000, 6000),
                'quality_grade' => $randomGrade,
                'ripeness_level' => 'ripe',
                'damage_percentage' => rand(1, 5),
                'loose_fruits_percentage' => rand(0, 3),
                'received_by' => ['John Doe', 'Ahmad', 'Budi', 'Siti'][rand(0, 3)],
                'storage_location' => 'Storage A',
                'notes' => 'Regular collection',
                'status' => 'received',
            ];
        }

        $this->db->table('tbs_records')->insertBatch($data);
    }
}
