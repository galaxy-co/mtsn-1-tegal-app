<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnKurikulimRfNilaiDetail extends Migration
{
    public function up()
    {
        //
        $fields = [
            'kurikulum_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('rfnilaidetail', $fields);
    }

    public function down()
    {
        //
    }
}
