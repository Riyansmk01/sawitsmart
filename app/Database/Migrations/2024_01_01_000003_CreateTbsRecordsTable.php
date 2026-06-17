<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbsRecordsTable extends Migration
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
                'null' => true,
            ],
            'record_date' => [
                'type' => 'DATE',
            ],
            'collection_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'quantity_bunches' => [
                'type' => 'INT',
            ],
            'weight_kg' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'quality_grade' => [
                'type' => 'ENUM',
                'constraint' => ['A', 'B', 'C', 'Reject'],
                'default' => 'B',
            ],
            'ripeness_level' => [
                'type' => 'ENUM',
                'constraint' => ['underripe', 'ripe', 'overripe'],
                'default' => 'ripe',
            ],
            'damage_percentage' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 0,
            ],
            'loose_fruits_percentage' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 0,
            ],
            'received_by' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'storage_location' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['received', 'processed', 'rejected', 'archived'],
                'default' => 'received',
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
        $this->forge->addForeignKey('zone_id', 'zones', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addKey(['farm_id', 'record_date']);
        $this->forge->addKey('quality_grade');
        $this->forge->createTable('tbs_records');
    }

    public function down()
    {
        $this->forge->dropTable('tbs_records');
    }
}
