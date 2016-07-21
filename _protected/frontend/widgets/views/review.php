<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$js = <<<JS

// get the form id and set the event

$('form#{$model->formName()}').on('beforeSubmit', function(e) {

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

			if(response == 'success'){

				$('form#{$model->formName()}').trigger('reset');

				$('.form-success').html('<h5>Your Review has been successfully submitted ! </h5>');

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
if($data){
	echo'<h4> Review has been already submitted by you for this Product !</h4>';
}else{
?>
<div class="review-form">
	<?php $form = ActiveForm::begin([
		'action'=>['account/review'],
		'id'     => $model->formName(),
		'enableAjaxValidation' => false,
	]);
	 $list = [1 => '1 Star', 2 => '2 Star', 3 => '3 Star', 4 => '4 Star', 5 => '5 Star'];
	 $model->product_id = $product_id;
	 $model->user_id =\Yii::$app->user->identity->id;
	?>
	<?= $form->field($model, 'product_id')->hiddenInput()->label(false); ?>
	<?= $form->field($model, 'user_id')->hiddenInput()->label(false); ?>
	
		
			<h4>You're reviewing: <span>Casual Suede Toddler Sneakers</span></h4>
			<h6>How do you rate this product? <em class="required">*</em></h6>
			<table class="data-table col-md-12 table table-striped" id="product-review-table">
			<tbody>
				<tr class="first last odd">
					<th data-title=" star">Quality</th>
					
			<?=
                    $form->field($model, 'rating')
                        ->radioList(
                            [1 => '1 Star', 2 => '2 Star', 3 => '3 Star', 4 => '4 Star', 5 => '5 Star'],
                            [
                                'item' => function($index, $label, $name, $checked, $value) {

                                    $return = '<td class="value">';
                                    $return .= '<input type="radio" class="radio" name="' . $name . '" value="' . $value . '" tabindex="3">'. $label;
                                    $return .= '</td>';
                                    return $return;
                                }
                            ]
                        )
                    ->label(false);
                    ?>
					<div class="help-block"></div>
				</tr>
			</tbody>
		</table>
		<ul class="form-list">
		<li>
			<label for="summary_field" class="required"><em>*</em>Nickname</label>
			<div class="input-box form-group">
				<?= $form->field($model, 'name')->textInput(['class' => 'required-entry form-control'])->label(false); ?>
			</div>
		</li>
		<li>
			<label for="summary_field" class="required"><em>*</em>Summary of Your Review</label>
			<div class="input-box form-group">
				<?= $form->field($model, 'summary')->textInput(['class' => 'required-entry form-control'])->label(false); ?>
			</div>
		</li>
		<li>
			<label for="summary_field" class="required"><em>*</em>Review</label>
			<div class="input-box form-group">
				<?= $form->field($model, 'review')->textArea(['rows'=>6,'class' => 'required-entry form-control'])->label(false); ?>
			</div>
		</li>
	</ul>
	<div class="buttons-set">
        <button type="submit" title="Submit Review" class="button btn btn-kids">
			<span><span>Submit Review</span></span>
		</button>
    </div>
	<div class="form-success has-success"></div>
	<?php ActiveForm::end(); ?>
</div>
<?php } ?>