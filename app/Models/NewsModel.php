<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table            = 'news';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'slug',
        'content',
        'featured_image',
        'category',
        'status',
        'created_at',
        'updated_at',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'title'    => 'required|string|max_length[255]',
        'slug'     => 'required|string|is_unique[news.slug]|max_length[255]',
        'content'  => 'required',
        'category' => 'required|in_list[Kegiatan,Berita]',
        'status'   => 'required|in_list[draft,published]',
    ];

    protected $validationMessages = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = false;

    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)
                    ->where('status', 'published')
                    ->first();
    }

    public function getPublished($category = null, $limit = 10)
    {
        $query = $this->where('status', 'published');
        if ($category) {
            $query->where('category', $category);
        }
        return $query->orderBy('created_at', 'DESC')
                     ->limit($limit)
                     ->findAll();
    }

    public function getByCategory($category, $limit = 10)
    {
        return $this->where('status', 'published')
                    ->where('category', $category)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}
