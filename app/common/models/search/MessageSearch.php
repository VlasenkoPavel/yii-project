<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\records\MessageRecord;

/**
 * MessageSearh represents the model behind the search form of `frontend\models\Message`.
 */
class MessageSearch extends MessageRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'task_id', 'from', 'to'], 'integer'],
            [['subject', 'text', 'send_at', 'viewed_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MessageRecord::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'task_id' => $this->task_id,
            'from' => $this->from,
            'to' => $this->to,
            'send_at' => $this->send_at,
            'viewed_at' => $this->viewed_at,
        ]);

        $query->andFilterWhere(['ilike', 'subject', $this->subject])
            ->andFilterWhere(['ilike', 'text', $this->text]);

        return $dataProvider;
    }
}
