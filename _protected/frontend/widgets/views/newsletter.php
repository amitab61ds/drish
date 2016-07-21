<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

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
			if(response == 'success'){
				$('#success').show();
				$('#newsletter-email').val('');
				$('#success').delay(5000).fadeOut(400);
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

 <div class="news-section">
	<?php $form = ActiveForm::begin([
		'id' => $model->formName(),
		'action' => ['account/newsletter'],
		'enableAjaxValidation' => false,		
	]); ?>
	 <h1>Newsletter<br>
        <span>For new offers, fashion updates, sales.</span>
     </h1>
	
		<?= $form->field($model, 'email',[	'inputOptions' => [	'placeholder' => 'Enter Email Address']])->label(false) ?> 
		<?= Html::submitButton('Sign Up', ['id' => 'news_letter']) ?>
	
		<div id="success" style="display:none;color: #088708;font-size: 25px;">You have subscribed Successfully.</div></br>
		<!--a href="#">See the December Issue ></a--> 

	<?php ActiveForm::end(); ?>				
</div>
