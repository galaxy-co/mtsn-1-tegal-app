<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiPAS extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_nilai_pas' => [
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
            ],
            'nilai' => [
                'type' => 'INT',
                'null' => true,
            ],
            'type_test' => [
                'type' => 'INT',
                'null' => true,
            ]
            
        ]);
        $this->forge->addKey('id_nilai_pas', true);
        $this->forge->createTable('nilai_pas');
    }

    public function down()
    {
        $this->forge->dropTable('nilai_pas');
    }
}
