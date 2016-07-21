<?php 
use yii\helpers\Url;
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="user-account white-bg">
			<div class="profile-upload">
				<div class="user-profile">
					<a href="javascript:void(0);">
						<img title="usr-profile" alt="user-profile" src="/uploads/site/medium/user-profile.png">
					</a>
				</div>					
				<!--<div class="cahnge-img"><a href="#"><img title="capture" alt="capture" src="/uploads/site/medium/capture.png"></a></div>-->
			</div>					
			<h3><?= Yii::$app->user->identity->username ?></h3>
			<p><?= Yii::$app->user->identity->email ?></p>
			<p><?= Yii::$app->user->identity->profile->phone ?></p>
			<p><a href="<?= Url::to(['/account/information']) ?>">Edit Account Info</a></p>			
			<p><a data-method="post" href="<?= Url::to(['/user/security/logout']) ?>">Logout</a></p>
			
		</div>
	</div>
</div>
<div class="notification-area">
	<div class="row">
		<!--div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="notif white-bg  gry">
			<ul>
			<li><a href="#">
			<span class="bell">
			<img title="usr-profile" alt="user-profile" src="/uploads/site/medium/notification.png">
			<img title="usr-profile" alt="user-profile" src="/uploads/site/medium/notification-count.png" class="count">
			</span>
			</a></li>
			<li><a href="#"> Notification</a></li>
			<li class="right-text"><a href="#"> View All</a></li>
			</ul>
			</div>
		</div-->
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="notif white-bg">
				<ul>
					<li>
						<a href="#">
							<img title="application" alt="application" src="/uploads/site/medium/application.png">
						</a>
					</li>
					<li><a href="<?= Url::to(['/account/applications']) ?>"> All Application </a></li>
					<li class="right-text"><a href="<?= Url::to(['/account/applications']) ?>"> View All</a></li>
				</ul>
			</div>	
			<div class="notif white-bg">
				<ul>
					<li>
						<a href="#">
							<img title="application" alt="application" src="/uploads/site/medium/application.png">
						</a>
					</li>
					<li><a href="<?= Url::to(['/account/mywishlist']) ?>"> My WishList </a></li>
					<li class="right-text"><a href="<?= Url::to(['/account/mywishlist']) ?>"> View All</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>