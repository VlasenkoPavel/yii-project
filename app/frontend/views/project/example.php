<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
?>
<div>
    <?php Pjax::begin(); ?>
    <?= Html::a(
        'Обновить',
        ['/project/create'],
        ['class' => 'btn btn-lg btn-primary']
    ) ?>
    <p>Время сервера: <?= $time ?></p>
    <p>Время сервера: <?= $time ?></p>
    <?php Pjax::end(); ?>
</div>
<p>Время сервера: <?= $time ?></p>

