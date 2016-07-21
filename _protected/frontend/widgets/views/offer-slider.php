<?php
use common\models\Product;
use yii\helpers\Url;
if($slides){
?> 
 <div data-ride="carousel" class="carousel slide" id="myCarousel-shoes">
    <!-- Indicators -->
     <ol class="carousel-indicators carousel-indicators-2">
		 <?php $i=0;
		  foreach($slides as $slide){  ?>
			  <li class="<?php if($i==0){ echo 'active'; }?>" data-slide-to="<?= $i ?>" data-target="#myCarousel-shoes"></li>
		<?php  $i++;  }					 
		 ?>
     </ol>
    <!-- Wrapper for slides -->
        <div role="listbox" class="carousel-inner">
		 <?php $j=1;
		 foreach($slides as $slide){  
		 ?>
            <div class="item <?php if($j==1){ echo 'active'; }?>">
				<img class="img-responsive"  src="<?= Yii::$app->params['baseurl']."/uploads/slides/main/".$slide->image_path ?>" alt="<?= $slide->alt_title ?>" title="<?= $slide->name ?>">
				<div class="carousel-caption">
					<div class="price-frame">
						<h4><?= $slide->name ?></h4>
						<p class="price-txt"><?= $slide->content ?></p>
						<a href="<?= $slide->button_link ?>">
						<input type="button" class="shop-now-btn" value="Shop Now &gt;">
					</a>
					</div>
				  <!--end price-frame-->
			   </div>
            </div>
		<?php $j++;	
			}
		?>
        </div>
	 <!-- Left and right controls -->
		<a data-slide="prev" role="button" href="#myCarousel-shoes" class="left carousel-control">
		<span aria-hidden="true" class="slide-arrow-left-2"><img alt="arrow" src="images/left-arrow.jpg"></span>
		<span class="sr-only">Previous</span>
		</a>
		<a data-slide="next" role="button" href="#myCarousel-shoes" class="right carousel-control live">
		<span aria-hidden="true" class="slide-arrow-right-2"><img alt="arrow" src="images/right-arrow.jpg"></span>
		<span class="sr-only">Next</span>
		</a>
	</div>
<?php } ?>