<?php

namespace frontend\models\domain_repositories;

use frontend\models\domain_repositories\TaskRepository;
use common\models\records\ProjectRecord;
use common\models\User;
use frontend\models\domain\Project;

class ProjectRepository
{
    public static function getById(int $projectId): Project {
        $projectRecord = ProjectRecord::findOne($projectId);
        $creator = User::findOne($projectRecord->creator_id);

        return new Project($creator->attributes, $projectRecord->attributes);
    }

    public static function add(Project $project) {
        $projectRecord = new ProjectRecord($project->getSaveData());
        $projectRecord->save();
        $project->setId($projectRecord->id);
        $project->setCreatedAt($projectRecord->created_at);
    }

    public static function save(Project $project) {
        $projectRecord = ProjectRecord::findOne($project->getId());
        $projectRecord->setAttributes($project->getSaveData());
        $projectRecord->save();
        $project->setUpdatedAt($projectRecord->updated_at);
    }
}