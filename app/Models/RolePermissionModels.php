<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'role',
        'action',
        'resource',
        'description',
    ];
}

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'name',
        'description',
        'is_active',
    ];
}

class UserRoleModel extends Model
{
    protected $table = 'user_roles';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'user_id',
        'role_id',
    ];
}

/**
 * Permission Manager Class
 */
class PermissionManager
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // Check if user has permission
    public function hasPermission($userId, $action, $resource)
    {
        $result = $this->db->table('user_roles ur')
            ->join('permissions p', 'p.role = ur.role_id')
            ->where('ur.user_id', $userId)
            ->where('p.action', $action)
            ->where('p.resource', $resource)
            ->countAllResults();

        return $result > 0;
    }

    // Get user roles
    public function getUserRoles($userId)
    {
        return $this->db->table('user_roles ur')
            ->join('roles r', 'r.id = ur.role_id')
            ->where('ur.user_id', $userId)
            ->get()
            ->getResultArray();
    }

    // Get role permissions
    public function getRolePermissions($roleId)
    {
        return $this->db->table('permissions')
            ->where('role', $roleId)
            ->get()
            ->getResultArray();
    }

    // Assign role to user
    public function assignRole($userId, $roleId)
    {
        return $this->db->table('user_roles')
            ->insert([
                'user_id' => $userId,
                'role_id' => $roleId,
            ]);
    }

    // Revoke role from user
    public function revokeRole($userId, $roleId)
    {
        return $this->db->table('user_roles')
            ->where('user_id', $userId)
            ->where('role_id', $roleId)
            ->delete();
    }
}
