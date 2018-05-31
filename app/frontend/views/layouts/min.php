<?php
    use yii\helpers\Html;
    $this->beginPage();
    $this->head();
    echo Html::csrfMetaTags();
?>

<body>
<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
<?php $this->endPage() ?>