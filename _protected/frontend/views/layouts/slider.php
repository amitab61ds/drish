<?php
use frontend\widgets\HomeMenuLeft;
use frontend\widgets\SliderWid;
use frontend\widgets\CartProductCounter;
use yii\helpers\Url;
use frontend\widgets\Search;
?>

    <div class="slider-area">
        <div class="main-slider">
             <?= SliderWid::widget([ 'position'=>"header" , 'controller' => Yii::$app->controller->id ]) ?> 
        </div>
    </div>	 

	