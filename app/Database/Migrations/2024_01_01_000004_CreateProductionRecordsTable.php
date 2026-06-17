<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductionRecordsTable extends Migration
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
            'tbs_record_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'production_date' => [
                'type' => 'DATE',
            ],
            'production_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'input_tbs_kg' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'crude_oil_kg' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'kernel_kg' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'waste_percentage' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'null' => true,
            ],
            'oil_extraction_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'null' => true,
            ],
            'processing_hours' => [
                'type' => 'DECIMAL',
                'constraint' => '8,2',
                'null' => true,
            ],
            'equipment_used' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'operator_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'quality_rating' => [
                'type' => 'ENUM',
                'constraint' => ['excellent', 'good', 'fair', 'poor'],
                'default' => 'good',
            ],
            'defects_noted' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['processing', 'completed', 'quality_check', 'archived'],
                'default' => 'processing',
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
        $this->forge->addForeignKey('tbs_record_id', 'tbs_records', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addKey(['farm_id', 'production_date']);
        $this->forge->addKey('oil_extraction_rate');
        $this->forge->createTable('production_records');
    }

    public function down()
    {
        $this->forge->dropTable('production_records');
    }
}
