<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use frontend\models\domain\Project;
use frontend\models\domain\Task;
use frontend\models\domain_repositories\ProjectRepository;
use frontend\models\domain_repositories\TaskRepository;


/* @var $this yii\web\View */
/* @var $model frontend\models\domain\Project */

$this->title = $model->getName();
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$projectId = $model->getId();
$modelAttr = $model->getViewData();

?>

<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Modal::begin(
        [
            'id' => 'projectUpdateModal',
            'toggleButton' => [
                'label' => Yii::t('app', 'update'),
                'tag' => 'a',
                'class' => 'btn btn-primary',
            ],
            'clientOptions' => false,
        ]
    ); ?>


    <?= $this->render('_form', ['model' => $model, 'action' => 'update']) ?>

    <?php Modal::end(); ?>

    <?= Html::a('Delete', ['delete', 'id' => $model->getId()], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]); ?>
    <p>
        <?= DetailView::widget([
            'model' => $modelAttr,

            'attributes' => [
                'name',
                'description:ntext',
                'creator',
                'creation date',
                'last update'
            ],
        ]) ?>
    </p>
    <?php
    Modal::begin(
        [
            'id' => 'taskCreateModal',
            'toggleButton' => [
                'label' => Yii::t('app', 'add task'),
                'tag' => 'a',
                'class' => 'btn btn-success',
            ],
            'clientOptions' => false,
        ]
    );
    ?>

    <?php $task = new Task(['id' => Yii::$app->user->getId()]); ?>

    <?= $this->render('_formTask', ['model' => $task]) ?>

    <?php
    if ($task->load(Yii::$app->request->post())) {
        TaskRepository::add($task);
        $id = $task->getId();

        return Yii::$app->getResponse()->redirect(["/task/$id"])->send();
    }
    ?>

    <?php Modal::end(); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) use ($projectId)  {
                    return Html::a($model->name, ["project/$projectId/task/$model->id"], ['id'=>'testButton', 'class' => 'table']);
                },

            ],
            'description:ntext',
            'executor_id',
            'deadline',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
