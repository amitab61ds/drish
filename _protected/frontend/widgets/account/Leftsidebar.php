<?php
namespace app\components\account;

use Yii;
use yii\base\Widget;

class Leftsidebar extends Widget
{
	public function run()
	{
		$user = \Yii::$app->user->identity;

		return $this->render('leftSidebar', 
		[
			'user' => $user
        ]);
		
	}
}