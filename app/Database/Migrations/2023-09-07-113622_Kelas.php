<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelas' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tingkat' => [
                'type'          => 'INT',
                'constraint'    => 5
            ],
            'nama_kelas' => [
                'type'          => 'VARCHAR',
                'constraint'    => '10'
            ],
            'kurikulum' => [
                'type'          => 'INT',
                'constraint'    => 2
            ]
        ]);
        $this->forge->addKey('id_kelas', true);
        $this->forge->createTable('kelas');
    }

    public function down()
    {
        //
        $this->forge->dropTable('kelas');
    }
}
