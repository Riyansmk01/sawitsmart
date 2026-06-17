<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    public function index()
    {
        $model = new NewsModel();
        $data['title'] = 'Berita — SawitSmart';
        $data['meta_description'] = 'Berita dan informasi terbaru tentang SawitSmart dan industri pertanian sawit.';
        $data['meta_keywords'] = 'berita sawit, berita pertanian, SawitSmart';
        $data['news_items'] = $model->getByCategory('Berita', 12);
        return view('public/berita', $data);
    }

    public function activities()
    {
        $model = new NewsModel();
        $data['title'] = 'Kegiatan — SawitSmart';
        $data['meta_description'] = 'Kegiatan dan acara terbaru SawitSmart dalam mendukung digitalisasi pertanian sawit.';
        $data['meta_keywords'] = 'kegiatan sawit, acara pertanian, sosialisasi';
        $data['news_items'] = $model->getByCategory('Kegiatan', 12);
        return view('public/kegiatan', $data);
    }

    public function view($slug)
    {
        $model = new NewsModel();
        $post = $model->getBySlug($slug);
        if (!$post) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Berita tidak ditemukan');
        }
        $data['title'] = esc($post['title']).' — SawitSmart';
        $data['meta_description'] = esc(strip_tags(substr($post['content'], 0, 160)));
        $data['post'] = $post;
        return view('public/detail_berita', $data);
    }

    public function viewActivity($slug)
    {
        $model = new NewsModel();
        $post = $model->getBySlug($slug);
        if (!$post) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kegiatan tidak ditemukan');
        }
        $data['title'] = esc($post['title']).' — SawitSmart';
        $data['meta_description'] = esc(strip_tags(substr($post['content'], 0, 160)));
        $data['post'] = $post;
        return view('public/detail_kegiatan', $data);
    }
}
