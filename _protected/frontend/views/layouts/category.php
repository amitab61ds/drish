<?php 
use frontend\assets\CatAsset;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

CatAsset::register($this);
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
        <!-- end of slider-->
    <div class="page-content craftmanship-main csr-main">
		<?= $this->render('header.php')?>
		<?= Alert::widget() ?>
		<?= $content ?> 
		<?= $this->render('footer.php')?>
	</div>
</div><!--end full page-->
<?php $this->endBody() ?>
<script>

    $(function () {

        $("#range").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 1800,
            max: 3000,
            from: 1900,
            to: 2800,
            type: 'double',
            step: 1,
            prefix: "Rs ",
            grid: true
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
     <script>

$( "#selectmenu" ).selectmenu();
$( "#selectmenu-1" ).selectmenu();
$( "#selectmenu-2").selectmenu();
$( "#selectmenu-3").selectmenu();
$( "#selectmenu-4").selectmenu();
$( "#selectmenu-5").selectmenu();
$( "#selectmenu-6").selectmenu();


 $(function () {

        $("#range").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 0,
            max: 5000,
            from: 1000,

            to: 4000,
            type: 'double',
            step: 1,
            prefix: "$",
            grid: true
        });

    });

  </script> 
</body>
</html>
<?php $this->endPage() ?>
