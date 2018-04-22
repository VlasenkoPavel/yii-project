<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'login'); ?>

<?= $form->field($model, 'name'); ?>

<?= $form->field($model, 'surname'); ?>

<?= $form->field($model, 'email'); ?>

<?= $form->field($model, 'password')->passwordInput(); ?>

<?= $form->field($model, 'password_repeat')->passwordInput(); ?>

    <div class="form-group">
        <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
    </div>

<p>
    <?php
        if($message) {
            echo $message;
        }
    ?>
</p>

<?php ActiveForm::end(); ?>