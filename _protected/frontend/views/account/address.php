<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php
use yii\helpers\Url;
$user_id = \Yii::$app->user->identity->id;
?>

<!-- account dashboard -->
     <section class="dashboard-user">
       <div class="container-fluid craftsmanship-area">
         <div class="user-dashboard">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard-list">
                <h4>Account</h4>
                    <ul class="acc-dash">
						<li><a href="<?= Url::to(['account/index']) ?>" class="active">Account Dashboard</a></li>
						<li><a href="<?= Url::to(['account/orders']) ?>">Orders Detail</a></li>
						<li><a href="<?= Url::to(['account/mywishlist']) ?>" >My Wishlist</a></li>
					</ul>
                </div>
            </div>
                </div>
            </div>
            <!-- end of left part of account list-->
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                 <div class="account-detail record-pro">
                    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       

			<div class="row">

			<div class="account-create">

				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

					<h3>Account Information</h3>

				</div>



			</div>

		</div>

		<?php $form = ActiveForm::begin() 

		?>	
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="input-field">
						<?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
					</div>
					<div class="input-field">
						<?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
					</div>
					<div class="input-field">
						<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
					</div>
					<div class="input-field">
						<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
					</div>
					<div class="input-field">
						<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
					</div>
					<div class="input-field">
						<?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>
					</div>
					<div class="input-field">
						<fieldset class="form-group country">
							<label for="countrySelect1">City</label>					
							<?= $form->field($model, 'city_id')->dropDownList(
								$model->getIndiacity($model->state_id),
								[
									'prompt'=>'- Select City -',
									'class'=>'form-control dropfieldtxt',
									'id'=>'city',
								]
							)->label(false);
							?>
						</fieldset>
					</div>
					<div class="input-field">
						<fieldset class="form-group country">
							<label for="countrySelect1">State</label>					
							<?= $form->field($model, 'state_id')->dropDownList(
								$model->states,
								[
									'prompt'=>'- Select State -',
									'class'=>'form-control dropfieldtxt',
									'id'=>'state',
									'onchange'=> '$.post( "'.Yii::$app->urlManager->createUrl('cart/active-cities?id=').'"+$(this).val(), function( data ) {
											$( "select#city" ).empty();
											$( "select#city" ).html( data );
										});'
								]
							)->label(false);
							?>
						</fieldset>
					</div>
					<div class="input-field">
						<fieldset class="form-group country">
							<label for="countrySelect1">Country</label>
							 <?= $form->field($model, 'country_id')->dropDownList(
								$model->countries,
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
							)->label(false);
							?>
						</fieldset>
					</div>
					<div class="input-field">
						<?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>
					</div>
				</div>	
			</div>

		 <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>

		<?php ActiveForm::end(); ?>	

                    </div>
                </div>
                    
            </div>
            </div>
            <!-- end of right part of account detail-->
        </div>
    </div>
       </div>
     </section>
<!-- account dashboard end -->




            
			
	