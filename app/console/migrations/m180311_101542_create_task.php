<?php

use yii\db\Migration;

/**
 * Class m180311_101542_create_task
 */
class m180311_101542_create_task extends Migration
{
    public function up()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'creator_id' => $this->integer()->notNull(),
            'executor_id' => $this->integer(),
            'project_id' => $this->integer(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime(),
            'deadline' => $this->dateTime()
        ]);

    }

    public function down()
    {
        $this->dropTable("task");
    }
}
