<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use frontend\models\SignupForm;use common\models\Profile;

class Registration extends Widget
{
	public function run()
	{
        $model = Yii::createObject(SignupForm::className());		        $pro_model = Yii::createObject(Profile::className());		
		return $this->render('registration', 
		[
            'model'  => $model,            'pro_model'  => $pro_model,
        ]);
		
	}
}