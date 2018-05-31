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

<?php
$script = <<< JS
    $(document).on('click', '.pjax-modal-link', () => $('#projectCreateModal').modal({"show": true}));
    // $(document).on('click', '.close', () => $(location).attr('href','/project'));
    $(document).on('click', '.close', () => history.back());
JS;
$this->registerJs($script);
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
            [
                'class' => \yii\grid\ActionColumn::className(),
                'template'=>'{update} {delete}',
            ],
        ],
    ]); ?>

</div>

<p>
    <?php Modal::begin(['id' => 'projectCreateModal',]); ?>

        <?php Pjax::begin(['id' => 'pjaxModalContainer', 'linkSelector' => '.pjax-modal-link']); ?>
        <?php Pjax::end(); ?>

    <?php Modal::end(); ?>

    <?= Html::a('create', ['create'], ['class' => 'btn btn-primary pjax-modal-link']) ?>
</p>
