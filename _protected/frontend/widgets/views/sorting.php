<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$js = <<<JS

// get the form id and set the event
$('select').change(function(){
	$('.loading_gif').show();
	var sortform_color = $("#sortform-color").val();
	var csrf = $("input[name='_csrf']").val();
	var sortform_size = $("#sortform-size").val();
	var cat_ids = $("#cat_id").val();
	var sortform_width = $("#sortform-width").val();
	var sortby = $("#sortby").val();
	var brand = $("#brand").val();
	if (sortform_color == '' && sortform_size == '' && sortform_width == '' && sortby == '' && brand == '') {
		return false;
	} else {
		$.post($('#sort_form').attr('action'), {
		color: sortform_color,
		size: sortform_size,
		cat_id: cat_ids,
		_csrf: csrf,
		sortby: sortby,
		brand: brand,
		width: sortform_width
		}, function(data) {
			var obj = $.parseJSON(data);
			$('#product_div').empty();
			$('.loading_gif').hide();
			if(obj.length != 0){
				$.each( obj, function( key, value ) {
						divs = value.div;
							
						$('#product_div').append(divs);
				});
			}else{
				$('#product_div').append("<h3>No Items Found.</h3>");
			}	
				
			
		});
	}

});

JS;
$this->registerJs($js);
?>

<?php $form = ActiveForm::begin([
	'action'=>['finder/product-search'],
	'id'     => 'sort_form',
]); ?>
		<div class="tool-tip">
           <p class="shop-text">Shop By</p>
           <div class="range-slider">
              <div class="range-block">
                 <h6>Price</h6>
                 <h6 class="range-text">Range:</h6>
              </div>
              <div class="range-prize">
                 <div style="position: relative; padding: 200px;">
                    <div>
                       <input type="text" id="range" value="" name="range" />
                    </div>
                 </div>
              </div>
           </div>
        </div>
		<div class="c-s-w">
			<div class="color">
				<?= $form->field($model, 'color')->dropDownList(
					  $model->getAttrValues(1),
					  [
						  'prompt'=>'Color',
						  'class'=>'form-control select2',
						 
					  ]
					)->label(false);
				?>
			</div>
			<div class="color">
				<?= $form->field($model, 'size')->dropDownList(
					  $model->getAttrValues(3),
					  [
						  'prompt'=>'Size',
						  'class'=>'form-control select2',
						
					  ]
					)->label(false);
				?>
			</div>
			<div class="color">
				<?= $form->field($model, 'width')->dropDownList(
					  $model->getAttrValues(2),
					  [
						  'prompt'=>'Width',
						  'class'=>'form-control select2',
						 
					  ]
					)->label(false);
				?>
			</div>
		</div>
		<div class="show-select">
            <div class="color sort c-s">
               <select id="brand">
                  <option>Width</option>
                  <option>Slow</option>
                  <option selected="selected">Shop</option>
                  <option>Fast</option>
                  <option>Faster</option>
               </select>
            </div>
            <div class="color sort sort-by ">
               <select id="sortby">
			    <option value='' selected="selected">Sort By</option>
                  <option value='2'>Low to High</option>
                  <option value='3'>High to Low</option>
               </select>
            </div>
        </div>
 <?php ActiveForm::end(); ?>
<style>
.loading_gif {
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: 99;
    top: 0;
    background-color: rgba(255, 255, 255, 0.4);
    left: 0;
    text-align: center;
    vertical-align: middle;
}
.loading_gif img {
    margin-top: 15%;
}
</style>