<?php

namespace common\models\records;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $creator_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $creator
 * @property Task[] $tasks
 */
class ProjectRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
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
            [['name', 'description', 'creator_id'], 'required'],
            [['description'], 'string'],
            [['creator_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }


    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['project_id' => 'id']);
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
