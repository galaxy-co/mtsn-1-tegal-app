<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ElemenP5 extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_element' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'dimensi' =>[
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'kode_element' => [
                'type'          => 'VARCHAR',
                'constraint'    => 5,
                'null'=>false
            ],
            'id_parent_element' =>[
                'type'          => 'INT',
                'constraint'    => 5,
                'unsigned'       => true,
                'null'=>true
            ],
            'desc' => [
                'type'          => 'VARCHAR',
                'constraint'    => 200,
                'null'=>false
            ],
            'nilai_rahmatan_lil_alamin' => [
                'type'          => 'VARCHAR',
                'constraint'    => 40,
                'null'=>false
            ],
            'sub_nilai' => [
                'type'          => 'VARCHAR',
                'constraint'    => 40,
                'null'=>false
            ],
        ]);
        $this->forge->addKey('id_element', true);
        $this->forge->addForeignKey('id_parent_element', 'element_p5', 'id_element', '', 'CASCADE','id_parent_element');
        $this->forge->addForeignKey('dimensi', 'dimensi_p5', 'id_dimensi', '', 'CASCADE','dimensi');
        $this->forge->createTable('element_p5');
    }
    
    public function down()
    {
        $this->forge->dropTable('element_p5');
        //
    }
}
