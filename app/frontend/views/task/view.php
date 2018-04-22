<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model frontend\models\domain\Task */

$this->title = $model->getName();
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$modelAttributes = $model->getAttributes();

?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->getId()], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->getId()], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $modelAttributes,

        'attributes' => [
            'name',
            'description:ntext',
            'creator',
            'creation date',
            'last update'
        ],
    ]) ?>

    <p>
        <?= Html::a('add comment', ["project/$projectId/task/blank"], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            [
//                'attribute' => 'name',
//                'format' => 'raw',
//                'value' => function ($model) use ($projectId)  {
//                    return Html::a($model->name, ["project/$projectId/task/$model->id"], ['id'=>'testButton', 'class' => 'table']);
//                },
//
//            ],
            'subject',
            'text:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
