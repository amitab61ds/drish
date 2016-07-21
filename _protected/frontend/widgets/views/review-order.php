<?php
use yii\helpers\Html;

use yii\bootstrap\ActiveForm;
$baseurl = Yii::$app->params['baseurl'];



$js = <<<JS
// get the form id and set the event
$('form#{$order->formName()}').on('beforeSubmit', function(e) {
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


<?php    if(isset($items['items']) && count($items['items']) > 0){
?>
    <?php $form = ActiveForm::begin([
        'action'=> ['cart/place-order'],
        'id'     => $order->formName(),
        'enableAjaxValidation'   => false,
    ]);

    ?>
    <table id="checkout-review-table" class="data-table table">
        <colgroup><col>
            <col width="1">
            <col width="1">
            <col width="1">
        </colgroup>
        <thead>
            <tr class="first last">
            <th rowspan="1">Product Name</th>
            <th class="a-center" colspan="1">Price</th>
            <th class="a-center" rowspan="1">Qty</th>
            <th class="a-center" rowspan="1">Discount</th>
            <th class="a-center" colspan="1">Subtotal</th>
            </tr>
        </thead>

        <tfoot>
            <tr class="first">
                <td colspan="4" class="a-right" style="">
                Subtotal    </td>
                <td class="a-right last" style="">
                <span class="price"><i aria-hidden="true" class="fa fa-inr"></i><p class="subtotal"><?= $items['subtotal'] ?></p></span>    </td>
            </tr>
            <tr>
                <td colspan="4" class="a-right" style="">
                Shipping &amp; Handling (Free Shipping - Free)    </td>
                <td class="a-right last" style="">
                <span class="price"><i aria-hidden="true" class="fa fa-inr"></i>0.00</span>    </td>
            </tr>
            <?php if($order->payment_method == 1){ ?>
                <tr class="cod-tr">
                    <td class="a-right" style="" colspan="4">
                    Cash On Delivery            </td>
                    <td class="a-right last" style="">
                    <div class="price"><i aria-hidden="true" class="fa fa-inr"></i> <p class="cod">0.00</p></div>            </td>
                </tr>
            <?php } ?>
            <tr>
                <td class="a-right" style="" colspan="4">
                    Discount           </td>
                <td class="a-right last" style="">
                    <div class="price"><i aria-hidden="true" class="fa fa-inr"></i><p class="discount"><?= floatval($items['discount']) ?></p></div>
                </td>
            </tr>
            <tr class="last">
                <td colspan="4" class="a-right" style="">
                <strong>Grand Total</strong>
                </td>
                <td class="a-right last" style="">
                <strong><div class="price"><i aria-hidden="true" class="fa fa-inr"></i><p class="total"><?= floatval($items['total']) ?></p></div></strong>
                </td>
            </tr>
        </tfoot>

        <tbody>
            <?php

            foreach($items['items'] as $key=>$item){
                ?>

                <tr class="first odd">
                <td><h3 class="product-name"><?= $item['name'] ?></h3>
                <dl class="item-options">
                <dt>Color</dt>
                <dd><?= $item['color'] ?> </dd>
                <dt>Size</dt>
                <dd><?= $item['size'] ?></dd>
                <dt>Width</dt>
                <dd><?= $item['width'] ?></dd>
                </dl>
                </td>
                <td class="a-right">
                <span class="cart-price">

                <span class="price"><i aria-hidden="true" class="fa fa-inr"></i><?= $item['singleprice'] ?></span>
                </span>


                </td>
                <td class="a-center"><?= $item['quantity'] ?></td>
                    <td class="a-right last">
                <span class="cart-price">

                <span class="price"><i aria-hidden="true" class="fa fa-inr"></i><?= $item['discount'] ?></span>

                    </td>
                <!-- sub total starts here -->
                <td class="a-right last">
                <span class="cart-price">

                <span class="price"><i aria-hidden="true" class="fa fa-inr"></i><?= $item['price'] ?></span>
                </span>
                </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>

    <hr class="border-line">
    <div class="btn-cart red-btn">

        <?= Html::submitButton('Place Order') ?>
    </div>

    <?php ActiveForm::end(); ?>

<?php  } else{
    ?>
 No products in your cart.
    <?php
} ?>
