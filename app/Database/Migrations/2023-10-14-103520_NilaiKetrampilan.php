<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiKetrampilan extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_nilai' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_siswa' => [
                'type'          => 'INT',
                'constraint'    => 50,
                'null'=>true
            ],
            'id_mapel' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'null'=>true
            ],
            'id_guru' => [
                'type'          => 'INT',
                'constraint'    => 5,
                'null'=>true
            ]
        ]);
        $this->forge->addKey('id_nilai', true);
        $this->forge->createTable('nilaiKetrampilan');
    }

    public function down()
    {
        //
        $this->forge->dropTable('nilaiKetrampilan');
    }
}
