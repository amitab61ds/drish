<?php
namespace frontend\widgets;

use common\models\GuestUser;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\BillingAddress;
use common\models\ShippingAddress;
use common\models\Newsletter;


class AddressForm extends Widget
{

    public function run()
    {
        if (!Yii::$app->user->isGuest) {
            $billingModel = BillingAddress::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
            $shippingModel = ShippingAddress::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
            if(!$billingModel)
                $billingModel = new BillingAddress();

            if(!$shippingModel)
                $shippingModel = new ShippingAddress();
        }else{
            $billingModel = new BillingAddress();
            $shippingModel = new ShippingAddress();
        }

        $guestModel = new GuestUser();
        return $this->render('address-form', [
            'billingModel' =>  $billingModel,
            'shippingModel' =>  $shippingModel,
            'guestModel' =>  $guestModel,
        ]);
    }
}