<?php

use yii\db\Migration;

/**
 * Class m180408_193800_fks_project_task
 */
class m180408_193800_fks_project_task extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            'task_projectId_fk',
            'task',
            'project_id',
            'project',
            'id'
        );

        $this->addForeignKey(
            'project_creatorId_fk',
            'project',
            'creator_id',
            'user',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'task_projectId_fk',
            'task'
        );

        $this->dropForeignKey(
            'project_creatorId_fk',
            'project'
        );;
    }
}
