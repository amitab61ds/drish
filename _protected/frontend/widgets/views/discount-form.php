<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


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
			obj = jQuery.parseJSON( response );
			if(response.type == 'success'){
				$('form#{$model->formName()}').trigger('reset');
				$('.form-success').html(response.msg);
				$('.form-error').html("");

			}else{
				obj = jQuery.parseJSON( response );
				$('form#{$model->formName()}').trigger('reset');
				$('.form-error').html(obj.msg);
				$('.form-success').html("");
			}
		}
	});
	return false;
}).on('submit', function(e){
    e.preventDefault();
});
JS;

$this->registerJs($js);

?>

<?php $form = ActiveForm::begin([
    'action'=> ['cart/discount'],
    'id'     => $model->formName(),
    'enableAjaxValidation'   => false,
]); ?>
    <span> Discounts</span>
    <?= $form->field($model, 'code',[	'template' => '{input}{error}','inputOptions' => [	'class'=>'','placeholder' => 'Enter your coupon code if you have one.']])->label(false) ?>
    <?= Html::submitButton('Apply Coupon', ['id' => 'apply_discount']) ?>

	<div class="form-success"><?= $msg ?></div>
	<div class="form-error"></div>
<?php ActiveForm::end(); ?>