<?php

namespace common\models\records;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $task_id
 * @property int $from
 * @property int $to
 * @property string $subject
 * @property string $text
 * @property string $send_at
 * @property string $viewed_at
 *
 * @property Task $task
 */
class MessageRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'from', 'to', 'subject', 'text', 'send_at'], 'required'],
            [['task_id', 'from', 'to'], 'default', 'value' => null],
            [['task_id', 'from', 'to'], 'integer'],
            [['text'], 'string'],
            [['send_at', 'viewed_at'], 'safe'],
            [['subject'], 'string', 'max' => 255],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
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
            'from' => 'From',
            'to' => 'To',
            'subject' => 'Subject',
            'text' => 'Text',
            'send_at' => 'Send At',
            'viewed_at' => 'Viewed At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
