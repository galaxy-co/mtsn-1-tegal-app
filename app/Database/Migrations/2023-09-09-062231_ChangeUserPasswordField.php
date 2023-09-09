<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeUserPasswordField extends Migration
{
    public function up()
    {
        //
        $fields = [
            'password' => [
                'name' => 'password',
                'type' => 'TEXT',
                'null' => false,
            ],
        ];
        $this->forge->modifyColumn('users', $fields);
    }

    public function down()
    {
        //
    }
}
