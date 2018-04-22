<?php

use yii\db\Migration;

/**
 * Class m180311_102231_fks_user_task
 */
class m180311_102231_fks_user_task extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            'fk_task_1',
            'task',
            'creator_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk_task_2',
            'task',
            'executor_id',
            'user',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk_task_1',
            'task'
        );

        $this->dropForeignKey(
            'fk_task_2',
            'task'
        );;
    }
}