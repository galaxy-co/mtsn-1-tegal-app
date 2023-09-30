<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeNipInt extends Migration
{
    public function up()
    {
        $fields = [
            'nuptk' => [
                'name' => 'nuptk',
                'type' => 'BIGINT',
                'constraint' => '50'
            ],
        ];
        $this->forge->modifyColumn('guru', $fields);
    }

    public function down()
    {
        //
    }
}
