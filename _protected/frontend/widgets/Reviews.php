<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\Review;

class Reviews extends Widget
{
	public $product_id;
	public function run()
	{
        $model = new Review;
		$data = $model->find()->where(['user_id' => \Yii::$app->user->identity->id, 'product_id' => $this->product_id ])->one();
		return $this->render('review', 
		[
            'model'  => $model,
            'product_id'  => $this->product_id,
            'data'  => $data ,
        ]);
		
	}
}