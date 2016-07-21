<?php
use frontend\widgets\ProductsSlider;
use frontend\widgets\ProductsFeatured;
use frontend\widgets\OfferSlider;
$banner11 = unserialize($women_model->banner1);	
$banner21 = unserialize($women_model->banner2);
$banner31 = unserialize($women_model->banner3);
$banner41 = unserialize($women_model->banner4);
$banner51 = unserialize($women_model->banner5);
$banner61 = unserialize($women_model->banner6);
?>
		<div class="container-fluid">
			<div class="row">
			  <div class="col-lg-12 col-padding">
				<div class="full-slide">
					<?= ProductsSlider::widget(['type'=>"women"]); ?>
				</div>
				<div class="full-slide"> 
				  <?= ProductsFeatured::widget(['type'=>"women"]); ?>
				</div>
			  </div>
			  <!--end col-lg-12-->
			</div>
		   <!--end row-->     
		</div>
        <!--end row--->
        <!-- end of woman- shoes slide--> 
	<section class="woman-shoes">
	<div class="container-fluid woman-main">
    	<div class="row">
        	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            	<div class="row">
                	<div class="col-lg-12">
                    	<div class="woamn-stile">
						   <a href="<?= $banner11[2] ?>">
								<img src="<?= Yii::$app->params['baseurl'] . '/uploads/banner/main/'.$banner11[3]; ?>" alt="effortless" title="effortless" class="img-responsive">
							</a>
							<h3><?= $banner11[0] ?>:<span> <?= $banner11[1] ?></span></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    	<div class="woamn-stile">
                        <a href="<?= $banner21[2] ?>">
                        <img src="<?= Yii::$app->params['baseurl'] . '/uploads/banner/medium/'.$banner21[3]; ?>" alt="church" title="church" class="img-responsive">
						</a>
                       <h3><?= $banner21[0] ?>:<span> <?= $banner21[1] ?></span></h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    	<div class="woamn-stile">
                     <a href="<?= $banner31[2] ?>">   <img src="<?= Yii::$app->params['baseurl'] . '/uploads/banner/medium/'.$banner31[3]; ?>" alt="clean-lines" title="clean-lines" class="img-responsive"></a>
                       <h3><?= $banner31[0] ?>:<span> <?= $banner31[1] ?></span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="row">
                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    	<div class="woamn-stile">
                      <a href="<?= $banner41[2] ?>">
                <img src="<?= Yii::$app->params['baseurl'] . '/uploads/banner/medium/'.$banner41[3]; ?>" alt="styles" title="styles" class="img-responsive">
                      </a>
                       <h3><?= $banner41[0] ?>:<span> <?= $banner41[1] ?></span></h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    	<div class="woamn-stile">
                        <a href="<?= $banner51[2] ?>">
                        <img src="<?= Yii::$app->params['baseurl'] . '/uploads/banner/medium/'.$banner51[3]; ?>" alt="finest" title="finest" class="img-responsive">
                        </a>
                      <h3><?= $banner51[0] ?>:<span> <?= $banner51[1] ?></span></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="woamn-stile">
                        <a href="<?= $banner61[2] ?>">
                        <img src="<?= Yii::$app->params['baseurl'] . '/uploads/banner/main/'.$banner61[3]; ?>" alt="hope" title="hope" class="img-responsive">
                        </a>
                       <h3><?= $banner61[0] ?>:<span> <?= $banner61[1] ?></span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</section>
          