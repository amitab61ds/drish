
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\models\Product;
$user_id = \Yii::$app->user->identity->id;
$model = unserialize($wishlist->products);
?>
<?php $this->title =  ' My WishList'; ?>	

 <!-- end of left part of account list-->
<!-- account dashboard -->
<section class="dashboard-user">
   <div class="container-fluid craftsmanship-area">
	 <div class="user-dashboard">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
           	<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="dashboard-list">
						<h4>Account</h4>
						<ul class="acc-dash">
							<li><a href="<?= Url::to(['account/index']) ?>" >Account Dashboard</a></li>
							<li><a href="<?= Url::to(['account/orders']) ?>" >Orders Detail</a></li>
							<li><a href="<?= Url::to(['account/mywishlist']) ?>" class='active'>My Wishlist</a></li>
						</ul>
					</div>
				</div>
            </div>
        </div>
		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
			<div class="wishlist-account">
				<table class="table table-bordered">
					<thead>
					  <tr>
						<th></th>
						<th>Product Details and Comment</th>
						<th class="hide-cross">Detail</th>
						<th></th>
					  </tr>
					</thead>
					<tbody>
					<?php if($model){ 
						$i=0;
						foreach($model as $wishlistid){
							$id = $wishlistid;
							$product = Product::findOne($id);
							if($product){ 	
							?>
							<!-- end of left part of account list-->
								 
										  <tr>
											<td><div class="wish-img"><img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/flip/<?= $product->id ?>/custom2/<?= $product->productImages->flip_image; ?>" alt="wishlist-shoe" title="wishlist-shoe"></div></td>
											<td><h4><?= $product->name ?> </h4>    
											<p><?= $product->descr ?></p>
											</td>
											<td>
											<div class="wishlist-price"><p><?= $product->price ?> Rs <span class="view-cross">
											<a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></span></p> 
											<p><input type="text" placeholder="1"></p>
											<a href='<?= Url::to(["men/product","slug"=>$product->slug ]) ?>' > <button type="button" class="btn btn-default">Detail</button></a>
											</div>
											</td>
											<td class="hide-cross"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
										  </tr>
										  
									
								<?php 	
							$i++;
							}
						}
					}
					else{ ?>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<h4> No Products added by you.</h4>
							</div>		
						</div>
				   <?php } ?>
					</tbody>
				</table>
			</div> 
		</div>
        <!-- end of right part of account detail-->
    </div>
</div>
   </div>
 </section>
        <!-- end of right part of account detail-->