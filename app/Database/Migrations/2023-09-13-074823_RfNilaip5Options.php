<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RfNilaip5Options extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_nilaip5_option' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode' => [
                'type'          => 'VARCHAR',
                'constraint'    => 5,
                'null'=>false
            ],
            'desc' =>[
                'type'          => 'VARCHAR',
                'constraint'    => 40,
                'null'=>true
            ],
            'nilai' =>[
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'null'=>true
            ],
            'arti' => [
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
        $this->forge->addKey('id_nilaip5_option', true);
        $this->forge->createTable('rf_nilai_p5_options');
    }
    
    public function down()
    {
        //
        $this->forge->dropTable('rf_nilai_p5_options');
    }
}
