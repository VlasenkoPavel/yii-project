<?php

namespace frontend\models\query;

/**
 * This is the ActiveQuery class for [[Access]].
 *
 * @see Access
 */
class AccessQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * Condition with task_id
     * @param $task_id
     * @return $this
     */
    public function withTask(int $task_id)
    {
        return $this->andWhere(
            'task_id = :task_id',
            [
                ":task_id" => $task_id
            ]
        );
    }

    /**
     * Condition with user_id
     * @param $user_id
     * @return $this
     */
    public function withUser(int $user_id)
    {
        return $this->andWhere(
            'user_id = :user_id',
            [
                ":user_id" => $user_id
            ]
        );
    }

    /**
     * @inheritdoc
     * @return Access[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Access|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
