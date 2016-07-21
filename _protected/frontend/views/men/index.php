<?php
use frontend\widgets\ProductsSlider;
use frontend\widgets\ProductsFeatured;
use frontend\widgets\OfferSlider;
?>
			<div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12 col-padding">
                    <div class="full-slide">
                        <?= ProductsSlider::widget(['type'=>"men"]); ?>
                    </div>
					<div class="full-slide"> 
                      <?= ProductsFeatured::widget(['type'=>"men"]); ?>
					</div>
                  </div>
                  <!--end col-lg-12-->
               </div>
               <!--end row--->
                
               <!--end row-->     
            </div>
            <!-- gallery start-->
            <div class="gallery">
               <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 col-padding">
					<div class="gallery-bg">
						<img src="<?= Yii::$app->params['baseurl'] ?>/images/gallery-bg.jpg" class="img-responsive">
					</div><!--end gallery-bg-->
               
                    <div class="shop-faq-bg">
                    	<img src="<?= Yii::$app->params['baseurl'] ?>/images/shop-faq-bg.jpg" class="img-responsive">
                    </div>
                    <!--end faq-img-->
                    <div class="gallery-images">
                    <div class="chamaripa-img">
                    	<img src="<?= Yii::$app->params['baseurl'] ?>/images/gallery-img-1.jpg" class="img-responsive">
                    </div><!--end chama-img-->
                    <div class="step-img">
                    	<img src="<?= Yii::$app->params['baseurl'] ?>/images/gallery-img-2.jpg" class="img-responsive">
                    </div><!--end chama-img-->
                    <div class="chamaripa-img-3">
                    	<img src="<?= Yii::$app->params['baseurl'] ?>/images/gallery-img-3.png" class="img-responsive">
                    </div><!--end chama-img--> 
                    </div><!--end gallery-images--> 
                      
                </div><!--end col-lg-7-->
               <!--end col-lg-7-->
				<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 col-padding">
                   <?= OfferSlider::widget(); ?>
				</div>
               <!--end col-lg-5-->
            </div>
            <!-- gallery end-->
            <!-- design slider start-->
			<?php if(Yii::$app->params['settings']['show_hide_video'] == 1){ ?>
            <div class="design-slider">
               <div data-ride="carousel" class="carousel slide" id="myCarousel-arrow">
                  <!-- Wrapper for slides -->
                  <div class="frnt-video" style="width: 100%; overflow: hidden; height: 350px;">
                     <video class="home_video" width="100%" loop autoplay="" controls muted>
                       <source src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/setting/<?= $product_setting->video ?>" type="video/mp4">
                     </video>
                  </div>
               </div>
            </div>
			<?php } ?>
