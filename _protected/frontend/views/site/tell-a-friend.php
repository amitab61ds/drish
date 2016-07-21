<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->registerJs("

	$('#add_friend').click(function(){
		email_val = $('.email_div').html();
		$('.to_div').append(email_val);
		
	});
	$('#remove_friend').click(function(){
		if($( '.field-friendform-to_email').length > 1){
			$('.field-friendform-to_email ').last().remove();
		}
			
	});
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
");

?>


<div class="site-contact">

    <div class="col-lg-3">
	</div>
    <div class="col-lg-6 well bs-component">

      <?php $form = ActiveForm::begin([
		'action'=>['site/tell-a-friend'],
		'id'     => $model->formName(),
		'enableAjaxValidation'   => false,
		]); ?>

            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'email') ?>
			<div class='to_div'>
				<div class="email_div">
					<?= $form->field($model, 'to_email[]') ?>
				</div>
			</div>
			<div class="form-group">
				<span id="add_friend">Add Friend</span>
				<span id="remove_friend">Remove Friend</span>
			</div>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
