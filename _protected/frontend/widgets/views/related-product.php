<?php
use common\models\Product;
use yii\helpers\Url;

if($product_ids){
?> 
<h3>Related product</h3>
<div class="slider-product">
    <ul class="bxslider-pro">
		<?php
		 foreach($product_ids as $id){
			 $product = Product::findOne($id);

			 if(!$product)
				 continue;
			 ?>
			 <li>
				<span class="related-product">
						<a href="<?= Url::to(['men/product','slug'=>$product->slug]) ?>">
						<img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/home/<?= $product->id ?>/main/<?= $product->productImages->home_image ?>">
						  <h4><?= $product->name ?></h4>
						<h4><span><i class="fa fa-inr"></i></span><?= $product->price ?></h4></a>
				 </span>
			</li>
			
		<?php }
		?>

    </ul>
</div>
<?php } ?>