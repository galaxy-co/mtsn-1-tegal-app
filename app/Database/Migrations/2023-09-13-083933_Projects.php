<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Projects extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_project' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'          => 'VARCHAR',
                'constraint'    => 200,
                'null'=>true
            ],
            'theme' => [
                'type'          => 'VARCHAR',
                'constraint'    => 200,
                'null'=>true
            ]
        ]);
        $this->forge->addKey('id_project', true);
        $this->forge->createTable('projects');
    }
    
    public function down()
    {
        //
        $this->forge->dropTable('projects');
    }
}
