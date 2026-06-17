<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FarmSettingsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'farm_id' => 1,
                'target_tbs_daily_kg' => 5000,
                'target_extraction_rate' => 20.5,
                'target_oil_yield_percentage' => 22,
                'maintenance_schedule_days' => 30,
                'storage_capacity_kg' => 100000,
                'operating_hours_per_day' => 8,
                'quality_threshold_percentage' => 80,
                'alert_inventory_level' => 20000,
                'currency_code' => 'USD',
                'language_preference' => 'en',
                'auto_backup_enabled' => 1,
            ],
            [
                'farm_id' => 2,
                'target_tbs_daily_kg' => 3500,
                'target_extraction_rate' => 20.3,
                'target_oil_yield_percentage' => 21.5,
                'maintenance_schedule_days' => 30,
                'storage_capacity_kg' => 75000,
                'operating_hours_per_day' => 8,
                'quality_threshold_percentage' => 75,
                'alert_inventory_level' => 15000,
                'currency_code' => 'USD',
                'language_preference' => 'id',
                'auto_backup_enabled' => 1,
            ],
        ];

        $this->db->table('farm_settings')->insertBatch($data);
    }
}
