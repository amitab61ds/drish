<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use frontend\models\SearchForm;

class Search extends Widget
{
	public $type;
	public function run()
	{
        $model = new SearchForm;			
		return $this->render('search', 
		[
            'model'  => $model,
            'type'  => $this->type,
        ]);
		
	}
}