<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DimensiP5 extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_dimensi' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_dimensi' =>[
                'type'          => 'VARCHAR',
                'constraint'    => 200,
                'null'=>true
            ],
            'dimensi' => [
                'type'          => 'VARCHAR',
                'constraint'    => 200,
                'null'=>false
            ],
            'id_kelas' =>[
                'type' => 'VARCHAR',
                'constraint'    => 20,
                'null'=>true
            ]
        ]);
        $this->forge->addKey('id_dimensi', true);
        $this->forge->createTable('dimensi_p5');
    }
    
    public function down()
    {
        //
        $this->forge->dropTable('dimensi_p5');
    }
}
