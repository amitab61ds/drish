<?php
namespace frontend\controllers;

use common\models\User;
use common\models\LoginForm;
use common\models\VarientProduct;
use frontend\models\AccountActivation;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Product;
use common\models\Review;
use common\models\Cart;
use common\models\ProductImages;
use common\models\ProductPageSetting;
use common\models\ProductDropdownValues;
use common\models\ProductTextValues;
use common\models\ProductDescValues;
use common\models\DropdownValues;
use common\models\Attributes;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

use common\models\Wishlist;

use Yii;
/**
 * Site controller.
 * It is responsible for displaying static pages, logging users in and out,
 * sign up and account activation, password reset.
 */
class MenController extends Controller
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

    /**
     * Displays the index (home) page.
     * Use it in case your home page contains static content.
     *
     * @return string
     */
    public function actionIndex()
    {
		$product_setting = ProductPageSetting::find()->where(['category_id' => 2])->one();
		$this->layout = "inner";
        return $this->render('index', ['product_setting' => $product_setting,]);
		
    }

    public function actionProduct($slug){
        $this->layout = "products";
		$ratin_model = new Review;
		$productid = Product::find()->where(['slug' => $slug])->one();
		$id = $productid->id;
		$get_rating = Review::find()->where(['product_id' => $id])->all();
		if($get_rating){
			$point = 0 ;
			$count = 0 ;
			foreach($get_rating as $get_ratings){
				$point = $get_ratings->rating + $point;
				$count++;
			}
			$avg_point = $point/$count;
			$ratin_model->rating = $avg_point;
		}else{
			$ratin_model->rating = 0;
		}
        $ProductDropdownValues = ProductDropdownValues::find()->where(['product_id' => $id])->all();
        $ProductDescValues = ProductDescValues::find()->where(['product_id' => $id])->all();
        $ProductTextValues = ProductTextValues::find()->where(['product_id' => $id])->all();
        $ProductImage = ProductImages::find()->where(['product_id' => $id,'default' => 1])->one();
		if($ProductImage){
			$ProductImages = $ProductImage;
		}else{
			 $ProductImages = ProductImages::find()->where(['product_id' => $id])->one();
		}
        $DropdownValues = new DropdownValues;
        $cart = new Cart();
        $varientModel = new VarientProduct();
        $wishlist = Wishlist::getWishlistObj();

        if (($model = Product::findOne($id)) !== null) {
            $searchvarient = VarientProduct::find()->where(['product_id'=>$id])->all();
            $varients = array();
            $i = 0;
            foreach($searchvarient as $varient){
                $qnt = $varient->quantity;
                if($qnt < 1)
                    continue;

                $varients[$varient->size][$varient->width][$varient->color]['color_val'] = $varient->color0->displayname;
                $varients[$varient->size][$varient->width]['width_val'] = $varient->width0->displayname;
                $varients[$varient->size][$varient->width][$varient->color]['price'] = $varient->price + $model->price;
                $varients[$varient->size][$varient->width][$varient->color]['quantity'] = $qnt;
                $i++;
            }

            $cart->product_id = $model->id;
            if(!Yii::$app->user->isGuest) {
                $cart->user_id = Yii::$app->user->identity->id;
            }

            return $this->render('product',['model'=>$model,
                'productDropdownValues'=>$ProductDropdownValues,
                'rating'=>$ratin_model,
                'productDescValues'=>$ProductDescValues,
                'productTextValues'=>$ProductTextValues,
                'productImages'=>$ProductImages,
                'dropdownValues'=>$DropdownValues,
                'varientModel'=>$varientModel,
                'cart'=>$cart,
                'varients'=>$varients,
                'wishlist'=>$wishlist,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }
}
