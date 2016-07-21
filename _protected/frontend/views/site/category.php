<?php 
use yii\helpers\Url;
use frontend\widgets\Sorting;
?>
<div class="loading_gif" style="display:none;"><img src="<?= Yii::$app->params['baseurl'] ?>/uploads/ajax-loader.gif"></div>
<section class="caterogy-area-outer">
   <div class="container-fluid cate-pad">
	<?php  if($category){
			echo'<input type="hidden" name="cat_id" id="cat_id" value="'.$category->id.'">';
		$categorys = $category->find()->where(['id'=>$category->id, 'active' =>1])->one();
			$parents = $categorys->parents()->all();
				$sub_children = $categorys->children(1)->all();
					if($sub_children){
					?>
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="cate-nav">
               <ul>
			   <?php 
				    
						if($parents){ 
						foreach($sub_children as $category){
							if(count($parents) == 2){ 
								?><li> <a href="<?= Url::to(['finder/category','slug'=>$category->slug ,'submain'=>$categorys->slug ,'main'=>$parents[1]->slug ]) ?>"><?= $category->name ?></a></li><?php
							}else if(count($parents) == 1){ 
								?><li> <a href="<?= Url::to(['finder/category','slug'=>$category->slug ,'submain'=>$categorys->slug ,'main'=>$parents[0]->slug ]) ?>"><?= $category->name ?></a></li><?php
							}else{  
								?><li> <a href="<?= Url::to(['finder/category','slug'=>$category->slug,'main'=>$categorys->slug]) ?>"><?= $category->name ?></a></li><?php
							}
							?>
						
						<?php
						}
						} else{
							foreach($sub_children as $category){?>
							<li> <a href="<?= Url::to(['finder/category','slug'=>$category->slug,'main'=>$categorys->slug]) ?>"><?= $category->name ?></a></li>
							<?php
							}
						}
				?>
               </ul>
            </div>
         </div>
      </div>
		<?php }
		} ?>
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1><?= $categorys->name ?></h1>
            <div class="bredcrumb-nav">
               <ul>
                  <li><a href="<?= Yii::$app->homeUrl ?>">Home</a></li>
                  <li><a href="<?= Url::to(['site/category','slug'=>$slug]) ?>"><?= $categorys->name ?></a></li>
               </ul>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <a href="#" class="item-numer"><?php if($products) { echo count($products[0]); }else { echo "0"; } ?></a>
         </div>
      </div>
      <!-- end of 55 items-->
      <div class="shop-by">
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="product-list">
                  <?= Sorting::widget() ?> 
               </div>
            </div>
         </div>
      </div>
      <!-- end of range slider-->   
      <div class="row" id="product_div">
		<?php 
			$i =1; 
			if($products){
			foreach($products as $product1){
				foreach($product1 as $product){
					if($i==6){ ?>
						<div class="col-lg-6 col-sm-8 col-md-8 col-xs-12 braided-flip cat-img">
							<a href="product.html">
							   <div class="braided-main cat-height">
								  <div class="braided-img">
									 <ul class="braided-heart">
										<li>
										   <svg enable-background="new 0 0 128 128" id="Layer_1" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
											  <circle cx="89" cy="101" fill="none" r="8" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
											  <circle cx="49" cy="101" fill="none" r="8" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
											  <path d="  M29,33h83.0800705c2.8071136,0,4.7410736,2.8159065,3.7333832,5.4359169L99.8765564,79.8718338  C98.6882782,82.9613724,95.7199707,85,92.4097977,85H45.6081238c-3.8357391,0-7.1316795-2.722496-7.8560524-6.4892197L29,33z" fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
											  <path d="  M28.9455147,33.0107765l-1.5162468-7.5799599C26.6812878,21.6915436,23.3980236,19,19.5846729,19h-7.2409086" fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
											  <line fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4" x1="89.9039841" x2="92.9041901" y1="45" y2="45"/>
											  <line fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4" x1="32" x2="80.9041901" y1="45" y2="45"/>
										   </svg>
										</li>
										<li><i class="fa fa-heart-o"></i></li>
									 </ul>
									 <img src="<?= Yii::$app->params['baseurl'] ?>/uploads/category/<?= $category->id ?>/banner/large/<?= $categorys->catBanner->banner ?>" class="img-responsive cat-product" alt="category shoes" title="category shoes">
								  </div>
							   </div>
							</a>
						</div>
			<?php	}else{ ?>
			<div class="col-lg-3 col-sm-4 col-md-4 col-xs-12 braided-flip">
            <a href="<?= Url::to(["men/product","slug"=>$product->slug ]) ?>">
               <div class="braided-main">
                  <div class="braided-img">
                     <ul class="braided-heart">
                        <li>
                           <svg enable-background="new 0 0 128 128" id="Layer_1" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                              <circle cx="89" cy="101" fill="none" r="8" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
                              <circle cx="49" cy="101" fill="none" r="8" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
                              <path d="  M29,33h83.0800705c2.8071136,0,4.7410736,2.8159065,3.7333832,5.4359169L99.8765564,79.8718338  C98.6882782,82.9613724,95.7199707,85,92.4097977,85H45.6081238c-3.8357391,0-7.1316795-2.722496-7.8560524-6.4892197L29,33z" fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
                              <path d="  M28.9455147,33.0107765l-1.5162468-7.5799599C26.6812878,21.6915436,23.3980236,19,19.5846729,19h-7.2409086" fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
                              <line fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4" x1="89.9039841" x2="92.9041901" y1="45" y2="45"/>
                              <line fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4" x1="32" x2="80.9041901" y1="45" y2="45"/>
                           </svg>
                        </li>
                        <li><i class="fa fa-heart-o"></i></li>
                     </ul>
                     <div class="card effect__hover">
                        <div class="card__front">
                           <span class="card__text"><img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/main/<?= $product->id ?>/custom2/<?= $product->productImages->main_image; ?>" class="img-responsive" alt="shoes" title="shoes"></span>
                        </div>
                        <div class="card__back">
                           <span class="card__text"><img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/flip/<?= $product->id ?>/custom2/<?= $product->productImages->flip_image; ?>" class="img-responsive" alt="shoes-1" title="shoes"></span>
                        </div>
                     </div>  
                     <!-- /card -->	
                  </div>
                  <div class="braided-text">
                     <p><?= $product->name ?></p>
                     <p class="red-color"> <i class="fa fa-inr"></i><?= $product->price ?></p>
                  </div>
               </div>
            </a>
         </div>
		<?php      }
				$i++;
				}
			}
		}else{
			Echo"There Has No Items";
		}
		?>
		
        </div>
      <!-- end of shoes category--> 
      <div class="shop-by select-foter">
         <div class="row">
            <div class="col-lg-5 col-md-7 col-sm-7 col-xs-12">
               <!--div class="f-c-s">
                  <div class="color f-color">
                     <select id="selectmenu-4">
                        <option>Show</option>
                        <option>Slow</option>
                        <option selected="selected">Show</option>
                        <option>Fast</option>
                        <option>Faster</option>
                     </select>
                  </div>
                  <div class="color">
                     <select id="selectmenu-5">
                        <option>Sort By</option>
                        <option>Slow</option>
                        <option selected="selected">Sort By</option>
                        <option>Fast</option>
                        <option>Faster</option>
                     </select>
                  </div>
               </div-->
            </div>
            <div class="col-lg-7 col-md-5 col-sm-5 col-xs-12">
               <ul class="pagination categ-page">
                  <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#" class="red-color">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- design slider start-->
<a id="back-to-top" href="#" class="back-to-top" role="button" title="Back to Top" data-toggle="tooltip" data-placement="top">
	<span class="glyphicon glyphicon-chevron-up"></span>
</a>
<!-- design slider end-->
