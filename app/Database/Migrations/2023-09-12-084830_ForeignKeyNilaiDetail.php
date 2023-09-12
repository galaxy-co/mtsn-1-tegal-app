<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ForeignKeyNilaiDetail extends Migration
{
    public function up()
    {
        //
        // $this->forge->addForeignKey('id_nilai', 'user', 'id', '', '', 'userid_fk');
        $fields = [
            'id_nilai' => [
                'name' => 'id_nilai',
                'type' => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
                'null' => true,
            ],
        ];
        $this->forge->modifyColumn('nilai_detail', $fields);
        $this->forge->addForeignKey('id_nilai', 'nilai', 'id_nilai', '', 'CASCADE','id_nilai');
        $this->forge->processIndexes('nilai_detail');
    }

    public function down()
    {
        //
    }
}
