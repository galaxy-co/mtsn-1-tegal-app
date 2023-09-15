<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableNilaiP5 extends Migration
{
    public function up()
    {
        //
        $fields = [
            'id_project_dimensi' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'nilai' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
        ];
        $this->forge->addColumn('nilaip5', $fields);
    }

    public function down()
    {
        //
        $this->forge->dropColumn('nilaip5','id_project_dimensi');
    }
}
