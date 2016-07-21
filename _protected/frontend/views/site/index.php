<?php

/* @var $this yii\web\View */
$this->title = Yii::$app->params['settings']['site_meta_title'];
use yii\helpers\Url;
?>

        
     <img src="<?= Yii::$app->homeUrl ?>uploads/settings/main/<?= Yii::$app->params['settings']['feature_banner'] ?>" alt="logo" class="center-block1">
        
        <div class="home_bg" style="background-image:url(<?= Yii::$app->homeUrl ?>uploads/settings/main/<?= Yii::$app->params['settings']['feature_banner'] ?>);">
        </div><!--end home_bg-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <a href="#" class="logo"><img src="<?= Yii::$app->homeUrl ?>uploads/settings/main/<?= Yii::$app->params['settings']['landing_logo'] ?>" alt="logo" class="center-block"></a>
                    <h6 class="celebrate-tag-line">Celebrate leather</h6>
                </div><!--ebd col-lg-12-->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="navigation">
                        <ul>
                            <li><a href="<?= Url::to(['men/index']) ?>">MENS</a></li>
							<li>|</li>
							<li><a href="<?= Url::to(['women/index']) ?>">WOMENS</a></li>
							<li>|</li>
							<li><a href="<?= Url::to(['children/index']) ?>">CHILDREN</a></li>
                        </ul>
                    </div>
                </div><!--ebd col-lg-12-->
            </div><!--end row-->        
            </div><!--end container-->  
			