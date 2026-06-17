<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInventoryLogsTable extends Migration
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
            'product_type' => [
                'type' => 'ENUM',
                'constraint' => ['crude_oil', 'kernel', 'waste', 'tbs'],
            ],
            'movement_type' => [
                'type' => 'ENUM',
                'constraint' => ['in', 'out', 'loss', 'adjustment'],
            ],
            'quantity_kg' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'previous_balance' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'new_balance' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'reason' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'reference_id' => [
                'type' => 'INT',
                'null' => true,
            ],
            'reference_table' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'recorded_by' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'transaction_date' => [
                'type' => 'DATETIME',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('farm_id', 'farms', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addKey(['farm_id', 'product_type']);
        $this->forge->addKey('transaction_date');
        $this->forge->createTable('inventory_logs');
    }

    public function down()
    {
        $this->forge->dropTable('inventory_logs');
    }
}
