<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique' => true
            ],
            'name' =>[
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' =>true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint'=>'40'
            ],
            'role_id'=>[
                'type' => 'VARCHAR',
                'constraint'=> '20'
            ]
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        //
        $this->forge->dropTable('users');
    }
}
