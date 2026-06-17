<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ZoneSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Farm 1 zones
            [
                'farm_id' => 1,
                'zone_code' => 'ZONE_A',
                'name' => 'North Block',
                'area_hectares' => 100,
                'planted_date' => '2020-01-20',
                'expected_harvest_start' => '2023-01-01',
                'crop_age_months' => 36,
                'soil_type' => 'laterite',
                'status' => 'active',
            ],
            [
                'farm_id' => 1,
                'zone_code' => 'ZONE_B',
                'name' => 'Central Block',
                'area_hectares' => 150,
                'planted_date' => '2020-06-10',
                'expected_harvest_start' => '2023-06-01',
                'crop_age_months' => 36,
                'soil_type' => 'latosol',
                'status' => 'active',
            ],
            [
                'farm_id' => 1,
                'zone_code' => 'ZONE_C',
                'name' => 'South Block',
                'area_hectares' => 120,
                'planted_date' => '2021-03-15',
                'expected_harvest_start' => '2024-03-01',
                'crop_age_months' => 24,
                'soil_type' => 'podzolic',
                'status' => 'active',
            ],
            // Farm 2 zones
            [
                'farm_id' => 2,
                'zone_code' => 'ZONE_D',
                'name' => 'East Plot',
                'area_hectares' => 150,
                'planted_date' => '2019-07-01',
                'expected_harvest_start' => '2022-07-01',
                'crop_age_months' => 48,
                'soil_type' => 'laterite',
                'status' => 'active',
            ],
        ];

        $this->db->table('zones')->insertBatch($data);
    }
}
