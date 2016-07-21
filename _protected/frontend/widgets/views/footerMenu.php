<?php 
use yii\helpers\Url;
$arry = array("Drish Delivers",'All About Drish','Drish Story');
$i=0;
foreach($menus as $key => $parent_menu){
	if($parent_menu['child']){
		echo'<div class="f-nav"><a href="javascript:void(0);" class="f-titles subtit'.$i.'">'.$arry[$i].'<i id="plus'.$i.'" class="fa fa-plus"></i><i  class="fa fa-minus" id="minus'.$i.'"></i></a><ul id="subs'.$i.'">';
		foreach($parent_menu['child'] as $menu){ ?>
			<li><a href="<?= Yii::$app->homeUrl.$menu['link'] ?>" ><?= $menu['name'] ?></a></li>          
<?php	}
		echo'</ul></div>';
	}
	$i++;
}

?>
