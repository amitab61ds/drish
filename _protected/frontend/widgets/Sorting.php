<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use frontend\models\SortForm;

class Sorting extends Widget
{
	public function run()
	{
        $model = new SortForm;			
		return $this->render('sorting', 
		[
            'model'  => $model,
        ]);
		
	}
}