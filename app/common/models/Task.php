<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use frontend\models\query\TaskQuery;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $creator_id
 * @property int $executor_id
 * @property int $project_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deadline
 *
 * @property User $creator
 * @property User $executor
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
            [
                'class' => TimestampBehavior::className(),
                'value' => function () {
                    return date('Y-m-d G:i:s');
                }
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['executor_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Task name',
            'description' => 'Description',
            'creator_id' => 'Creator ID',
            'executor' =>'Executor name',
            'executor_id' => 'Executor',
            'project_id' => 'project_id',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deadline' => 'Deadline',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
    }

    /**
     * @inheritdoc
     * @return TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\query\TaskQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->creator_id = Yii::$app->user->getId();
        }

        return parent::beforeSave($insert);
    }
}



