<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

?>
<div class="container-fluid craftsmanship-area">
	<div class="bredcrumb-nav">
		<ul>
			<li><a href="<?= Yii::$app->params['baseurl'] ?>/">Home</a></li>
			<li class="active"><a href="#">Testimonial</a></li>
		</ul>
	</div>            
</div>  
<!-- testimonils area -->
<div class="container-fluid craftsmanship-area">
	<div class="testimoial-area">
    	<div class="container">
			<h3>our clients  like us to</h3>
			<div class="content">
				<div class="demo">
					<div class="scrollbar-macosx">
						<div class="client-area"> 
						<?php if($model){ 
							$i=1;
							foreach($model as $test){
								if($test->feat_image){
									$img =  Yii::$app->params['baseurl'].'/uploads/testimonial/medium/'.$test->feat_image;
								}else{
									$img =  Yii::$app->params['baseurl'].'/images/testimonial-left-arrow.png';
								}
								?>
								<div class="clients">
									<div class="clients-img testimonial-pic <?php if($i%2 == 0 ){ echo 'client-img-right'; } ?>">
										<img src="<?= $img ?>" alt="user-img" title="user-img" class="img-rsponsive">
									</div>
									<div class="client-quote">
										<div class="clients-say">
											<div class="testimonial-<?php if($i%2 == 0 ){ echo 'right'; }else{ echo'left'; } ?>-arrow">
												<img src="<?= Yii::$app->params['baseurl'] ?>/images/testimonial-<?php if($i%2 == 0 ){ echo 'right'; }else{ echo'left'; } ?>-arrow.png" alt="testimonial-left-arrow" title="testimonial-left-arrow">
											</div>
											<article> 
												<i class="fa fa-quote-left" aria-hidden="true"></i>
													<?= $test->descr ?>
												<i class="fa fa-quote-right" aria-hidden="true"></i>
											</article>
										</div>
										<p><?= $test->name ?></p>
									</div>
								</div> 							 
							<?php
							$i++;
							}
						} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>