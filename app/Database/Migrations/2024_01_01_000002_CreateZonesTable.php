<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateZonesTable extends Migration
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
            'farm_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'zone_code' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'area_hectares' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'planted_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'expected_harvest_start' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'crop_age_months' => [
                'type' => 'INT',
                'null' => true,
            ],
            'soil_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'replanting', 'fallow', 'maintenance'],
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
        $this->forge->addForeignKey('farm_id', 'farms', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('zones');
    }

    public function down()
    {
        $this->forge->dropTable('zones');
    }
}
