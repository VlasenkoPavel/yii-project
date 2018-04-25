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

$this->registerJs("
$(document).on('click', '.project-link', function() {
    JQuery('#project-task-list-modal').modal.({\"show\":true});
     });
");

?>

<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Modal::begin(['id' => 'project-task-list-modal', 'toggleButton' => [
                        'label' => Yii::t('app', 'update'),
                        'tag' => 'a',
                        'class' => 'btn btn-primary',
                    ]]); ?>

    <?php Pjax::begin(['id' => 'project-task-list-pjax-container', 'linkSelector' => '.project-link']); ?>
    <?php Pjax::end(); ?>

    <?php Modal::end(); ?>

    <?= Html::a('test', ['create'], ['class' => 'btn btn-success project-link']); ?>

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


</div>
