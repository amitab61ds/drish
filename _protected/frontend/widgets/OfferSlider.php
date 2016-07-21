<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\WomenPageSetting;

class OfferSlider extends Widget
{
	public function run()
    {

		$women_model = WomenPageSetting::find()->where(['id' => 2])->one();	
		return $this->render('offer-slider', [
			'women_model' =>  $women_model,
        ]);	
	}
}