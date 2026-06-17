<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'email',
        'password',
        'phone',
        'organization',
        'organization_type',
        'is_active',
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
    protected $validationRules    = [
        'name'               => 'required|string|max_length[100]',
        'email'              => 'required|valid_email|is_unique[users.email]',
        'password'           => 'required|string|min_length[6]',
        'phone'              => 'permit_empty|numeric',
        'organization'       => 'permit_empty|string|max_length[150]',
        'organization_type'  => 'in_list[petani,koperasi,lainnya]',
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;
    protected $cleanValidationRules = true;

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->where('is_active', 1)->first();
    }

    public function getUserById($id)
    {
        return $this->where('id', $id)->where('is_active', 1)->first();
    }

    public function createUser($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->insert($data);
    }

    public function verifyPassword($rawPassword, $hashedPassword)
    {
        return password_verify($rawPassword, $hashedPassword);
    }
}
