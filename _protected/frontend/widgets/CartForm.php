<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;


class CartForm extends Widget
{
    public $model;
    public $cart;
    public $varientModel;
    public $wishlist;

    public function run()
    {

        return $this->render('cart-form', [
            'model' =>  $this->model,
            'cart' =>  $this->cart,
            'varientModel' =>  $this->varientModel,
            'wishlist' =>  $this->wishlist,
        ]);
    }
}