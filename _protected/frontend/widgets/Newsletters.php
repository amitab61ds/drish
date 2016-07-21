<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\Newsletter;
class Newsletters extends Widget
{
	public function run()
	{
        $model = new Newsletter();
		return $this->render('newsletter', 
		[
            'model'  => $model,
        ]);
		
	}
}
?>