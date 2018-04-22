<?php
use yii\helpers\Html;
?>

<p>Registration successful.</p>

<p>Your registration data:</p>

<ul>
    <li><label>Name</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Email</label>: <?= Html::encode($model->email) ?></li>
</ul>