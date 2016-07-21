<?php
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\ProductImages;
use yii\helpers\Url;

$url = Url::to(['cart/images']);
$js = <<<JS

$('div.r:first').addClass('active');
color_ids = $('div.r:first').attr('id');
$('#cart-color').val(color_ids);
$('div.r').click(function(){
	$('div.r').removeClass('active');
	$(this).addClass('active');
	$('.loading_gif').show();
	var prod_id = $(this).attr('prod_id');
	var csrf = $('input[name=_csrf]').val();
	var color_id = $(this).attr('id');
	$('#cart-color').val(color_id);
	$.ajax({
		url: '$url',
		type: 'post',
		data: {'color_id':color_id,'product_id':prod_id,'_csrf':csrf},
		success: function (response) {
			$('.zoom-product').empty();
			$('.zoom-product').html(response);
			$('.loading_gif').hide();
			$("#zoom_01").elevateZoom({
			gallery:'gal1', 
			cursor: 'pointer',
			position:"absolute",
			top:"0",
			right:"0",
			 galleryActiveClass: 'active', 
			 imageCrossfade: true,
			 loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
			 }); 
			
			//pass the images to Fancybox
			$("#zoom_01").bind("click", function(e) {  
			  var ez =   $('#zoom_01').data('elevateZoom');	
				$.fancybox(ez.getGalleryList());
			  return false;
			});
		}
	});

});

// get the form id and set the event
$('form#{$cart->formName()}').on('beforeSubmit', function(e) {
	var form = $(this);
	if (form.find('.has-error').length) {
	  return false;
	}
	// submit form
	$.ajax({
		url: form.attr('action'),
		type: 'post',
		data: form.serialize(),
		success: function (response) {
			if(response.type == 'success'){
				$(".flash span").html(response.message);
				$(".flash").fadeIn(100);
				setTimeout(function(){
				$(".flash").fadeOut();
				},3000);
				setTimeout(function(){
					$(".flash span").html("");
				},4000);

				$('.cart-count').html(response.count);
				$('form#{$cart->formName()}').trigger('reset');
				$('.form-success').html(response.message);
			}else{
				$.each( response, function( key, value ) {
					$('#'+key).parent().removeClass('has-success').addClass('has-error');
					$('#'+key).parent().find('.help-block').html(value);
				});
			}
		}
	});
	return false;
}).on('submit', function(e){
    e.preventDefault();
});
JS;

$this->registerJs($js);


$baseurl = Yii::$app->params['baseurl'];
?>

<?php $form = ActiveForm::begin([
	'action'=> $baseurl.'/cart/add',
	'id'     => $cart->formName(),
	'enableAjaxValidation'   => false,
]); ?>
<?= $form->field($cart, 'varient_id')->hiddenInput()->label(false) ?>
<?= $form->field($cart, 'product_id')->hiddenInput()->label(false) ?>
<?= $form->field($cart, 'color')->hiddenInput()->label(false) ?>
	<div class="quantity">
			<div class="color-code">
				<p>More Colours:</p>
				<ul>
				<?php $colors = ProductImages::find()->where([ 'product_id' => $model->id ])->all();
					if($colors){
						foreach($colors as $color){ ?>
						<li>
							<a href="javascript:void(0);">
								<div class="r" id="<?= $color->color; ?>" prod_id="<?= $model->id; ?>" style='background-color:<?= $color->getColorName($color->color); ?>'></div>
							</a>
						</li>
				  <?php }
					}
				?>
				</ul>
			</div>
			<div class="enter-pincode">
				<p>
					<i class="fa fa-map-marker" aria-hidden="true"></i>
					Check Availability at
				</p>
				<div class="pincode-field">
					<input type="text" placeholder="enter your pincode">
						<button>Check</button>
				</div>
			</div>
		<div class="select-size">
			<div class="color">

				<?= $form->field($cart, 'size')->dropDownList(
					$varientModel->getAvailattr($model->id,'size'),
					[
						'prompt'=>'Select Size',
						'class'=>'form-control select2 required updateprice',
					]
				)->label(false);
				?>
			</div>
			<div class="color">
				<?= $form->field($cart, 'width')->dropDownList(
					array(),
					[
						'prompt'=>'Select Width',
						'class'=>'form-control select2 required updateprice',
					]
				)->label(false);
				?>
			</div>
		</div>

		<div class="select-size">
			<div class="color">
				<?= $form->field($cart, 'quantity')->dropDownList(
					array(),
					[
						'prompt'=>'Select Quantity',
						'class'=>'form-control select2 required',
					]
				)->label(false);
				?>
			</div>

		</div>

		<div class="select-size">
			<div class="color">
				<p>Size and Width guide <span class="foot-scale"> <img title="foot-scale" alt="foot-scale" src="<?= Yii::$app->params['baseurl'] ?>/images/foot-scale.png"></span></p>
			</div>

			<div class="color">
				<input type="text" placeholder="Enter Zip Code">
			</div>
		</div>
	</div>

	<div class="add-to-cart">
		<a>
			<?= Html::submitButton('<span><img title="cart-add" alt="cart-add" src="'.$baseurl.'/images/cart-add.png"></span> Add to Cart', ['class' => 'btn btn-default', 'name' => 'register-button']) ?>
		</a>

	</div>

	<div class="wish-list">
		<p id='add_wishlist' class="addToWishlist wishlist" data-id= '<?= $model->id ?>' data-is-enabled="<?= $wishlist->getInwishlist($model->id) ?>"><span class="wish-img" ><img title="wish-list" alt="wish-list" src="<?= Yii::$app->params['baseurl'] ?>/images/add-wishlist.png"></span><?= $wishlist->getInwishlist($model->id)=="true"?"Add to Wishlist":"Remove from Wishlist"; ?></p>
		<p class="avail">Availability:<span class="green-color">In stock</span></p>

	</div>
<?php ActiveForm::end(); ?>
<div class="share-with">
	<p> Share with:</p>
	<div class="foot-socials">
		<ul>
			<li>
				<a href="http://www.facebook.com/sharer.php?url=<?= Yii::$app->homeUrl ?>products/<?= $model->slug ?>.html" target="_blank">
					<i class="fa fa-facebook" aria-hidden="true"></i>
				</a>
			</li>
			<li>  
				<a href="https://twitter.com/share?url=<?= Yii::$app->homeUrl ?>products/<?= $model->slug ?>.html&amp;text=<?= $model->name ?>&amp;hashtags=<?= $model->slug ?>" target="_blank">
					<i class="fa fa-twitter" aria-hidden="true"></i>
				</a>
			</li>
			<li>  
				<a href="https://plus.google.com/share?url=<?= Yii::$app->homeUrl ?>products/<?= $model->slug ?>.html" target="_blank">
					<i class="fa fa-google-plus" aria-hidden="true"></i>
				</a>
			</li>
			<li> 
				<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?= Yii::$app->homeUrl ?>products/<?= $model->slug ?>.html" target="_blank">
					<i class="fa fa-linkedin" aria-hidden="true"></i>
				</a>
			</li>
		</ul>
	</div>
	<!--end foot-social-->
</div>
<div class="shoes-consultants">
	<p>Call your Shoes Consultant</p>
	<button>
		<i class="fa fa-phone" aria-hidden="true"></i>
	</button>
	<a href="tel:1800 18000 00000">1800 18000 00000</a>
</div>
<style>
.color-code .active {
    border: 5px solid red;
}
.loading_gif img{
margin-left: 48%;
    margin-top: 20%;
}
.loading_gif {
    width: 100%;
    background-color: rgba(0,0,0,0.5);
    height: 100%;
    z-index: 999999;
    position: fixed;
    left: 0;
    top: 0;
}
</style>