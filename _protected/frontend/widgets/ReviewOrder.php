<?php
namespace frontend\widgets;

use common\models\DiscountCode;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\Cart;
use common\models\Product;
use common\models\VarientProduct;


class ReviewOrder extends Widget
{
    public $order;
    public function run()
    {
        $cartModel = new Cart();
        $cart = $cartModel->getFinalCart();
        $this->order->payment_method = $cart['payment_method'];
        return $this->render('review-order',['items'=>$cart
        ,'order'=>$this->order]);
    }
}