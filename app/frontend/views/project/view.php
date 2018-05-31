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


$script = <<< JS
    $(document).on('click', '.pjax-modal-link', () => $('#modal').modal({"show": true}));
    $(document).on('click', '.close', () => history.back());
JS;
$this->registerJs($script);
?>

<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Modal::begin(['id' => 'modal']); ?>

    <?php Pjax::begin(['id' => 'pjaxModal', 'linkSelector' => '.pjax-modal-link']); ?>
    <?php Pjax::end(); ?>

    <?php Modal::end(); ?>

    <?= Html::a('update', ["project/$projectId/blank"], ['class' => 'btn btn-primary pjax-modal-link']) ?>

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

    <?= Html::a('add task', ["project/$projectId/task/blank"], [
            'class' => 'btn btn-primary pjax-modal-link',
            'projectId' => $projectId
        ]) ?>

<!--    --><?php //Pjax::begin(); ?>
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
<!--    --><?php //Pjax::end(); ?>

</div>
