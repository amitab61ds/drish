<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
			if(response.type == 'success'){	
				$('form#{$model->formName()}').trigger('reset');			
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


?>
<div class="col-md-2">
	<span>Forget<br><span class="reg-scolarship">Password</span></span>
</div>
<?php $form = ActiveForm::begin([
	'id'     => $model->formName(),
	'action'   => '/user/recovery/request',
	'enableAjaxValidation'   => false,
]); ?>

<div class="form-group col-md-5">
	<?= $form->field($model, 'email')->textInput(['class' => 'form-control','placeholder' => 'Email'])->label(false) ?>
</div>

<div class="form-group col-md-5">
	<?= Html::submitButton('Continue', ['class' => 'btn btn-default', 'name' => 'reset-button']) ?>
</div>

<?php ActiveForm::end(); ?>  
<div class="form-success"></div>