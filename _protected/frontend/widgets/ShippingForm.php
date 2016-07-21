<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;



class ShippingForm extends Widget
{

    public function run()
    {

        return $this->render('shipping-form');
    }
}