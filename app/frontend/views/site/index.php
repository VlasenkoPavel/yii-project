<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';


?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Wellcome to Task Manager</h1>

        <p class="lead">Autor: Pavel Vlasenko. Geek university tests project.</p>

        <p>
            <?= Html::a('Get started', ['/project'], ['class' => 'btn btn-success']) ?>
        </p>
<!--        <p><a class="btn btn-lg btn-success" href="">Get started</a></p>-->
    </div>

    <div class="body-content">


    </div>
</div>
