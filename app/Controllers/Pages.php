<?php

namespace App\Controllers;

use App\Models\PageModel;

class Pages extends BaseController
{
    protected $pageModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
    }

    // Produk & Layanan
    public function produk()
    {
        $data = [
            'title' => 'Produk — SawitSmart',
            'meta_description' => 'Jelajahi solusi digital SawitSmart untuk manajemen kebun sawit dan koperasi pertanian.',
            'heading' => 'Produk & Layanan Kami',
            'subheading' => 'Platform terintegrasi untuk meningkatkan efisiensi dan produktivitas pertanian sawit',
            'products' => [
                [
                    'id' => 'sim-sawit',
                    'title' => 'SIM Sawit',
                    'description' => 'Sistem Informasi Manajemen untuk kebun sawit berbasis digital',
                    'icon' => 'fa-leaf',
                    'link' => site_url('produk/sim-sawit'),
                ],
                [
                    'id' => 'sim-koperasi',
                    'title' => 'SIM Koperasi',
                    'description' => 'Platform manajemen koperasi untuk transaksi dan distribusi',
                    'icon' => 'fa-users',
                    'link' => site_url('produk/sim-koperasi'),
                ],
                [
                    'id' => 'analytics',
                    'title' => 'Laporan & Analitik',
                    'description' => 'Dashboard komprehensif untuk analisis kinerja',
                    'icon' => 'fa-chart-line',
                    'link' => site_url('produk/analytics'),
                ],
            ],
        ];
        return view('public/produk', $data);
    }

    public function simSawit()
    {
        $data = [
            'title' => 'SIM Sawit — Manajemen Kebun Digital | SawitSmart',
            'meta_description' => 'SIM Sawit adalah sistem manajemen kebun sawit digital untuk meningkatkan produktivitas pertanian.',
            'meta_keywords' => 'manajemen sawit, sistem informasi, platform digital pertanian',
            'product_name' => 'SIM Sawit',
            'heading' => 'Sistem Manajemen Kebun Digital',
            'tagline' => 'SIM Sawit adalah platform digital terintegrasi yang membantu petani dan koperasi sawit mengelola kebun dengan lebih efisien',
            'features' => [
                ['title' => 'Berbasis Web', 'desc' => 'Akses dari mana saja kapan saja', 'icon' => 'fa-globe'],
                ['title' => 'User-Friendly', 'desc' => 'Interface mudah digunakan untuk semua kalangan', 'icon' => 'fa-check-circle'],
                ['title' => 'Real-Time Data', 'desc' => 'Update data kebun secara langsung dari lapangan', 'icon' => 'fa-sync'],
                ['title' => 'Laporan Otomatis', 'desc' => 'Dokumentasi hasil panen dan perawatan kebun', 'icon' => 'fa-file-alt'],
            ],
            'cta_button' => 'Coba SIM Sawit Sekarang',
        ];
        return view('public/sim_sawit', $data);
    }

    public function simKoperasi()
    {
        $data = [
            'title' => 'SIM Koperasi — Manajemen Koperasi Digital | SawitSmart',
            'meta_description' => 'SIM Koperasi adalah sistem manajemen koperasi pertanian untuk mengelola transaksi dan distribusi.',
            'product_name' => 'SIM Koperasi',
            'heading' => 'Sistem Manajemen Koperasi Terintegrasi',
            'tagline' => 'SIM Koperasi membantu koperasi sawit mengelola anggota, transaksi, dan distribusi dengan sistem terintegrasi',
            'features' => [
                ['title' => 'Manajemen Anggota', 'desc' => 'Database anggota koperasi yang terorganisir', 'icon' => 'fa-address-book'],
                ['title' => 'Sistem Transaksi', 'desc' => 'Pencatatan pembelian dan penjualan otomatis', 'icon' => 'fa-exchange-alt'],
                ['title' => 'Laporan Keuangan', 'desc' => 'Pelaporan finansial real-time', 'icon' => 'fa-calculator'],
                ['title' => 'Integrasi Pasar', 'desc' => 'Koneksi dengan platform pemasaran digital', 'icon' => 'fa-store'],
            ],
            'cta_button' => 'Hubungi Kami untuk Demo',
        ];
        return view('public/sim_koperasi', $data);
    }

    public function analytics()
    {
        $data = [
            'title' => 'Laporan & Analitik — Dashboard Kinerja | SawitSmart',
            'meta_description' => 'Dashboard analitik SawitSmart memberikan insights mendalam tentang produktivitas kebun sawit Anda.',
            'product_name' => 'Laporan & Analitik',
            'heading' => 'Dashboard Kinerja Kebun',
            'tagline' => 'Dapatkan insights mendalam tentang kinerja kebun sawit dengan dashboard analitik komprehensif',
            'features' => [
                ['title' => 'Dashboard Real-Time', 'desc' => 'Monitoring kinerja kebun secara langsung', 'icon' => 'fa-tachometer-alt'],
                ['title' => 'Tren & Prediksi', 'desc' => 'Analisis tren produktivitas dan prediksi hasil', 'icon' => 'fa-chart-area'],
                ['title' => 'Laporan Lengkap', 'desc' => 'Ekspor laporan dalam berbagai format', 'icon' => 'fa-print'],
                ['title' => 'Visualisasi Data', 'desc' => 'Grafik interaktif untuk pemahaman lebih baik', 'icon' => 'fa-chart-pie'],
            ],
            'cta_button' => 'Minta Demo Sekarang',
        ];
        return view('public/analytics', $data);
    }

    // Tentang Kami
    public function tentang()
    {
        $data = [
            'title' => 'Tentang Kami — SawitSmart',
            'meta_description' => 'Pelajari lebih lanjut tentang SawitSmart dan misi kami untuk digitalisasi pertanian sawit Indonesia.',
            'heading' => 'Tentang SawitSmart',
            'content' => 'SawitSmart adalah platform digital terintegrasi yang didirikan untuk mendukung transformasi digital industri pertanian sawit Indonesia. Kami berkomitmen menyediakan solusi teknologi yang mengubah cara petani dan koperasi mengelola usaha mereka.',
            'menu' => [
                ['title' => 'Visi & Misi', 'link' => site_url('tentang/visi-misi'), 'icon' => 'fa-bullseye'],
                ['title' => 'Tim Kami', 'link' => site_url('tentang/tim'), 'icon' => 'fa-users'],
            ],
        ];
        return view('public/tentang', $data);
    }

    public function visiMisi()
    {
        $data = [
            'title' => 'Visi & Misi — SawitSmart',
            'meta_description' => 'Visi dan misi SawitSmart dalam transformasi digital pertanian sawit Indonesia.',
            'heading' => 'Visi & Misi',
            'vision' => 'Menjadi platform digital terdepan yang mendukung efisiensi, kualitas, dan aksesibilitas pasar bagi semua pemangku kepentingan industri sawit Indonesia',
            'mission' => [
                'Menyediakan solusi teknologi digital yang mudah diakses dan terjangkau untuk petani dan koperasi sawit',
                'Meningkatkan efisiensi operasional dan produktivitas melalui manajemen data yang terukur',
                'Membuka akses pasar yang lebih luas bagi produk sawit berkualitas',
                'Memberdayakan petani dan koperasi melalui edukasi dan pendampingan berkelanjutan',
                'Berkontribusi pada pertumbuhan ekonomi berkelanjutan industri sawit Indonesia',
            ],
        ];
        return view('public/visi_misi', $data);
    }

    public function tim()
    {
        $data = [
            'title' => 'Tim Kami — SawitSmart',
            'meta_description' => 'Kenali tim ahli SawitSmart yang berdedikasi untuk transformasi digital pertanian sawit.',
            'heading' => 'Tim Kami',
            'description' => 'SawitSmart didukung oleh tenaga ahli berpengalaman di bidang teknologi, pertanian, dan manajemen bisnis.',
            'team_members' => [
                ['name' => 'Diisi Oleh Tim', 'position' => 'Founder & CEO', 'bio' => 'Visioner dalam transformasi digital pertanian'],
                ['name' => 'Diisi Oleh Tim', 'position' => 'CTO', 'bio' => 'Ahli teknologi informasi pertanian'],
                ['name' => 'Diisi Oleh Tim', 'position' => 'Head of Operations', 'bio' => 'Profesional berpengalaman dalam operasional bisnis'],
            ],
        ];
        return view('public/tim', $data);
    }

    // Panduan
    public function panduan($segment = null)
    {
        if ($segment) {
            $page = $this->pageModel->getBySlug('panduan-' . $segment);
            if (!$page) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Panduan tidak ditemukan');
            }
            return view('public/panduan-detail', $page);
        }
        $data = [
            'title' => 'Panduan Pengguna — SawitSmart',
            'meta_description' => 'Panduan lengkap menggunakan SIM Sawit dan SIM Koperasi untuk manajemen kebun sawit yang lebih baik.',
            'heading' => 'Panduan Pengguna',
            'guides' => [
                ['title' => 'Memulai dengan SIM Sawit', 'slug' => 'memulai-sim-sawit'],
                ['title' => 'Manajemen Data Kebun', 'slug' => 'data-kebun'],
                ['title' => 'Membaca Laporan', 'slug' => 'membaca-laporan'],
                ['title' => 'Dukungan Teknis', 'slug' => 'dukungan-teknis'],
            ],
        ];
        return view('public/panduan', $data);
    }

    // Halaman umum (fallback)
    public function view($slug = 'about')
    {
        $page = $this->pageModel->getBySlug($slug);
        if (!$page) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Halaman tidak ditemukan: $slug");
        }
        $data['title'] = esc($page['title']) . ' — SawitSmart';
        $data['meta_description'] = $page['meta_description'] ?? 'Informasi SawitSmart tentang manajemen sawit digital.';
        $data['page'] = $page;
        return view('public/page', $data);
    }
}
