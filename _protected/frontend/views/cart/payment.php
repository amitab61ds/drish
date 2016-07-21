<?php

$js = <<<JS
     window.addEventListener('message', function(e) {
         $("#paymentFrame").css("height",e.data['newHeight']+'px');
     }, false);
JS;
$this->registerJs($js);
?>
<section class="cart-detail-outer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <h2>Payment Section</h2>
                <div class="bredcrumb-nav">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active"><a href="#">Payment Processing</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <iframe src="<?= $order->production_url?>" id="paymentFrame" width="482" height="450" frameborder="0" scrolling="No" ></iframe>

            </div>
        </div>
    </div>
</section>