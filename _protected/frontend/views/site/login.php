<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Login;
use frontend\widgets\Registration;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signin-regi" >
	<div class="container">
		<h3>Login or Create an Account</h3>
		  <?= Login::widget() ?> 
		  <?= Registration::widget() ?> 
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="sign-in-social">
					<ul>
						<li><img src="<?= Yii::$app->params['baseurl'] ?>/images/sign-f.png" alt="f-icon" title="f-icon"></li>
						<li><img src="<?= Yii::$app->params['baseurl'] ?>/images/sign-in-g.png" alt="g-icon" title="g-icon"></li>
						<li><img src="<?= Yii::$app->params['baseurl'] ?>/images/sign-in-insta.png" alt="instagran-icon" title="instagram-icon"></li>
					
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>		