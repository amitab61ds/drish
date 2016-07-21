<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\Product;
use common\models\ProductSearch;
use common\models\ProductForm;
use common\models\Category;
use common\models\Attributes;
use common\models\ProductSliderValues;
use common\models\ProductDropdownValues;
use common\models\ProductImages;
use common\models\DropdownValuesSearch;
use common\models\ProductTextValues;
use common\models\ProductDescValues;

class RelatedProducts extends Widget
{
    public $product_id;
    public function run()
    {
		$model = Product::find()->where(['id' => $this->product_id])->one();
		$arry = unserialize($model->related); 
        if($arry) {
            return $this->render('related-product', [
                'product_ids' => $arry,
            ]);
        }
    }

}