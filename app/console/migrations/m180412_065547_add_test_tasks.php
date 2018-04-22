<?php

use yii\db\Migration;

class m180412_065547_add_test_tasks extends Migration
{
    public function up()
    {
        $this->insert('task', [
            'name' => 'adminProj task1',
            'description' => 'admins project test task',
            'creator_id' => 1,
            'project_id' => 1,
            'created_at' => date('Y-m-d G:i:s'),
        ]);

        $this->insert('task', [
            'name' => 'adminProj task2',
            'description' => 'admins project test task',
            'creator_id' => 1,
            'project_id' => 1,
            'created_at' => date('Y-m-d G:i:s'),
        ]);

        $this->insert('task', [
            'name' => 'ivanProj task1',
            'description' => 'ivans project test task',
            'creator_id' => 2,
            'project_id' => 2,
            'created_at' => date('Y-m-d G:i:s'),
        ]);

        $this->insert('task', [
            'name' => 'ivanProj task2',
            'description' => 'ivans project test task',
            'creator_id' => 2,
            'project_id' => 2,
            'created_at' => date('Y-m-d G:i:s'),
        ]);

        $this->insert('task', [
            'name' => 'ivanProj task3',
            'description' => 'ivans project test task',
            'creator_id' => 2,
            'project_id' => 2,
            'created_at' => date('Y-m-d G:i:s'),
        ]);

    }

    public function down()
    {
        $this->delete('task', ['name' => 'adminProj task1']);
        $this->delete('task', ['name' => 'adminProj task2']);
        $this->delete('task', ['name' => 'ivanProj task1']);
        $this->delete('task', ['name' => 'ivanProj task2']);
        $this->delete('task', ['name' => 'ivanProj task3']);
    }
}
