<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\SliderImages;

class OfferSlider extends Widget
{
	public function run()
    {
		$slides = SliderImages::find()->where(['slider_id' => 83 ])->all();
		return $this->render('offer-slider', [
			'slides' =>  $slides,
        ]);	
	}
}