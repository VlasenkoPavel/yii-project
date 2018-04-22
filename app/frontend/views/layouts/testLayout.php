<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<?php require_once '/var/www/app/frontend/views/layouts/testLayoutElements/__head.php'; ?>

<?php require_once '/var/www/app/frontend/views/layouts/testLayoutElements/__navBar.php'; ?>

<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php require_once '/var/www/app/frontend/views/layouts/testLayoutElements/__navBar.php'; ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php require_once '/var/www/app/frontend/views/layouts/testLayoutElements/__footer.php'; ?>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
