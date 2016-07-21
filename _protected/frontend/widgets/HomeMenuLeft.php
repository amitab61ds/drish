<?php
namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use common\models\Menu;
class HomeMenuLeft extends Widget

{
	public function run()
	{

		$footer_menu = Menu::findOne(['id' => 26,'active'=>1]);
		$children = $footer_menu->children(1)->all();

		$menus = array();
		$j = 0;
		foreach($children as $childs){

			if($childs->active != 1)

				continue;

			$sub_children = $childs->children(1)->all();
			
			$i = 0;
			$menus[$childs->id]['name'] = $childs->name;

			$menus[$childs->id]['link'] = $childs->link;

			$menus[$childs->id]['icon'] = $childs->icon;

		}

		return $this->render('homeMenuLeft', [

			'menus' =>  $menus,

        ]);

		

	}

}