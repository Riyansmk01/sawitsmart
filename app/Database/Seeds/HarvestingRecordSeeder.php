<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HarvestingRecordSeeder extends Seeder
{
    public function run()
    {
        $baseDate = date('Y-m-d', strtotime('-30 days'));
        $data = [];

        for ($i = 0; $i < 30; $i++) {
            $currentDate = date('Y-m-d', strtotime($baseDate . " +$i days"));
            $crewSize = rand(12, 18);
            $bunchesHarvested = rand(700, 900);
            $weightHarvested = $bunchesHarvested * 10 + rand(0, 500);
            $laborHours = rand(7, 9);

            $data[] = [
                'farm_id' => 1,
                'zone_id' => rand(1, 3),
                'harvest_date' => $currentDate,
                'harvesting_time_start' => '07:00:00',
                'harvesting_time_end' => '15:00:00',
                'crew_size' => $crewSize,
                'bunches_harvested' => $bunchesHarvested,
                'weight_harvested_kg' => $weightHarvested,
                'labor_hours' => $laborHours,
                'waste_branches_kg' => rand(100, 300),
                'weather_conditions' => ['clear', 'cloudy', 'rainy'][rand(0, 2)],
                'equipment_used' => 'Manual cutters',
                'notes' => 'Daily harvest',
                'status' => 'completed',
            ];
        }

        $this->db->table('harvesting_records')->insertBatch($data);
    }
}
