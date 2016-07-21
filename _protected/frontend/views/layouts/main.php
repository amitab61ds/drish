<?php
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div id="fullpage">
        <div class="section " id="section1">
        <?= Alert::widget() ?>
        <?= $content ?>


        <footer class="footer-home">
             <span>&copy; 2016 Drish. All Rights Reserved.</span>
		</footer>
    </div><!--end section-->
    </div><!--end full page-->
    <?php $this->endBody() ?>
   <script type="text/javascript">
		$(document).ready(function() {
			$('#fullpage').fullpage({
				anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage', 'lastPage'],
				menu: '#menu',
				scrollingSpeed: 1000
			});
			if($(".fp-tableCell img").length){
                var imgsrc = $(".fp-tableCell img").attr("src");
                imgsrc = "url('"+imgsrc+"')";
                $(".fp-tableCell").css("background-image",imgsrc);
                
            }
		});
		
	</script>
</body>
</html>
<?php $this->endPage() ?>
