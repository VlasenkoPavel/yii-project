<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProjectRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">
    <?php if ($action == 'update') {
        $id = $model->getId();
        $form = ActiveForm::begin(['action' =>["/project/$id/$action"]]);
    } else {
        $form = ActiveForm::begin(['action' =>["/project/create"]]);
    } ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php if ($action == 'update') {
            $id = $model->getId();
            echo Html::submitButton('Update', ['class' => 'btn btn-success', 'action' => "http://localhost/project/$id/$action"]);
        } else {
            echo Html::submitButton('Create', ['class' => 'btn btn-success', 'action' => "http://localhost/project/create"]);
        } ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
