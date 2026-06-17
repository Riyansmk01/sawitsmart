<?php

namespace App\Controllers;

use App\Models\PageModel;
use App\Models\NewsModel;

class Home extends BaseController
{
    public function index()
    {
        $data = [];
        $data['title'] = 'Beranda — SawitSmart';
        $data['meta_description'] = 'SawitSmart adalah platform digital terintegrasi untuk manajemen kebun sawit yang membantu koperasi dan petani meningkatkan produktivitas.';
        $data['meta_keywords'] = 'sawit, platform digital, manajemen kebun, koperasi, pertanian';
        $data['hero'] = [
            'title' => 'Manajemen Sawit Lebih Mudah: Meningkatkan Produktivitas Perkebunan Anda',
            'content' => '<p>SawitSmart membantu peningkatan efisiensi operasional dan akses pasar untuk koperasi serta petani sawit.</p>'
        ];
        $data['features'] = [
            ['title' => 'SIM Sawit', 'desc' => 'Sistem informasi manajemen untuk kebun sawit berbasis digital dengan monitoring real-time.', 'icon' => 'fa-leaf', 'link' => site_url('produk/sim-sawit')],
            ['title' => 'SIM Koperasi', 'desc' => 'Platform manajemen koperasi untuk transaksi, distribusi, dan kemitraan petani.', 'icon' => 'fa-users', 'link' => site_url('produk/sim-koperasi')],
            ['title' => 'Laporan & Analitik', 'desc' => 'Dashboard komprehensif untuk analisis kinerja kebun dan strategi bisnis.', 'icon' => 'fa-chart-line', 'link' => site_url('produk/analytics')],
        ];

        // Ambil berita dari database jika tersedia
        try {
            $newsModel = new NewsModel();
            $data['latest_news'] = $newsModel->getPublished(null, 3);
        } catch (\Exception $e) {
            $data['latest_news'] = [];
        }

        return view('public/home', $data);
    }
}
