<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFarmSettingsTable extends Migration
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
                'unique' => true,
            ],
            'target_tbs_daily_kg' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'target_extraction_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 20.5,
            ],
            'target_oil_yield_percentage' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 22.0,
            ],
            'maintenance_schedule_days' => [
                'type' => 'INT',
                'default' => 30,
            ],
            'storage_capacity_kg' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'operating_hours_per_day' => [
                'type' => 'INT',
                'default' => 8,
            ],
            'quality_threshold_percentage' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 80.0,
            ],
            'alert_inventory_level' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'currency_code' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
                'default' => 'USD',
            ],
            'language_preference' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'default' => 'en',
            ],
            'auto_backup_enabled' => [
                'type' => 'TINYINT',
                'default' => 1,
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
        $this->forge->createTable('farm_settings');
    }

    public function down()
    {
        $this->forge->dropTable('farm_settings');
    }
}
