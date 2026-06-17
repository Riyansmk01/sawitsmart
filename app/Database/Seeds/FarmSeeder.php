<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FarmSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Plantation Utama',
                'location' => 'Riau, Indonesia',
                'area_hectares' => 500,
                'total_zones' => 5,
                'established_date' => '2020-01-15',
                'owner_contact' => '+62-812-3456-7890',
                'manager_contact' => '+62-813-9876-5432',
                'status' => 'active',
            ],
            [
                'name' => 'Farm Timur',
                'location' => 'Jambi, Indonesia',
                'area_hectares' => 300,
                'total_zones' => 3,
                'established_date' => '2019-06-20',
                'owner_contact' => '+62-811-1111-2222',
                'manager_contact' => '+62-821-5555-6666',
                'status' => 'active',
            ],
        ];

        $this->db->table('farms')->insertBatch($data);
    }
}
