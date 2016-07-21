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

class ProductsFeatured extends Widget
{
	public $type;
    public function run()
    { 
		$prod_model = array();
		if($this->type == "men"){
			$prods = Product::find()->where(["status" => 1,"featured"=>1])->orderBy(["id"=> SORT_DESC ])->all();
			$cat = Category::find()->where(['id' => 2])->one();
			$cat_child = $cat->children()->all();
			foreach($prods as $prod){
				foreach($cat_child as $categ){
					if($prod->category_id == 2 ){
						$prodone = Product::find()->where(["category_id" => 2])->one();
					}else{
						$prodone = $prod;
					}
					if($prodone){
						$prod_model[] = $prodone;
					}
				}				
			}
		}else if($this->type == "women"){
			$prods = Product::find()->where(["status" => 1,"featured"=>1])->orderBy(["id"=> SORT_DESC ])->all();
			$cat = Category::find()->where(['id' => 3])->one();
			$cat_child = $cat->children()->all();
			foreach($prods as $prod){
				foreach($cat_child as $categ){
					if($prod->category_id == 3 ){
						$prodone = Product::find()->where(["category_id" => 3])->one();
					}else{
						$prodone = $prod;
					}
					if($prodone){
						$prod_model[] = $prodone;
					}
				}				
			}	
		}else if($this->type == "kids"){
			$prods = Product::find()->where(["status" => 1,"featured"=>1])->orderBy(["id"=> SORT_DESC ])->all();
			$cat = Category::find()->where(['id' => 1])->one();
			$cat_child = $cat->children()->all();
			foreach($prods as $prod){
				foreach($cat_child as $categ){
					if($prod->category_id == 1 ){
						$prodone = Product::find()->where(["category_id" => 1])->one();
					}else{
						$prodone = $prod;
					}
					if($prodone){
						$prod_model[] = $prodone;
					}
				}				
			}
		}

        if($prod_model) {
            return $this->render('product-featured', [
                'product_ids' => $prod_model,
                'type' => $this->type,
            ]);
        }
    }

}