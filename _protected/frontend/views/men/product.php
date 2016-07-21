<?php
use frontend\widgets\RelatedProducts;
use common\models\ProductImages;
use frontend\widgets\SpecialProducts;
use frontend\widgets\Reviews;
use frontend\widgets\CartForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\helpers\Url;
//echo"<prE>";print_r($model);die;
$this->registerJs("var product_price = ".json_encode($model->price)."; var varients = ".json_encode($varients).";", View::POS_END);
?>
	<div class="loading_gif" style="display:none;"><img src="<?= Yii::$app->params['baseurl'] ?>/uploads/ajax-loader.gif"></div>
	<section class="product-area-outer">
		<div class="gry-bg">
		   <div class="container-fluid cate-pad">
				<div class="row">
					<div class="col-ld-8 col-md-8 col-sm-12 col-xs-12">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								 <div class="bredcrumb-nav">
									 <ul>
										<li><a href="index.html">Home</a></li>
										<li><a href="<?= Url::to(['finder/category','slug'=>$model->getCategoryname($model->category_id)->slug]) ?>"><?= $model->getCategoryname($model->category_id)->name ?></a></li>
										<li class="active"><a href="#"><?= $model->name ?></a></li>
									 </ul>
								</div>  
							</div>
						</div>
						 <div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="zoom-product">
									<div class="zoom-outer"> 
										<img id="zoom_01" src="<?= Yii::$app->params['baseurl'].'/uploads/product/main/'.$model->id.'/medium/'.$productImages->main_image; ?>" data-zoom-image ="<?= Yii::$app->params['baseurl'].'/uploads/product/main/'.$model->id.'/main/'.$productImages->main_image; ?>" />
									</div>
									<div id="gal1">
									 <?php 
                                       $images = unserialize($productImages->other_image);
                                       foreach($images as $image){
                                           $urllarge = Yii::$app->params['baseurl'].'/uploads/product/other/'.$model->id.'/main/'.$image;
                                           $urlthumb = Yii::$app->params['baseurl'].'/uploads/product/other/'.$model->id.'/medium/'.$image;
                                          ?>
                                           <a href="#" data-image="<?= $urlthumb ?>" data-zoom-image="<?= $urllarge ?>">
												<img id="zoom_01" src="<?= $urlthumb ?>" />
											</a>

                                           <?php
                                       }

                                     ?>
									</div>
								</div>
							</div>
						</div>
					</div>
                <!-- end of slider thumbnail-->
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 bown-bg">
					<div class="supper-soft">
						<h3><?= $model->name ?></h3>
						<h4 class="red-color">
							<i class="fa fa-inr"></i><?= $model->price ?>
						</h4>
						<div class="border-gry">
							<p> <?= html_entity_decode($model->descr) ?></p>
						</div>
						<div class="rating">
							<span>Rating : <?=  $rating->rating?></span>
							 <ul>
								<?php 
								for($i=1;$i<=$rating->rating;$i++){
								 echo '<li><i class="fa fa-star"></i></li>';
								}
								$count = 5-$rating->rating;
								for($i=1;$i<=$count;$i++){
								 echo '<li><i class="fa fa-star-o"></i></li>';
								}
								?>
                            </ul>
						</div>
						
						 <?= CartForm::widget(['model'=>$model,'varientModel'=>$varientModel,'cart'=>$cart,'wishlist'=>$wishlist]) ?>
						
						</div>
					</div>
				</div>
            
    <div class="container-fluid cate-pad">
        <div class="prdoct-area">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="review-nav nav nav-tabs">
                        <ul>
                            <li class="active"><a href="#home" data-toggle="tab" aria-expanded="false">Product Details </a></li>
                            <li><a href="#menu1" data-toggle="tab" aria-expanded="true">Reviews (0)</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="home">
                            <div class="p-detail">
                            <?php
                            foreach($productDescValues as $descvalue){

                                echo'<p>'.$descvalue->attr->display_name.':</p><p>'.strip_tags($descvalue->value,"<b>").'</p>';
                            }
                            foreach($productTextValues as $textvalue){
                                echo'<p>'.$textvalue->attr->display_name.':</p><p>'.strip_tags($textvalue->value,"<b>").'</p>';
                            }
                            foreach($productDropdownValues as $dropvalue){
                                $getvalue = $dropdownValues->findOne($dropvalue->value_id);
                                echo'<p>'.$getvalue->attr->display_name.':</p><p>'.strip_tags($getvalue->name,"<b>").'</p>';
                            }
                            ?>


                                </div>
                        </div>

                        <div class="tab-pane fade" id="menu1">
						<?php  if (!Yii::$app->user->isGuest) { ?>
						   <?= Reviews::widget(['product_id' => $model->id]) ?>
						<?php } else{
							echo'<h3>Please Login For Write Review !</h3>';
						} ?>
						  </div>

                    </div>
                </div>
                <!-- end of review-->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="complete-look">
                        <h4>Complete Your Look</h4>
                         <?= SpecialProducts::widget(['product_id' => $model->id]) ?>
                    </div>

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <hr class="border-line">
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= RelatedProducts::widget(['product_id' => $model->id]) ?>
              
            </div>


        </div>

			</div>
		</div>
</section>  
<div class="size-popup">
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"> Women Beige Heels (Beige)  (Women, Default) </h4>
				</div>
				<div class="modal-body">
					<div id="tabs">
						<ul>
							<li>
								<a href="#tabs-1">Size Options</a>
							</li>
							<li>
								<a href="#tabs-2">Measurement Guides</a>
							</li>
						</ul>
						<div class="size-tabs">
							<div id="tabs-1">
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr class="title">
												<td>UK/India</td>
												<td>Euro</td>
												<td>US</td>
											</tr>
											<tr>
												<td>2</td>
												<td>35</td>
												<td>2.5</td>
											</tr>
											<tr>
												<td>3</td>
												<td>36</td>
												<td>3.5</td>
											</tr>
											<tr>
												<td>4</td>
												<td>37</td>
												<td>4.5</td>
											</tr>
											<tr>
												<td>5</td>
												<td>38</td>
												<td>5.5</td>
											</tr>
											<tr>
												<td>6</td>
												<td>39</td>
												<td>6.5</td>
											</tr>
											<tr>
												<td>7</td>
												<td>40</td>
												<td>7.5</td>
											</tr>
											<tr>
												<td>8</td>
												<td>41</td>
												<td>8.5</td>
											</tr>
											<tr>
												<td>9</td>
												<td>42</td>
												<td>9.5</td>
											</tr>
											<tr>
												<td>10</td>
												<td>43</td>
												<td>10.5</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div id="tabs-2">
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr>
												<td class="padding5">
													<strong>FOOT LENGTH</strong>
												</td>
												<td class="padding5">Measure your foot length by placing a ruler flat on the floor straight alongside the inside of your foot from your heal to your toes.  Place an object with a flat edge straight across your toes with the edge touching the tip of your longest toe. Take the measurement (in millimeters) from the ruler where the flat edge crosses. This is your foot length measurement.</td>
											</tr>
											<tr>
												<td class="padding5">
													<strong>SELECTING A SHOE SIZE</strong>
												</td>
												<td class="padding5">If your foot measurement is halfway between sizes, select the larger size.  You may find one foot is longer than the other, this is quite normal, please use the larger size when making your shoe size selection.</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="tab-imges">
							<img src="<?= Yii::$app->params['baseurl']?>/images/product-images/sandal-8ec9e675.jpg" alt="" title="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>