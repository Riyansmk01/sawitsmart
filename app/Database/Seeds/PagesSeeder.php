<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PagesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'home-hero',
                'slug'  => 'home-hero',
                'content' => '<p>SawitSmart adalah platform digital terintegrasi untuk manajemen kebun sawit, meningkatkan produktivitas dan akses pasar bagi koperasi dan petani.</p>',
                'meta_description' => 'Platform digital untuk manajemen sawit',
                'meta_keywords' => 'sawit, manajemen sawit, koperasi, agritech',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'visi-misi',
                'slug'  => 'visi-misi',
                'content' => '<h2>Visi</h2><p>Meningkatkan daya saing petani sawit melalui digitalisasi operasional dan pasar.</p><h2>Misi</h2><ul><li>Memberikan alat manajemen kebun yang mudah digunakan.</li><li>Meningkatkan akses pasar dan transparansi harga.</li></ul>',
                'meta_description' => 'Visi dan Misi SawitSmart',
                'meta_keywords' => 'visi, misi, sawit, digitalisasi',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'sim-sawit',
                'slug'  => 'sim-sawit',
                'content' => '<h2>Sistem Informasi Manajemen (SIM) Sawit</h2><p>SIM Sawit membantu pemantauan pohon, pemupukan, panen, dan laporan kinerja area kebun.</p>',
                'meta_description' => 'SIM Sawit - manajemen kebun digital',
                'meta_keywords' => 'SIM, sawit, manajemen kebun',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'sim-koperasi',
                'slug'  => 'sim-koperasi',
                'content' => '<h2>Sistem Informasi Manajemen Koperasi</h2><p>Mengelola anggota, transaksi dan distribusi hasil panen secara transparan.</p>',
                'meta_description' => 'SIM Koperasi untuk manajemen koperasi sawit',
                'meta_keywords' => 'SIM koperasi, koperasi sawit, digitalisasi koperasi',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'product',
                'slug'  => 'product',
                'content' => '<h2>Produk SawitSmart</h2><p>SawitSmart menawarkan solusi SIM Sawit dan SIM Koperasi dengan fitur monitoring, pelaporan, dan analitik yang mudah digunakan.</p>',
                'meta_description' => 'Produk SawitSmart: SIM Sawit dan SIM Koperasi',
                'meta_keywords' => 'produk, SIM Sawit, SIM Koperasi, sawit',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'panduan',
                'slug'  => 'panduan',
                'content' => '<h2>Panduan Penggunaan</h2><p>Dokumentasi singkat penggunaan SawitSmart untuk petani dan koperasi.</p>',
                'meta_description' => 'Panduan penggunaan SawitSmart',
                'meta_keywords' => 'panduan, dokumentasi, sawit',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $row) {
            $this->db->table('pages')->insert($row);
        }
    }
}
