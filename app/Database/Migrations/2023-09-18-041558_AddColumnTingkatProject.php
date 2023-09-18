<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnTingkatProject extends Migration
{
    public function up()
    {
        //
        $fields = [
            'tingkat' => [
                'type'           => 'INT',
                'constraint'     => 5
            ],
        ];
        $this->forge->addColumn('projects', $fields);
    }

    public function down()
    {
        //
        $this->forge->dropColumn('projects','tingkat');
    }
}
