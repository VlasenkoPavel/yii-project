<?php

namespace frontend\models\domain_repositories;

use frontend\models\domain_repositories\DomainRepository;
use common\models\records\TaskRecord;
use frontend\models\domain\Task;
use common\models\User;


class TaskRepository extends DomainRepository
{
    public static function getById(int $taskId): Task {
        $taskRecord = TaskRecord::findOne($taskId);
        $creator = User::findOne($taskRecord->creator_id);
        $executor = User::findOne($taskRecord->executor_id);

        $executor ? ($executorAttributes = $executor->attributes) : $executorAttributes =[];

        return new Task($creator->attributes, $taskRecord->attributes,  $executorAttributes);
    }

    public static function add(Task $task) {
        $taskRecord = new TaskRecord($task->getSaveData());
        $taskRecord->save();
        $task->setId($taskRecord->id);
        $task->setCreatedAt($taskRecord->created_at);
    }

    public static function save(Task $task) {
        $taskRecord = ProjectRecord::findOne($task->getId());
        $taskRecord->setAttributes($task->getSaveData());
        $taskRecord->save();
        $task->setUpdatedAt($taskRecord->updated_at);
    }
}
