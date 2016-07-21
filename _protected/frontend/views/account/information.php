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
						<?= $form->field($profile, 'fname')->textInput(['maxlength' => true]) ?>
					</div>
					<div class="input-field">
						<?= $form->field($profile, 'lname')->textInput(['maxlength' => true]) ?>
					</div>
					<div class="input-field">
						<?= $form->field($profile, 'phone')->textInput(['maxlength' => true]) ?>
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




            
				