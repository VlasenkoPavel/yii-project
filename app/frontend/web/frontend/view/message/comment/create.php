<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CommentRecord */

$this->title = 'Create Comment Record';
$this->params['breadcrumbs'][] = ['label' => 'Comment Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
