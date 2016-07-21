<?php
namespace app\components;

use Yii;
use yii\base\Widget;
use dektrium\user\models\RecoveryForm;

class Forgetpass extends Widget
{
	public function run()
	{
                
        $model = Yii::createObject([
            'class'    => RecoveryForm::className(),
            'scenario' => 'request',
        ]);
		return $this->render('forgetpass', 
		[
            'model'  => $model,
        ]);
		
	}
}