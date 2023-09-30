<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RfMapelSeting extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rfmapel' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kelas' => [
                'type'          => 'INT',
                'constraint'    => 50,
                'null'=>true
            ],
            'id_guru' => [
                'type'          => 'INT',
                'constraint'    => 50,
                'null'=>true
            ],
            'id_mapel' => [
                'type'          => 'INT',
                'constraint'    => 50,
                'null'=>true
            ]
            
        ]);
        $this->forge->addKey('id_rfmapel', true);
        $this->forge->createTable('rfmapel');
    }

    public function down()
    {
        $this->forge->dropTable('rfmapel');
    }
}
