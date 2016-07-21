<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\Cart;
class CartProductCounter extends Widget
{
    public function run()
    {
        if(Yii::$app->user->isGuest){
            $userid = 0;
        }else{
            $userid = Yii::$app->user->identity->id;
        }
        $result = Cart::getCartItemsCount($userid);
        return  $result;
    }
}