<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Task;

/**
 * TaskSearch represents the model behind the search form of `frontend\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creator_id', 'executor_id', 'project_id'], 'integer'],
            [['name', 'description', 'created_at', 'updated_at', 'deadline'], 'safe'],
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
        $query = Task::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $this->project_id = (int) $params["projectId"];
//        var_dump( $params );
//        echo ('<br>');
//        echo ('<br>');
//        var_dump( $this->project_id);die;
//        $this->setAttributes($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
//        var_dump($params);
//        echo ("<br>");
//        echo ("<br>");
//        var_dump($this->attributes);die;
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'name'  => $this->name,
            'description' => $this->description,
            'creator_id' => $this->creator_id,
            'executor_id' => $this->executor_id,
            'project_id' => $this->project_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deadline' => $this->deadline,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
