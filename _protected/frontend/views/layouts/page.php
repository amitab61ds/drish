<?php
use frontend\assets\InnerAsset;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

InnerAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="wrapper">
	<div class="page-content">
		<?= $this->render('header.php')?>
		<?= Alert::widget() ?>
		<?= $content ?> 
		<?= $this->render('footer.php')?>
	</div>
</div><!--end full page-->
<?php $this->endBody() ?>
      <script type="text/javascript">
         $(function() {
         	$('nav#menu').mmenu({
         		extensions	: [ 'effect-slide-menu', 'pageshadow' ],
         		searchfield	: true,
         		counters	: true,
         		navbar 		: {
         			title		: 'Menu'
         		},
         		navbars		: [
         			{
         				position	: 'top',
         				content		: [ 'searchfield' ]
         			}, {
         				position	: 'top',
         				content		: [
         					'prev',
         					'title',
         					'close'
         				]
         			} 
         		]
         	});
         });
      </script>
</body>
</html>
<?php $this->endPage() ?>
