<?php
use frontend\assets\ProductsAsset;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\web\View;

/* @var $this \yii\web\View */
/* @var $content string */

ProductsAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head();

	$this->registerJs("var baseurl = ".json_encode(Yii::$app->request->baseUrl).";", View::POS_END);

	?>
	
</head>
<body>
<?php $this->beginBody() ?>
<div id="wrapper">
    <div class="page-content">
        <?= $this->render('product-header.php')?>
		<?= Alert::widget() ?>
		<div class="flash"><span></span></div>
        <?= $content ?>

    </div>
        <?= $this->render('footer.php')?>

</div><!--end full page-->
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
