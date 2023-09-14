<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ForeignKeyProjectDimensi extends Migration
{
    public function up()
    {
        //
        $this->forge->addForeignKey('id_project', 'projects', 'id_project', 'CASCADE', 'CASCADE','id_project_project_dimensi');
        $this->forge->addForeignKey('id_dimensi', 'dimensi_p5', 'id_dimensi', 'CASCADE', 'CASCADE','id_dimensi');
        $this->forge->addForeignKey('kode_capaian_fase', 'capaian_p5', 'id_capaian', 'CASCADE', 'CASCADE','kode_capaian_fase_project_dimensi');
        $this->forge->processIndexes('project_dimensi');

    }

    public function down()
    {
        //
    }
}
