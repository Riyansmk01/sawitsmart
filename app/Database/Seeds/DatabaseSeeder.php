<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Run all seeders in order
        $this->call('FarmSeeder');
        $this->call('ZoneSeeder');
        $this->call('FarmSettingsSeeder');
        $this->call('TbsRecordSeeder');
        $this->call('ProductionRecordSeeder');
        $this->call('HarvestingRecordSeeder');
    }
}
