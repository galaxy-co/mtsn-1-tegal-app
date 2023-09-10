<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Absen extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_absen' => [
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
            'sakit' => [
                'type'          => 'INT',
                'constraint'    => 100,
                'null'=>true
            ],
            'izin' => [
                'type'          => 'INT',
                'constraint'    => 100,
                'null'=>true
            ],
            'alpa' => [
                'type'          => 'INT',
                'constraint'    => 100,
                'null'=>true
            ],
            'catatan' => [
                'type'          => 'TEXT',
                'constraint'    => 500,
                'null'=>true
            ]
        ]);
        $this->forge->addKey('id_absen', true);
        $this->forge->createTable('absen');
    }

    public function down()
    {
        $this->forge->dropTable('absen');
    }
}
