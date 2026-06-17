<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Peluncuran SawitSmart di Universitas Jambi',
                'slug' => 'peluncuran-sawitsmart-di-universitas-jambi',
                'content' => '<p>SawitSmart resmi diluncurkan sebagai solusi digital untuk mendukung koperasi dan petani sawit di Jambi.</p>',
                'category' => 'Berita',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Workshop Digitalisasi Manajemen Kebun Sawit',
                'slug' => 'workshop-digitalisasi-manajemen-kebun-sawit',
                'content' => '<p>Kegiatan pelatihan penggunaan SIM Sawit kepada anggota koperasi dilaksanakan di Balai Penyuluhan.</p>',
                'category' => 'Kegiatan',
                'status' => 'published',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $row) {
            $this->db->table('news')->insert($row);
        }
    }
}
