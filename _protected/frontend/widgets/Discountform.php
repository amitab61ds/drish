<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;



class Discountform extends Widget
{
    public function run()
    {
        $session = Yii::$app->session;
        $msg = "";
        if ($session->has('discountid')) {
            $msg = "You already applied one coupon.";
        }
        $model = new \frontend\models\DiscountForm();
        return $this->render('discount-form', [
            'model' =>  $model,
            'msg' =>  $msg,
        ]);
    }
}