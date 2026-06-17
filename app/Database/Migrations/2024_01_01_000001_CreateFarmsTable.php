<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFarmsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'area_hectares' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'total_zones' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'established_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'owner_contact' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'manager_contact' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'inactive', 'maintenance'],
                'default' => 'active',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('farms');
    }

    public function down()
    {
        $this->forge->dropTable('farms');
    }
}
