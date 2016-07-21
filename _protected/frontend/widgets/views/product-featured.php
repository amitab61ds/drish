<?php
use common\models\Product;
use yii\helpers\Url;
if($product_ids){
	if($type == "kids"){ ?>
		<ul class="bxslider-2">
		
	<?php	foreach($product_ids as $product){
		
				if($product->getProductHomeImages($product->id) != ""){
					$imgarray = $product->getProductHomeImages($product->id);
					$img = $imgarray->home_image;
				}else{
					$img = $product->productImages->home_image;
				}
		 ?>	
				<li>
                    <a href="<?= Url::to(['men/product','slug'=>$product->slug]) ?>">
                    	<img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/home/<?= $product->id ?>/main/<?= $img ?>" alt="<?= $product->name ?>" title="<?= $product->name ?>">
                    </a>
                </li>
		<?php	
			}
		?>
		</ul>
<?php
	} else {
?>                        
<ul class="bxslider-1 grid cs-style-2">
		<?php
		 foreach($product_ids as $product){ 
			if($product->getProductHomeImages($product->id) != ""){
				$imgarray = $product->getProductHomeImages($product->id);
				$img = $imgarray->home_image;
			}else{
				$img = $product->productImages->home_image;
			}
		 
		 ?>
			 <li>
                    <a href="<?= Url::to(['men/product','slug'=>$product->slug]) ?>">
                        <figure>
                            <img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/home/<?= $product->id ?>/main/<?= $img ?>" class="img-responsive" alt="bag-1" title="bag-1">
                            <figcaption>
                           <span><?= $product->name ?><br><i class="fa fa-inr"></i><?= $product->price ?></span>
                                <button type="button">Shop Now</button>
                            </figcaption>
                        </figure>
                    </a>
                      
            </li>
		<?php	
			}
		?>
</ul>
<?php }

} ?>