<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Expense extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'desc' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'nominal' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true); // Set id as primary key
        $this->forge->createTable('expense');
    }

    public function down()
    {
        $this->forge->dropTable('expense');
    }
}
