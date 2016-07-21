<?php
use common\models\Product;
use yii\helpers\Url;

if($product_ids){
?> 
    <ul class="bxslider-pros">
		<?php
		 foreach($product_ids as $id){
			 $product = Product::findOne($id);
			if($product){
			 ?>
			 <li>
				 <div class="sreen-gallery">
                            <a href="<?= Url::to(['men/product','slug'=>$product->slug]) ?>"><?= $product->name ?>
                            <img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/home/<?= $product->id ?>/main/<?= $product->productImages->home_image ?>" alt="complete-view" title="coplete-view" style="width:250px;height:250px;"></a>

                            <span class="price"><i class="fa fa-inr"></i> <?= $product->price ?></span>
                            <ul class="product-view">

                                <li><a href="<?= Url::to(['men/product','slug'=>$product->slug]) ?>"><img src="<?= Yii::$app->params['baseurl'] ?>/images/icon_list_view_detail_normal_state.png" alt="View" title="Viewt"></a></li>
                                <li><a href="<?= Url::to(['men/product','slug'=>$product->slug]) ?>"><img src="<?= Yii::$app->params['baseurl'] ?>/images/icon_list_view_cart_normal_state.png" alt="cart" title="Cart"></a></li>
                                <li><a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/images/icon_list_view_wishlist_normal_state.png" alt="pinterest" title="pinterest"></a></li>

                            </ul>
					</div>
			</li>
			
		<?php }
		 }
		?>

    </ul>
<?php } ?>