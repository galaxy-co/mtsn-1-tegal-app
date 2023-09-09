<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_siswa' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nism' => [
                'type'          => 'INT',
                'constraint'    => 50
            ],
            'nama_siswa' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100
            ],
            'jenis_kelas' => [
                'type'          => 'INT',
                'constraint'    => 5
            ],
            'kelas' => [
                'type'          => 'INT',
                'constain'      => 10
            ]
        ]);
        $this->forge->addKey('id_siswa', true);
        $this->forge->createTable('siswa');
    }

    public function down()
    {
        $this->forge->dropTable('siswa');
    }
}
