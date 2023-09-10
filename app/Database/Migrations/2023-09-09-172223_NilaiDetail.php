<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiDetail extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'nilai_detail_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kd_name' =>[
                'type' => 'VARCHAR',
                'constraint' => '40'
            ],
            'rf_nilai_detail_id' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'nilai' => [
                'type'       => 'FLOAT',
                'constraint' => 5,
            ],
            'notes' => [
                'type'       => 'TEXT',
                'null' =>true
            ],
        ]);
        $this->forge->addKey('nilai_detail_id', true);
        $this->forge->createTable('nilai_detail');
    }
    
    public function down()
    {
        //
        $this->forge->dropTable('nilai_detail');
    }
}
