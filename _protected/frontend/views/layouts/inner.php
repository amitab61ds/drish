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
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<style rel="stylesheet">
        body{display:none;}
		
		.sticky { position:fixed; top:0; left:0; right:0; background:#fff; width:100%; z-index:999;}
    </style>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="slide-content">
			<?= $this->render('header2.php')?>
</div>
<div id="wrapper">
	<?= $this->render('slider.php')?>
	<div class="page-content">
	
		<?= Alert::widget() ?>
		<?= $content ?>
		<?= $this->render('footer-up.php')?>
		<?= $this->render('footer.php')?>
	</div>
</div><!--end full page-->
<?php $this->endBody() ?>
 <script>
	$(function(){
		$(".s-icon a").click(function(){			
			$(".pop-search").slideToggle();
		});

		});
      		</script>
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
