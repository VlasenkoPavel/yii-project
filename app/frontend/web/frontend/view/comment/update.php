<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CommentRecord */

$this->title = 'Update Comment Record: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Comment Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comment-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
