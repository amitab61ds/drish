<?php
use yii\helpers\Url;
use frontend\widgets\Discountform;

$count = 0;
if(isset($items['items']))
    $count = count($items['items']);


?>
<section class="cart-detail-outer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <h2>Shopping Cart</h2>
                <div class="bredcrumb-nav">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active"><a href="#">Shopping Cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end of bredcrum-->
    <div class="container">
        <div class="shopping-bags border-cart">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 br-botm">
                    <div class="shoping-text"> <h3>Shopping Bag</h3></div>
                </div>
            </div>
            <div class="row">
            <?php
            $i = 0;

            $classrow = array('row','row br-top');
            if($count > 0){

            foreach($items['items'] as $key=>$item){

                if($i%2==0 && $i != 0)
                    echo '</div><div class="row br-top">';
            ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 <?= ($i%2 == 0)? 'br-right': ''; ?>">

                        <div class="edit-block">
                            <div class="edit-bags">
                                <div class="bags-img"><img src="<?= $item['img'] ?>" alt="edt-bags" title="esit-bags"></div>
                                <ul class="edit-icon">
                                    <li><a href="<?= Url::to(['men/product','id'=>$item['product_id']]) ?>"> <span><i class="fa fa-pencil" aria-hidden="true"></i></span>Edit</a></li>
                                    <li><a href="<?= Url::to(['cart/remove','id'=>$key]) ?>"><span><i class="fa fa-times" aria-hidden="true"></i></span>Remove</a></li>

                                </ul>


                            </div>
                            <!-- end of left-edit bags-->

                            <div class="bag-color">
                                <div class="braided-l"><?= $item['name'] ?><span class="red-color"><i class="fa fa-inr" aria-hidden="true"></i><?= $item['price'] ?></span></p></div>
                                <p><?= $item['sku'] ?>  |  In Stock</p>
                                <ul class="colr-chose">
                                    <li>Color</li><li><?= $item['color'] ?></li>
                                    <li>Size</li><li><?= $item['size'] ?></li>
                                    <li>Width</li><li><?= $item['width'] ?></li>
                                    <li>Qty	</li><li><?= $item['quantity'] ?></li>
                                </ul>
                                <p><a href="<?= Url::to(['site/index']) ?>" class="red-color">Buy More & Continue</a></p>
                            </div>
                        </div>
                    </div>
            <?php
                $i++;
            } }else{
                ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 br-right">
                Cart is empty , <a href="<?= Url::to(['site/index']) ?>" class="red-color">Search your products </a>.
                </div>
                <?php
            }
            ?>
            </div>

            <?php if($count > 0){ ?>
                <div class="row br-top">
                    <div class="warming-area">
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="warning">
                                <p><span class="red-color"><i class="fa fa-exclamation" aria-hidden="true"></i></span>
                                    You will be able to review the final price and other details of your Order Total at the right before you Place Order.</p>
                            </div>
                            <div class="discount">
                                <?= Discountform::widget() ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="sub-total-main">
                                <div class="subtotal">
                                    <div class="left-total">SUBTOTAL</div>
                                    <div class="total-price"> <span class="red-color"><i aria-hidden="true" class="fa fa-inr"></i><?= $items['total'] ?></span><br>
                                        All Prices are in INR</div>
                                </div>
                                <?php if(Yii::$app->user->isGuest) {
                                    ?>
                                    <div class="proceed-btn"><a class="enable-checkout-login"><button type="button">Proceed to Checkout</button></a></div>
                                <?php
                                }else{ ?>
                                    <div class="proceed-btn"><a href="<?= Url::to(['cart/checkout']) ?>"><button type="button">Proceed to Checkout</button></a></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
        <?php if(Yii::$app->user->isGuest) { ?>
            <!-- end of shoping cart-->
            <div class="shopping-bags border-cart checkout-guest">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 br-botm">
                        <div class="shoping-text"> <h3>Check Out</h3></div>
                    </div>
                </div>

                <div class="row">
                    <div class="register-area">
                        <div class="col-lg-6 col-sm-7 col-md-7 col-xs-12">
                            <div class="register-save">
                                <h4>Register and save time!</h4>
                                <p>Register with us for future convenience:</p>
                                <div class="fast-check">

                                    <p><span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>Fast and easy check out</p>
                                    <p><span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>Easy access to your order history and status</p>
                                </div>

                                <div class="sign-in btn">
                                    <ul>
                                        <li>
                                            <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/sign-in-checkout.png" alt="f-sign-in" title="f-sign-in" class="img-responsive sign-in-checkout"></li>
                                        <li>  <img src="<?= Yii::$app->view->theme->baseUrl ?>/images/sign-in-g-checkout.png" alt="f-sign-in" title="f-sign-in" class="img-responsive"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-5 col-md-5 col-xs-12">
                            <div class="sign-in-chek-out">
                                <button type="button" class="sign-chk"> Sign In</button></br>
                                <a href="<?= Url::to(['cart/checkout']) ?>"><button type="button" class="check-btn"> Check out as a guest</button></a>

                            </div>


                        </div>
                    </div>
                </div>

            </div>
        <?php } ?>




    </div>

</section>