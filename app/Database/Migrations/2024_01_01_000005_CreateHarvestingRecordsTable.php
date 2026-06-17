<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHarvestingRecordsTable extends Migration
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
            'zone_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'harvest_date' => [
                'type' => 'DATE',
            ],
            'harvesting_time_start' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'harvesting_time_end' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'crew_size' => [
                'type' => 'INT',
                'null' => true,
            ],
            'bunches_harvested' => [
                'type' => 'INT',
                'null' => true,
            ],
            'weight_harvested_kg' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'labor_hours' => [
                'type' => 'DECIMAL',
                'constraint' => '8,2',
                'null' => true,
            ],
            'waste_branches_kg' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'weather_conditions' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'equipment_used' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['planned', 'in_progress', 'completed', 'postponed'],
                'default' => 'planned',
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
        $this->forge->addForeignKey('zone_id', 'zones', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addKey(['farm_id', 'harvest_date']);
        $this->forge->createTable('harvesting_records');
    }

    public function down()
    {
        $this->forge->dropTable('harvesting_records');
    }
}
