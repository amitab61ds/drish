<?php
use frontend\widgets\FooterMenu;
use common\models\Wishlist;
use common\models\Product;
use yii\helpers\Url;
?>
<!-- footer start-->
<div class="footer">
            <div class="container-fluid">
            <div class="f-width">
            <div class="f-nav">
				<a href="#" class="f-titles">CUSTOMER CARE:</a>
				<ul>
                            <li><a href="#">jannatrosha@drish.com</a></li>  
                            <li><a href="#">Toll Free: 1800 137 0107</a></li>  
                            <li><a href="#">Free Shipping + Free Returns</a></li>        
                </ul>
            </div>
			<?= FooterMenu::widget() ?> 
			</div>
                  <div class="f-social">
                   <div class="foot-socials">
                   <h4>Follow Us</h4>
                        <ul>
                               <?php if(Yii::$app->params['settings']['facebook'] !="") { ?>
								<li><a href="<?= Yii::$app->params['settings']['facebook'] ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<?php } ?>
							<?php if(Yii::$app->params['settings']['twitter'] !="") { ?>
								<li><a href="<?= Yii::$app->params['settings']['twitter'] ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<?php } ?>
							<?php if(Yii::$app->params['settings']['google_plus'] !="") { ?>
								<li><a href="<?= Yii::$app->params['settings']['google_plus'] ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
							<?php } ?>
							<?php if(Yii::$app->params['settings']['instagram'] !="") { ?>
								 <li><a href="<?= Yii::$app->params['settings']['instagram'] ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<?php } ?>
							<?php if(Yii::$app->params['settings']['linked_in'] !="") { ?>
								<li><a href="<?= Yii::$app->params['settings']['linked_in'] ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
							<?php } ?>
							<?php if(Yii::$app->params['settings']['pintrest'] !="") { ?>
								 <li><a href="<?= Yii::$app->params['settings']['pintrest'] ?>" ><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
							<?php } ?>
                           
                        </ul>
                    </div><!--end foot-social-->
                </div><!--end col-lg-2-->
                <div class="logo-copyright">
					<a href="<?= Yii::$app->homeUrl ?>" class="f-logo-m"><img src="<?= Yii::$app->homeUrl ?>uploads/settings/main/<?= Yii::$app->params['settings']['innerlogo'] ?>" alt="Drish" class="img-responsive foot-logo"></a>
                   
					<a href="#" class="copyright">&copy; 2015 drish.  All rights reserved.</a>
                </div>   
            </div><!--end row-->
        </div>     
 <!-- footer end-->
 
   
    <div class="pop-up-wishlist">
        <div class="arrow-up">
			<img src="<?= Yii::$app->params['baseurl'] ?>/images/up-arrow.png">
		</div>
		<div class="pop-up-images">
			<div class="row">
				<?php
				 if(!Yii::$app->user->isGuest){
					$Wishlist = Wishlist::find()->where(['client_id' => \Yii::$app->user->identity->id])->one();
					if($Wishlist){
					$wish_model = unserialize($Wishlist->products);
					if($wish_model){ 
						$i=1;
						foreach($wish_model as $wishlistid){
							$id = $wishlistid;
							$product = Product::findOne($id);
							if($product){ ?>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<?php if($i==1){ ?><p>ITEM</p> <?php } ?>
									<div class='wish_div'>
										<a href="<?= Url::to(["men/product","slug"=>$product->slug ]) ?>" class="item_product_image"> 
										<img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/flip/<?= $product->id ?>/medium/<?= $product->productImages->flip_image; ?>" alt="<?= $product->name ?>" title="<?= $product->name ?>" class="img-responsive">
										</a><h5><a href="<?= Url::to(["men/product","slug"=>$product->slug ]) ?>" class="item_product_image"> <?= $product->name ?></a></h5>
									</div>
								</div>
								<?php if($i==5){ break; } ?>
					<?php 
						$i++;
						}
						} ?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h5 class='wishhead'>
								<a href="<?= Url::to(["account/mywishlist"]) ?>" class="item_product_image"> 
								See All
								</a>
							</h5>
						</div>
			<?php	}
					else{
						echo "No Items";
					}
					}
				} 
				?>
			</div> 
		</div>
        
    </div>
    <div class="pop-up-cart">
        <div class="arrow-up">
			<img src="images/up-arrow.png">
		</div>
		<div class="item">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
					<p>ITEM</p>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
					<p>QTY</p>
				</div> 
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
					<p>PRICE</p>
				</div>
			</div> 
		</div>
        <div class="pop-up-images">
			<div class="row">
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-5"> 
					<a href="#" class="item_product_image"> <img src="images/bag-img-6.jpg" alt="" title="" class="img-responsive"></a><h5>Jersey Bags 100% organic cotton (155 g/m²) - Straight cut</h5>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4"> 
					<div class="input-group spinner">
						<input type="text" class="form-control" value="2">
						<div class="input-group-btn-vertical">
							<button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
							<button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
						</div>
					</div> 
					<div class="cross"><i class="fa fa-times" aria-hidden="true"></i></div>
				</div>
				 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3"> 
					<p>35.00</p>
				 </div>
			</div>
        </div>
         <div class="pop-up-images">
			<div class="row">
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-5"> 
					<a href="#" class="item_product_image"> <img src="images/bag-img-6.jpg" alt="" title="" class="img-responsive"></a><h5>Jersey Bags 100% organic cotton (155 g/m²) - Straight cut</h5>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4"> 
					<div class="input-group spinner">
						<input type="text" class="form-control" value="2">
						<div class="input-group-btn-vertical">
							<button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
							<button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
						</div>
					</div> 
					<div class="cross"><i class="fa fa-times" aria-hidden="true"></i></div>
				</div>
				 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3"> 
					<p>35.00</p>
				 </div>
			</div>
        </div>
            <div class="row">
            	<div class="col-lg-12 center-block">
                <div class="total-chk">
                	<h3><span>Total</span>
                     	3450 <i class="fa fa-inr" aria-hidden="true"></i>
                    </h3>
                    <button type="button" class="btn btn-default">Go to check Out</button>
                </div>
                </div>
            </div>
            
    </div>

 <!-- footer end--> 