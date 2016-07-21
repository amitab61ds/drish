<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;



class PaymentForm extends Widget
{
    public $order;
    public function run()
    {

        return $this->render('payment-form',['order'=>$this->order]);
    }
}