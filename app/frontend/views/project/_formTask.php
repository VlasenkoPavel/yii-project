<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model frontend\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>

    <?php $employers = User::findAll(['role_id' => 4]);
        $employersList = [];
        foreach ($employers as $key => $value) {
            $id = $value['id'];
            $name = $value['name'].' '.$value['surname'];
            $employersList["$id"] = $name;
        }
    ?>

    <?= $form->field($model, 'executor["id"]')->dropDownList($employersList); ?>

    <?= $form->field($model, 'deadline')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?= $form->field($model, 'from_date')->widget(\yii\jui\DatePicker::class, [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

</div>
