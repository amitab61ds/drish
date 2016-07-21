<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use frontend\models\LoginForm;

class Login extends Widget
{ 
	public function run()
	{
        $model = \Yii::createObject(LoginForm::className());
		
		return $this->render('login', 
		[
            'model'  => $model,
        ]);
		
	}
}