<?php
namespace frontend\controllers;
use yii\helpers\Url;
use common\models\User;
use common\models\LoginForm;
use common\models\Pages;
use common\models\Newsletter;
use common\models\Product;
use common\models\Cart;
use common\models\VarientProduct;
use common\models\Review;
use common\models\ProductImages;
use common\models\ProductPageSetting;
use common\models\ProductDropdownValues;
use common\models\Category;
use common\models\ProductTextValues;
use common\models\ProductDescValues;
use common\models\DropdownValues;
use common\models\Attributes;
use frontend\models\AccountActivation;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SearchForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\web\Response;
/**
 * Site controller.
 * It is responsible for displaying static pages, logging users in and out,
 * sign up and account activation, password reset.
 */
class FinderController extends Controller
{
    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Declares external actions for the controller.
     *
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

//------------------------------------------------------------------------------------------------//
// STATIC PAGES
//------------------------------------------------------------------------------------------------//


	public function actionCategory($slug,$main=0,$submain = 0){
		$this->layout="category";
		if($main){
			$parent_main = Category::find()->where(['slug' =>$main ])->one();
			$cat = Category::find()->where(['slug' =>$slug,'root' => $parent_main->id])->one();
			/* $cat_childs = $parent_main->children(1)->all();
			foreach($cat_childs as $cat_child){
				if( $cat_child->id == $cat->id ){
					
				}
			} */
			if($submain){
				$parent_submain = Category::find()->where(['slug' =>$submain ])->one();
			}
		}else{
			$cat = Category::find()->where(['slug' =>$slug])->one();	
		} 
		
		$products = array();
		$productimage = new ProductImages;
		if($cat){
		$cat_child = $cat->children()->all();
		
		$products1 = Product::find()->where(['category_id' => $cat->id])->limit(20)->orderBy(['updated_at' => SORT_DESC, ])->all();
		
		if($products1){
			$products[] = $products1;
		}
		if($cat_child){
			foreach($cat_child as $cat_sub_child){
				$cat_subchild = $cat_sub_child->children(1)->all();
				$products2 = Product::find()->where(['category_id' => $cat_sub_child->id])->limit(20)->orderBy(['updated_at' => SORT_DESC, ])->all();
				if($products2){
					$products[] = $products2;
				}
				if($cat_subchild){
					foreach($cat_subchild as $cat_subchild1){
						$cat_subchilds = $cat_subchild1->children(1)->all();
						$products3 = Product::find()->where(['category_id' => $cat_subchild1->id])->limit(20)->orderBy(['updated_at' => SORT_DESC, ])->all();
						if($products3){
							$products[] = $products3;
						}
						if($cat_subchilds){
							foreach($cat_subchilds as $cat_subchilds1){
							$products4 = Product::find()->where(['category_id' => $cat_subchilds1->id])->limit(20)->orderBy(['updated_at' => SORT_DESC, ])->all();
							if($products4){
									$products[] = $products4;
								}
							}
						}
					}
				}
			}
		}
		}
		return $this->render('/site/category', [
           'products' => $products,
           'productimage' => $productimage,
           'category' => $cat,
           'main' => $main,
           'submain' => $submain,
           'slug' => $slug,
        ]);
	}
	public function actionSearch(){
		$request = Yii::$app->request;
        if ($request->isAjax) {
            $searchevent = Yii::$app->request->post('searchevent');
			$models = Product::find()->where(['like', 'name', $searchevent])->limit(5)->orderBy(['updated_at' => SORT_DESC, ])->all();
			$data = array();
			foreach($models as $model){
				$data[$model->id]['link']= Url::to(['men/product','slug'=>$model->slug]);
				$data[$model->id]['name']= $model->name;
			}
			return json_encode($data);

        } 
	}
	public function actionProductSearch(){
		$this->layout="category";
		$model = new SearchForm;
		$product_model = new Product;
		$request = Yii::$app->request;
		$dropdown = new DropdownValues;
		if ($request->isAjax) {
			
			$products = array();
			$productimage = new ProductImages;
			
			$query = Product::find()->innerJoinWith('varientProducts');
			
			if(Yii::$app->request->post('color') != ""){
				$query->andWhere(['varient_product.color' => Yii::$app->request->post('color')]);	
			}
			if(Yii::$app->request->post('cat_id') != ""){
				$cat_all = Category::findOne(Yii::$app->request->post('cat_id'));
				$cat_subchild = $cat_all->children(1)->all();
				$cat_ids = array();
				if($cat_subchild){
					foreach($cat_subchild as $cat_subchild1){
						$cat_ids[] = $cat_subchild1->id;
					}
					$query->andWhere(['product.category_id' => $cat_ids ]);	
				}else{
					$query->andWhere(['product.category_id' => $cat_all->id ]);	
				}
					
			}
			if(Yii::$app->request->post('size') != ""){
				$query->andWhere(['varient_product.size' => Yii::$app->request->post('size')]);	
			}
			if(Yii::$app->request->post('width') != ""){
				$query->andWhere(['varient_product.width' => Yii::$app->request->post('width') ]);	
			}
			if(Yii::$app->request->post('sortby') != ""){
				if(Yii::$app->request->post('sortby') == 2){
					 $query->orderBy(['product.price' => SORT_ASC]);
				}else if(Yii::$app->request->post('sortby') == 3){
					 $query->orderBy(['product.price' => SORT_DESC]);	
				}	
			}
			/* if(Yii::$app->request->post('brand') != ""){
				$query->orderBy(['product.name' => SORT_ASC]);
			} */
			$data = array();
			$products = $query->distinct()->limit(20)->all();
			foreach($products as $product){ 
				$data[$product->id]['div'] = '<div class="col-lg-3 col-sm-4 col-md-4 col-xs-12 braided-flip">
							<a href="'.Url::to(["men/product","slug"=>$product->slug ]) . '">
							   <div class="braided-main">
								  <div class="braided-img">
									 <ul class="braided-heart">
										<li>
										   <svg enable-background="new 0 0 128 128" id="Layer_1" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
											  <circle cx="89" cy="101" fill="none" r="8" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
											  <circle cx="49" cy="101" fill="none" r="8" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
											  <path d="  M29,33h83.0800705c2.8071136,0,4.7410736,2.8159065,3.7333832,5.4359169L99.8765564,79.8718338  C98.6882782,82.9613724,95.7199707,85,92.4097977,85H45.6081238c-3.8357391,0-7.1316795-2.722496-7.8560524-6.4892197L29,33z" fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
											  <path d="  M28.9455147,33.0107765l-1.5162468-7.5799599C26.6812878,21.6915436,23.3980236,19,19.5846729,19h-7.2409086" fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4"/>
											  <line fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4" x1="89.9039841" x2="92.9041901" y1="45" y2="45"/>
											  <line fill="none" stroke="#00AEEF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4" x1="32" x2="80.9041901" y1="45" y2="45"/>
										   </svg>
										</li>
										<li><i class="fa fa-heart-o"></i></li>
									 </ul>
									 <div class="card effect__hover">
										<div class="card__front">
										   <span class="card__text"><img src="'.Yii::$app->params['baseurl'].'/uploads/product/main/'. $product->id .'/custom2/'. $product->productImages->main_image .'" class="img-responsive" alt="shoes" title="shoes"></span>
										</div>
										<div class="card__back">
										   <span class="card__text"><img src="'. Yii::$app->params['baseurl'] .'/uploads/product/flip/'. $product->id .'/custom2/'. $product->productImages->flip_image .'" class="img-responsive" alt="shoes-1" title="shoes"></span>
										</div>
									 </div>  
									 <!-- /card -->	
								  </div>
								  <div class="braided-text">
									 <p>'. $product->name .'</p>
									 <p class="red-color"> <i class="fa fa-inr"></i>'. $product->price .'</p>
								  </div>
							   </div>
							</a>
						 </div>';
				
			}
			return json_encode($data);
			
		}
		if ($model->load(Yii::$app->request->get())) {
			$products = array();
			$productimage = new ProductImages;
			$products1 = Product::find()->where(['like', 'name', $model->search])->limit(20)->orderBy(['updated_at' => SORT_DESC, ])->all();
			if($products1){
				$products[] = $products1;
			}
			return $this->render('/site/search', [
		   'search'=> $model->search,
           'dropdown' => $dropdown,
           'product_model' => $product_model,
           'products' => $products,
           'productimage' => $productimage,
        ]);
		}
		return $this->redirect('index');
	}
	
}
