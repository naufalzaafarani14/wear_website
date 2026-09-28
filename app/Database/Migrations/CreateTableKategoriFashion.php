<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKategoriFashion extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_kategori', true);
        $this->forge->createTable('kategori_fashion');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_fashion');
    }
}