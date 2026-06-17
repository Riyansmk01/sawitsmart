<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNewsletterSubscribersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],
            'status'      => [
                'type'       => 'ENUM',
                'constraint' => ['subscribed', 'unsubscribed'],
                'default'    => 'subscribed',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('newsletter_subscribers');
    }

    public function down()
    {
        $this->forge->dropTable('newsletter_subscribers');
    }
}
