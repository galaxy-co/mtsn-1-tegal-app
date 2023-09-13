<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProjectsDimensi extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_project_dimensi' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_project' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'id_dimensi' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'kode_capaian_fase' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'theme' => [
                'type'          => 'VARCHAR',
                'constraint'    => 200,
                'null'=>true
            ]
        ]);
        $this->forge->addKey('id_project_dimensi', true);
        $this->forge->createTable('project_dimensi');
    }
    
    public function down()
    {
        //
        $this->forge->dropTable('project_dimensi');
    }
}
