<?php

namespace frontend\models;

use Yii;

class RecordsFactory
{
    public static function createProjectRecord(): ProjectRecord {
        $model = new ProjectRecord();

        $model->load(Yii::$app->request->post());
        $model->save();

        return $model;
    }

}