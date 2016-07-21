<?php
namespace frontend\widgets;use Yii;
use yii\base\Widget;
use yii\helpers\Html;use common\models\SliderImages;class SliderWid extends Widget{	public $controller;	public $position;	public $imggallery;	public function run()	{			if($this->controller == "men"){			$slider_id = 79 ;		}elseif($this->controller == "women"){			$slider_id = 80 ;		}else{			$slider_id = 81 ;		}		$slides = SliderImages::find()->where(['slider_id' => $slider_id])->all();		return $this->render('sliderwid', [			'slider_id' =>  $slider_id,			'slides' =>  $slides,			'position' =>  $this->position,
        ]);	
		
	}
}