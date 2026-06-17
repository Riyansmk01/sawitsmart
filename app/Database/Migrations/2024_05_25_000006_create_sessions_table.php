<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
            ],
            'ip_address'    => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
            ],
            'timestamp'     => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'data'          => [
                'type' => 'LONGTEXT',
            ],
        ]);

        $this->forge->addKey('id', false, true);
        $this->forge->addKey('timestamp');
        $this->forge->createTable('sessions');
    }

    public function down()
    {
        $this->forge->dropTable('sessions');
    }
}
