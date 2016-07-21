<?php
namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use common\models\Menu;
class FooterMenu extends Widget
{
	public function run()
	{
		$footer_menu = Menu::findOne(['id' => 1,'active'=>1]);
		$children = $footer_menu->children(1)->all();
		$menus = array();
		$j = 0;
		foreach($children as $childs){			if($childs->active != 1)
				continue;
			$sub_children = $childs->children(1)->all();			
			$i = 0;
			$menus[$childs->id]['name'] = $childs->name;
			foreach($sub_children as $sub_childs){
				if($sub_childs->active != 1)
					continue;
				
				
				$menus[$childs->id]['child'][$i]['name'] = $sub_childs->name;
				$menus[$childs->id]['child'][$i]['link'] = $sub_childs->link;
				$menus[$childs->id]['child'][$i]['css'] = $sub_childs->icon;
				
				$i++;
			}
			$j++;
		}
		return $this->render('footerMenu', [
			'menus' =>  $menus,
        ]);
		
	}
}