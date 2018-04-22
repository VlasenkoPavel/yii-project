<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use frontend\models\domain\Project;
use frontend\models\domain_repositories\ProjectRepository;

//use frontend\models\Task;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProjectRecordSearch*/
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'raw',
                 'value' => function ($model) {
                    return Html::a($model->name, ["project/$model->id/task"], ['id'=>'testButton', 'class' => 'table']);
                },

            ],
            'description:ntext',
            'created_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

<p>
    <?php
        Modal::begin(
            [
                'id' => 'projectCreateModal',
                'toggleButton' => [
                    'label' => Yii::t('app', 'create new'),
                    'tag' => 'a',
                    'class' => 'btn btn-success',
                ],
                'clientOptions' => false,
            ]
        );
    ?>

    <?php $project = new Project(['id' => Yii::$app->user->getId()]); ?>
    <?= $this->render('_form', ['model' => $project]) ?>

    <?php
        if ($project->load(Yii::$app->request->post())) {
            ProjectRepository::add($project);
            $id = $project->getId();

        return Yii::$app->getResponse()->redirect(["project/$id/task"])->send();
        }
    ?>

    <?php Modal::end(); ?>
</p>
