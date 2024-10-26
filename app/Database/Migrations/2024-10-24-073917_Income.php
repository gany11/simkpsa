<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Income extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                  => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'tanggal'             => [
                'type'           => 'DATE',
                'null'           => false,
            ],
            'totalisator_awal'    => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,2',
                'null'           => false,
            ],
            'totalisator_akhir'   => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,2',
                'null'           => false,
            ],
            'sales'               => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,2',
                'null'           => false,
            ],
            'price_unit'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'           => false,
            ],
            'total'               => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,2',
                'null'           => false,
            ],
            'dipping1'            => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,2',
                'null'           => true,
            ],
            'dipping2'            => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,2',
                'null'           => false,
            ],
            'dipping3'            => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,2',
                'null'           => false,
            ],
            'dipping4'            => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,2',
                'null'           => true,
            ],
            'pengiriman'          => [
                'type'           => 'ENUM',
                'constraint'     => ['yes', 'no'],
                'null'           => false,
            ],
            'pumptes'             => [
                'type'           => 'ENUM',
                'constraint'     => ['yes', 'no'],
                'null'           => false,
            ],
            'besartes'            => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,2',
                'null'           => true,
            ],
            'losses'              => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,2',
                'null'           => true,
            ],
            'besar_pengiriman'    => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,2',
                'null'           => true,
            ],
            'waktupengiriman'     => [
                'type'           => 'ENUM',
                'constraint'     => ['Pagi', 'Siang', 'Malam'],
                'null'           => true,
            ],
            // Adding the new column for stok terpakai
            'stok_terpakai'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '15,2',
                'null'           => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('tanggal'); // Menambahkan constraint UNIQUE pada tanggal
        $this->forge->createTable('Income');
    }

    public function down()
    {
        $this->forge->dropTable('Income');
    }
}
