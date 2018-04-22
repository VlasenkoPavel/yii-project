<?php

use yii\db\Migration;

//'id' => $this->primaryKey(),
//'task_id' => $this->integer()->notNull(),
//'author_id' => $this->integer()->notNull(),
//'subject' => $this->string(255)->notNull(),
//'text' => $this->text()->notNull(),
//'created_at' => $this->dateTime()->notNull(),
//'updated_at' => $this->dateTime(),
class m180419_063437_test_comment extends Migration
{
    public function up()
    {
        $this->insert('comment', [
            'task_id' => 1,
            'author_id' => 1,
            'subject' => 'comment1',
            'text' => 'adminProj task1 test comment1',
            'created_at' => date('Y-m-d G:i:s'),
        ]);

        $this->insert('comment', [
            'task_id' => 1,
            'author_id' => 1,
            'subject' => 'comment2',
            'text' => 'adminProj task1 test comment2',
            'created_at' => date('Y-m-d G:i:s'),
        ]);

        $this->insert('comment', [
            'task_id' => 1,
            'author_id' => 1,
            'subject' => 'comment3',
            'text' => 'adminProj task1 test comment3',
            'created_at' => date('Y-m-d G:i:s'),
        ]);

    }

    public function down()
    {
        $this->delete('comment', ['subject' => 'comment1']);
        $this->delete('comment', ['subject' => 'comment2']);
        $this->delete('comment', ['subject' => 'comment3']);
    }
}
