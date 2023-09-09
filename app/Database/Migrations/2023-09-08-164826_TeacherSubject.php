<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TeacherSubject extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'teacher_subject_id'=>[
                'type' => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'teacher_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'subject_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ]
        ]);
        $this->forge->addKey('teacher_subject_id',true);
        $this->forge->addForeignKey('subject_id', 'subjects', 'subject_id');
        $this->forge->addForeignKey('teacher_id', 'guru','id_guru');
        $this->forge->createTable('teacher_subject');
    }

    public function down()
    {
        //
        $this->forge->dropTable('teacher_subject');
    }
}
