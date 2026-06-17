<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'               => 'Riyan Polkam',
                'email'              => 'perdhanariyan@gmail.com',
                'password'           => password_hash('Riyanpolkam01', PASSWORD_BCRYPT),
                'phone'              => '0852-6804-1096',
                'organization'       => 'SawitSmart',
                'organization_type'  => 'lainnya',
                'is_active'          => 1,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'name'               => 'Admin User',
                'email'              => 'admin@sawitsmart.com',
                'password'           => password_hash('password123', PASSWORD_BCRYPT),
                'phone'              => '0852-6804-1096',
                'organization'       => 'SawitSmart',
                'organization_type'  => 'lainnya',
                'is_active'          => 1,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'name'               => 'Petani Test',
                'email'              => 'petani@test.com',
                'password'           => password_hash('password123', PASSWORD_BCRYPT),
                'phone'              => '0812-3456-7890',
                'organization'       => 'Kelompok Tani Sejahtera',
                'organization_type'  => 'petani',
                'is_active'          => 1,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'name'               => 'Koperasi Test',
                'email'              => 'koperasi@test.com',
                'password'           => password_hash('password123', PASSWORD_BCRYPT),
                'phone'              => '0823-4567-8901',
                'organization'       => 'Koperasi Sawit Maju',
                'organization_type'  => 'koperasi',
                'is_active'          => 1,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
