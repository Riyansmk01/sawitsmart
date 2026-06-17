<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiKeyModel extends Model
{
    protected $table = 'api_keys';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'user_id',
        'key',
        'name',
        'is_active',
        'last_used_at',
        'expires_at',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'user_id' => 'required|integer',
        'key' => 'required|is_unique[api_keys.key]',
        'name' => 'required|min_length[3]|max_length[100]',
        'is_active' => 'in_list[0,1]',
    ];

    // Generate unique API key
    public static function generateKey()
    {
        return bin2hex(random_bytes(32));
    }

    // Validate API key
    public function validateKey($key, $farmId = null)
    {
        $apiKey = $this->where('key', $key)
            ->where('is_active', 1)
            ->first();

        if (!$apiKey) {
            return false;
        }

        // Check expiration
        if ($apiKey['expires_at'] && strtotime($apiKey['expires_at']) < time()) {
            return false;
        }

        // Update last used
        $this->update($apiKey['id'], [
            'last_used_at' => date('Y-m-d H:i:s')
        ]);

        return $apiKey;
    }

    // Get active keys for user
    public function getActiveKeys($userId)
    {
        return $this->where('user_id', $userId)
            ->where('is_active', 1)
            ->findAll();
    }

    // Revoke key
    public function revokeKey($keyId)
    {
        return $this->update($keyId, ['is_active' => 0]);
    }
}
