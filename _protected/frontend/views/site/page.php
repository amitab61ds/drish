<?php
$this->title = ($model->meta_title ? $model->meta_title : $model->name);

?>

   <div class="row">
   	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    	<div class="craftman-ship-title">
        <img src="<?= Yii::$app->homeUrl?>uploads/pages/large/<?= $model->featured_image ?>" class="img-responsive" alt="<?= $model->name ?>" title="<?= $model->name ?>">
        <h1><?= $model->name ?></h1>
        </div>
    </div>
   </div>
   <div class="container-fluid craftsmanship-area">
	   <div class="bredcrumb-nav">
		   <ul>
				<li><a href="<?= Yii::$app->homeUrl?>">Home</a></li>
				<li class="active"><a href="javascript:void(0);"><?= $model->name ?></a></li>
			</ul>
		</div>
	</div>
	<?= $model->description ?>