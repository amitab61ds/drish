<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$baseurl = Yii::$app->params['baseurl'];



$js = <<<JS
// get the form id and set the event
$('form#{$billingModel->formName()}').on('beforeSubmit', function(e) {
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

					   $(".address li.step1 span").removeClass("close").addClass("open");
					   $(".address li.step2 span").removeClass("close").addClass("open");
					   $(".address li.step1 span").next().slideUp();
					   $(".address li.step1 span i").removeClass("fa-minus").addClass("fa-plus");

					    $(".address li.step2 span").next().slideDown();
                        $("i",".address li.step2 span").addClass("fa-minus").removeClass("fa-plus");
					   $(".address li span").removeClass("active");
					   $(".address li.step2 span").addClass("active");

			}else{
			    $('.errors-block').empty();
				$.each( response, function( key, value ) {
				    if($('#'+key).length){
					    $('#'+key).parent().removeClass('has-success').addClass('has-error');
					    $('#'+key).parent().find('.help-block').html(value);
					}else{
                        if(key != 'username'){
					        $('.errors-block').append('<p class="help-block help-block-error">'+value+'</p>');
					    }
					}
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
    <?php $form = ActiveForm::begin([
        'action'=> ['cart/address'],
        'id'     => $billingModel->formName(),
        'enableAjaxValidation'   => false,
        'options' => [
            'class' => 'form-fill'
        ],
    ]); ?>

    <div class="user-form">
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">First Name*</label>
                <?= $form->field($billingModel, 'fname',[
                    'inputOptions' => [
                        'class'=>'form-control',
                    ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Last Name*</label>
                <?= $form->field($billingModel, 'lname',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <!-- end of first& last name-->
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Street address 1*</label>
                <?= $form->field($billingModel, 'address',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Street address 2</label>
                <?= $form->field($billingModel, 'address',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <!-- end of agrress street-->


        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Phone*</label>
                <?= $form->field($billingModel, 'phone',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
		<div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Company</label>
                <?= $form->field($billingModel, 'company',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Email Address*</label>
                <?= $form->field($billingModel, 'email',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <!-- end of agrress street-->
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Confirm Email*</label>
                <?= $form->field($billingModel, 'confirm_email',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <!-- end of email and phone-->

        <!-- end of company-->
        <div class="input-first-half">
			<fieldset class="form-group country">
                <label for="countrySelect1">Country*</label>
				 <?= $form->field($billingModel, 'country_id')->dropDownList(
                    $billingModel->countries,
                    [
                        'prompt'=>'- Select Country -',
                        'class'=>'form-control dropfieldtxt',
                        'id'=>'country',
                        'onchange'=> '$.post( "'.Yii::$app->urlManager->createUrl('cart/active-states?id=').'"+$(this).val(), function( data ) {
                                $( "select#state" ).empty();
                                $( "select#city" ).html(data.cities);
                                $( "select#state" ).html( data.states );
                            });'

                    ]
                )->label(false)
                ?>
            </fieldset>
        </div>
        <div class="input-first-half">
			<fieldset class="form-group">
                <label for="firstname">Province/Territory</label>
				 <?= $form->field($billingModel, 'state_id')->dropDownList(
                    array(),
                    [
                        'prompt'=>'- Select State -',
                        'class'=>'form-control dropfieldtxt',
                        'id'=>'state',
                        'onchange'=> '$.post( "'.Yii::$app->urlManager->createUrl('cart/active-cities?id=').'"+$(this).val(), function( data ) {
                                $( "select#city" ).empty();
                                $( "select#city" ).html( data );
                            });'
                    ]
                )->label(false)
                ?>
				
            </fieldset>
        </div>

        <!-- end of city-->
        <div class="input-first-half">
			<fieldset class="form-group">
                <label for="firstname">City*</label>
				 <?= $form->field($billingModel, 'city_id')->dropDownList(
                    array(),
                    [
                        'prompt'=>'- Select City -',
                        'class'=>'form-control dropfieldtxt',
                        'id'=>'city',
                    ]
                )->label(false)
                ?>
            </fieldset>
        </div>
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Postal Code</label>
                <?= $form->field($billingModel, 'zip',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <!-- end of country select-->
    </div>

    <!-- end of form fill-first half-->

        <h5>Shipping  Address</h5>
        <div class="errors-block"></div>
        <div class="checkbox enter-pwd chek-label">
            <label>


                <?php $checkboxTemplate = '{input}{label}'; ?>

                <?= $form->field($billingModel, 'is_shipping')->checkbox(array('template' => $checkboxTemplate,'id'=>'shipaddbtn','label'=>'<div class="text-enter ship-chk">Ship to a Different Address</div>')); ?>

            </label>
            <?php if (Yii::$app->user->isGuest) { ?>
            <label>
                    <?= $form->field($guestModel, 'new_account')->checkbox(array('template' => $checkboxTemplate,'id'=>'newaccountbtn','label'=>'<div class="text-enter ship-chk">Enter a password to create an account</div>')); ?>

            </label>
             <?php } ?>
        </div>

        <div class="user-form" id="new-account-form">
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Password*</label>
                    <?= $form->field($guestModel, 'password')->passwordInput(['class' => 'textField form-control','placeholder' => 'Password'])->label(false) ?>
                </fieldset>
            </div>
        </div>

        <div class="user-form" id="shipping-address-form">
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">First Name*</label>
                    <?= $form->field($shippingModel, 'fname',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Last Name*</label>
                    <?= $form->field($shippingModel, 'lname',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <!-- end of first& last name-->
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Street address 1*</label>
                    <?= $form->field($shippingModel, 'address',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Street address 2</label>
                    <?= $form->field($shippingModel, 'address',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <!-- end of agrress street-->


            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Phone*</label>
                    <?= $form->field($shippingModel, 'phone',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Email Address*</label>
                    <?= $form->field($shippingModel, 'email',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <!-- end of agrress street-->
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Confirm Email*</label>
                    <?= $form->field($billingModel, 'confirm_email',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <!-- end of email and phone-->
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Company</label>
                    <?= $form->field($shippingModel, 'company',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>

            <!-- end of company-->
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">City*</label>
                    <?= $form->field($shippingModel, 'city_id',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Province/Territory</label>
                    <?= $form->field($shippingModel, 'state_id',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>

            <!-- end of city-->
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Postal Code</label>
                    <?= $form->field($shippingModel, 'zip',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <div class="input-first-half">
                <fieldset class="form-group country">
                    <label for="countrySelect1">Country*</label>
                    <select class="form-control dropfieldtxt" id="exampleSelect1">
                        <option>India</option>
                        <option>Chandigargh</option>
                        <option>Goa</option>
                        <option>Rajasthan</option>
                        <option>Punjab</option>
                    </select>
                </fieldset>
            </div>
            <!-- end of country select-->
        </div>


<hr>
<div class="red-btn"> <?= Html::submitButton('CONTINUE') ?></div>
<?php ActiveForm::end(); ?>