<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

?>
   <div class="container-fluid craftsmanship-area">
   				<div class="bredcrumb-nav">
                        <ul>
                            <li><a href="<?= Yii::$app->params['baseurl'] ?>/">Home</a></li>
                            <li class="active"><a href="#">Contact Us</a></li>
                      </ul>
        		</div>            
   </div>  
<div class="container-fluid craftsmanship-area quality-outer">
     <div class="contact-us-banner">
        <img src="<?= Yii::$app->params['baseurl'] ?>/images/contact-us-banner.jpg" alt="contact-us-banner" title="contact-us-banner" class="img-responsive">
        <h2>Contact us</h2>
     </div>
 </div>
 <section class="contact-img">
 	<div class="container">
    	<div class="contact-area">
           <div class="contact-info">
           	 <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <a href="mailto:support@drish.com">support@drish.com</a>
                <a href="tel:01234567890">+9872625502</a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <address>
                        <span>ELANTE MALL, Chandigarh (#244, Second Floor )</span>
                        18001370107
                    </address> 
                </div>
            </div>
            </div>
			<?php $form = ActiveForm::begin(['id' => 'contact-form','options' => [
                'class' => 'form-user'
             ]]); ?>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<?= $form->field($model, 'name')->textInput(['placeholder' => 'Name','class' => ''])->label(false) ?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<?= $form->field($model, 'email')->textInput(['placeholder' => 'Email','class' => ''])->label(false) ?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<?= $form->field($model, 'phone')->textInput(['placeholder' => 'Phone No.','class' => ''])->label(false) ?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<?= $form->field($model, 'address')->textInput(['placeholder' => 'Address','class' => ''])->label(false) ?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<?= $form->field($model, 'city')->textInput(['placeholder' => 'City','class' => ''])->label(false) ?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<?= $form->field($model, 'subject')->textInput(['placeholder' => 'Subject','class' => ''])->label(false) ?>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?= $form->field($model, 'body')->textArea(['placeholder' => 'Message','class' => ''])->label(false) ?>
					</div>
				</div>
				<div class="row">
                	<div class="col-lg-12 center-block">
						<div class="send-msg">
							<?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-default', 'name' => 'contact-button']) ?>
						</div>
					</div>
				</div>
        <?php ActiveForm::end(); ?>
           </div>
        </div>
 </section>
 <div class="contact-map">
 	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3430.4556663583808!2d76.79896121582776!3d30.705587981646683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fece98c02452b%3A0xf3c99c507c9226eb!2sElante+Mall%2C+178-178A%2C+Purv+Marg%2C+Industrial+Area+Phase+I%2C+Chandigarh%2C+160002!5e0!3m2!1sen!2sin!4v1464858853783" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
 </div>