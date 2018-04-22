<?php

namespace frontend\models\domain_repositories;

use common\models\records\TaskRecord;
use common\models\records\UserRecord;
use frontend\models\domain\Task;

class TaskRepository
{
//    public static function getTaskById(int $taskId){
//        $taskRecord = TaskRecord::findOne($taskId);
//        $creator = UserRecord::findOne($taskRecord->creator_id);
//        $executor = UserRecord::findOne($taskRecord->executor_id);
//
//        $executor ? ($executorAttributes = $executor->attributes) : $executorAttributes =[];
//
//        return new Task($taskRecord->attributes, $creator->attributes, $executorAttributes);
//    }

//    public static function getTasksByProjectId($projectId){
//        $taskRecord = new TaskRecord();
//        return $taskRecord->getTasksByProjectId($projectId);
//    }

    public static function getById(int $taskId): Task {
        $taskRecord = TaskRecord::findOne($taskId);
        $creator = User::findOne($taskRecord->creator_id);
        $executor = User::findOne($taskRecord->executor_id);

        $executor ? ($executorAttributes = $executor->attributes) : $executorAttributes =[];

        return new Task($creator->attributes, $taskRecord->attributes,  $executorAttributes);
    }

    public static function add(Task $task) {
        $taskRecord = new TasktRecord($task->getSaveData());
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
