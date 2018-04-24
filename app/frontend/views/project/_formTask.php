<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use kartik\datetime\DateTimePicker;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model frontend\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'description')->widget(TinyMce::ClassName()); ?>

    <?php $employers = User::findAll(['role_id' => 4]);
        $employersList = [];
        foreach ($employers as $key => $value) {
            $id = $value['id'];
            $name = $value['name'].' '.$value['surname'];
            $employersList["$id"] = $name;
        }
    ?>

    <?= $form->field($model, 'executor["id"]')->dropDownList($employersList); ?>

    <?=
        $form->field($model, 'deadline')->widget(DateTimePicker::className(),[
            'name' => 'datetime_1',
            'type' => DateTimePicker::TYPE_INPUT,
            'options' => ['placeholder' => 'Select deadline...'],
                'convertFormat' => true,
                'value'=> date("d.m.Y h:i"),
                'pluginOptions' => [
                'format' => 'dd.MM.yyyy hh:i',
                'autoclose'=>true,
                'weekStart'=>1,
                'startDate' => date("d.m.Y h:i"),
                'todayBtn'=>true,
                ]
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
