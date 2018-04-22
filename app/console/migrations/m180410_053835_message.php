<?php

use yii\db\Migration;

class m180410_053835_message extends Migration
{
    public function up()
    {
        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'from' => $this->integer()->notNull(),
            'to' => $this->integer()->notNull(),
            'subject' => $this->string(255)->notNull(),
            'text' => $this->text()->notNull(),
            'send_at' => $this->dateTime()->notNull(),
            'viewed_at' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'message_taskId_fk',
            'message',
            'task_id',
            'task',
            'id'
        );
    }

    public function down()
    {
        $this->dropTable("message");
    }
}
