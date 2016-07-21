<?php
use frontend\widgets\AddressForm;
use frontend\widgets\ShippingForm;
use frontend\widgets\PaymentForm;
use frontend\widgets\ReviewOrder;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$baseurl = Yii::$app->params['baseurl'];



$js = <<<JS
// get the form id and set the event
$('form#payment-form').on('beforeSubmit', function(e) {
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
			    $(".cod-tr").hide();
                $(".address li.step4 span").removeClass("close").addClass("open");
                $(".address li.step3 span").next().slideUp();
                $(".address li.step3 span i").removeClass("fa-minus").addClass("fa-plus");

                $(".address li.step4 span").next().slideDown();
                $("i",".address li.step4 span").addClass("fa-minus").removeClass("fa-plus");
                $(".address li span").removeClass("active");
                $(".address li.step4 span").addClass("active");

                if(response.payment_method == 1){

                     $(".cod").html(response.cod);
                     $(".cod-tr").show();

                     $(".discount").html(response.discount);
                     $(".total").html(response.total);
                }else{
                    $(".cod").html(response.cod);
                     $(".cod-tr").hide();

                     $(".discount").html(response.discount);
                     $(".total").html(response.total);
                }


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
   <section class="cart-detail-outer">
    
   		<div class="container">
        
   			<div class="row">
   				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
   					<h2>Checkout</h2>	 
					<div class="bredcrumb-nav">
           		 	<ul>
            			<li><a href="index.html">Home</a></li>
                		<li class="active"><a href="#">Checkout</a></li>
           		  </ul>
        		</div> 
</div>
			</div>
           
	<!-- end of bredcrum--> 
    
   <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
            <ul class="address">
              <li class="step1">
                <span class="open">1. Addresses<i class="fa fa-plus fa-minus"></i></span>
                <div style="display:block;" class="detail-shipping">
                
                <div class="address-tab">
                 <h5>Billing Address</h5>
                    <?= AddressForm::widget() ?>

                </div>
                
      			</div>
              </li> 
              <li class="step2">
                    <span>2. Shipping Method<i class="fa fa-plus"></i></span>
                    <?= ShippingForm::widget() ?>
              </li>
              <li class="step3">
                <span>3. Payment Information<i class="fa fa-plus"></i></span>

                  <div class="detail-shipping">
                      <div class="shipping-main">
                          <?php $form = ActiveForm::begin([
                              'action'=> ['cart/payment-method'],
                              'id'     => 'payment-form',
                              'enableAjaxValidation'   => false,
                          ]);

                          ?>
                          <div class="shipping-method">
                              <?= $form->field($payment, 'payment_method')->radioList($payment->getPayments(),['class'=>'free-s'])->label(false) ?>
                          </div>

                          <hr class="border-line">
                          <div class="btn-cart red-btn">
                              <?= Html::submitButton('CONTINUE', ['class' => 'payment-method-btn', 'name' => 'pay-button']) ?>
                          </div>
                          <?php ActiveForm::end(); ?>
                      </div>
                  </div>
              </li>
              <li class="step4">
                <span>4. Order Review<i class="fa fa-plus"></i></span>
                  <div class="detail-shipping">
                      <div class="shipping-main">

                          <?= ReviewOrder::widget(['order'=>$order]) ?>
                      </div>
                  </div>


              </li>
              
            </ul>
          </div>
        </div>
    
    
 </div>
    
</section>