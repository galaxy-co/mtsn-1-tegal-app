<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mapel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mapel' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_mapel' => [
                'type'          => 'VARCHAR',
                'constraint'    => '10'
            ],
            'tingkal_kelas' => [
                'type'          => 'INT',
                'constraint'    => '10'
            ],
        ]);
        $this->forge->addKey('id_mapel', true);
        $this->forge->createTable('mapel');
    }

    public function down()
    {
        $this->forge->dropTable('mapel');
    }
}
