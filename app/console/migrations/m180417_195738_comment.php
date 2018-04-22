<?php

use yii\db\Migration;

class m180417_195738_comment extends Migration
{
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'subject' => $this->string(255)->notNull(),
            'text' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'comment_taskId_fk',
            'comment',
            'task_id',
            'task',
            'id'
        );

        $this->addForeignKey(
            'comment_authorId_fk',
            'comment',
            'author_id',
            'user',
            'id'
        );
    }

    public function down()
    {
        $this->dropTable("comment");
    }
}
