<?php

namespace frontend\models;

use Yii;
use \common\models\query\AccessQuery;

/**
 * This is the model class for table "access".
 *
 * @property int $id
 * @property int $note_id
 * @property int $user_id
 *
 * @property User $user
 * @property Task $task
 */
class Access extends \yii\db\ActiveRecord
{
    const ACCESS_CREATOR = 3;
    const ACCESS_EXECUTOR = 2;
    const ACCESS_GUEST = 1;
    const ACCESS_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'access';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id'], 'required'],
            [['task_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Check access current user by note
     * @param Task $model
     * @param $userId int
     * @return bool|int
     */
    public static function checkAccess(Task $model, int $userId): int
    {
        if($model->creator_id == $userId) {
            return self::ACCESS_CREATOR;
        }

        if($model->executor_id == $userId) {
            return self::ACCESS_EXECUTOR;
        }

        $existsAccess = self::find()
            ->withTask($model->id)
            ->withUser($userId)
            ->exists();

        if($existsAccess) {
            return self::ACCESS_GUEST;
        }

        return self::ACCESS_NO;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask ()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser ()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return AccessQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\AccessQuery(get_called_class());
    }
}
