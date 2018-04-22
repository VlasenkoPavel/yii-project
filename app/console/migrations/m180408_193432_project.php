<?php

use yii\db\Migration;

/**
 * Class m180408_193432_project
 */
class m180408_193432_project extends Migration
{
    public function up()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'creator_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()
        ]);

    }

    public function down()
    {
        $this->dropTable("project");
    }
}
