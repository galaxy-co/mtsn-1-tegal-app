<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumdKelasinPAS extends Migration
{
    public function up()
    {
        $fields = [
            'id_kelas' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('nilai_pas', $fields);
    }

    public function down()
    {
        //
    }
}
