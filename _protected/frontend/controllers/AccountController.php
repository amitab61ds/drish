<?php
namespace frontend\controllers;
use yii\helpers\Url;
use common\models\User;
use common\models\LoginForm;
use common\models\Newsletter;
use common\models\OrderComments;
use common\models\Product;
use common\models\Profile;
use common\models\ShippingAddress;
use common\models\BillingAddress;
use common\models\Orders;
use common\models\Wishlist;
use common\models\Cart;
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
class AccountController extends FrontendController
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

	public function actionNewsletter()
	{	
		$model = new Newsletter;
		if($model->load(Yii::$app->request->post()))
		{
			$model->status = 0;
			$model->save();
			$result = 'success';
			Yii::$app->response->format = trim(Response::FORMAT_JSON);
			return $result;
		}else{
			$error = \yii\widgets\ActiveForm::validate($model);
			Yii::$app->response->format = trim(Response::FORMAT_JSON);
			return $error; 
		}		
 
	}
	public function actionReview()
    {

        // if 'rna' value is 'true', we instantiate SignupForm in 'rna' scenario
        $model =  new Review();

        // collect and validate user data
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
			$data = $model->find()->where(['user_id' => $model->user_id, 'product_id' => $model->product_id ])->one();
			if($data){
				if($data->save()){
					$result = 'success';
					Yii::$app->response->format = trim(Response::FORMAT_JSON);
					return $result;
				}
				// user could not be saved in database
				else
				{
					Yii::$app->response->format = Response::FORMAT_JSON;
					echo json_encode(\yii\widgets\ActiveForm::validate($model));
					Yii::$app->end();
				}
			}else{
				if($model->save()){
					$result = 'success';
					Yii::$app->response->format = trim(Response::FORMAT_JSON);
					return $result;
				}
				// user could not be saved in database
				else
				{
					Yii::$app->response->format = Response::FORMAT_JSON;
					echo json_encode(\yii\widgets\ActiveForm::validate($model));
					Yii::$app->end();
				}
			}
			
        }

        return $this->render('/site/signup', [
            'model' => $model,
        ]);
    }
	public function actionIndex()
    { 
		$this->layout = 'account'; 
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
		
		$userId = \Yii::$app->user->identity->id;
		$profile = Profile::find()->where(['user_id' => $userId])->one();
		$user = User::find()->where(['id' => $userId])->one();
		return $this->render('index',['profile' => $profile, 'user' => $user ]);
    }
	
    public function actionDashboard()
    { 
		return $this->render('dashboard');
    }

    public function actionInformation()
    { 
	
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
		
		$userId = \Yii::$app->user->identity->id;
		$profile = Profile::find()->where(['user_id' => $userId])->one();
		if ($profile->load(Yii::$app->request->post()))
		{	

			if($profile->save()){
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Account Information updated successfully!'));
				return $this->redirect(['account/information']);
			}else{
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($profile);
			}
				
		}	
		return $this->render('information',['profile' => $profile]);
    }

    public function actionBillingAddress()
    { 
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
		$userId = \Yii::$app->user->identity->id;
		$biladd = BillingAddress::find()->where(['user_id' => $userId])->one();
		$this->layout = 'account';
		if ($biladd->load(Yii::$app->request->post()))
		{	

			if($biladd->save()){
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Account Information updated successfully!'));
				return $this->render('address',['model' => $biladd ]);
			}else{
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($biladd);
			}
				
		}else{
			return $this->render('address',['model' => $biladd ]);			
		}

    }
	public function actionShippingAddress()
    { 
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
		$userId = \Yii::$app->user->identity->id;
		$shipadd = ShippingAddress::find()->where(['user_id' => $userId])->one();
		$this->layout = 'account'; 
		if ($shipadd->load(Yii::$app->request->post()))
		{	

			if($shipadd->save()){
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Account Information updated successfully!'));
				return $this->render('address',['model' => $shipadd ]);
			}else{
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($shipadd);
			}
				
		}else{
			return $this->render('address',['model' => $shipadd ]);			
		}
    }

    public function actionNotifications()
    { 
		$this->layout = 'account'; 
		return $this->render('notifications');
    }
	public function actionProductReview()
    { 
		$this->layout = 'account'; 
		return $this->render('product-review');
    }

	public function actionAccountNewsletter()
    { 
		$this->layout = 'account'; 
		return $this->render('newsletter');
    }	
	public function actionMywishlist()
    {  
		$this->layout = 'account'; 
		$model = Wishlist::find()->where(['client_id' => \Yii::$app->user->identity->id])->one();
		return $this->render('mywishlist',[
			'wishlist' => $model,
		]);
    }
	public function beforeAction($action)
	{
		
		$this->layout = 'account'; 
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
		return parent::beforeAction($action);
	}	
	
	public function actionOrders()
    { 
		$this->layout = 'account'; 
		$app_model = new Orders;
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}		
		$model = $app_model->find()->where(['user_id' => \Yii::$app->user->identity->id])->all();
		return $this->render('orders',[
			"model" => $model,
		]);
    }
	public function actionOrder($id)
    {
        $models = Orders::find($id);
        $comments = OrderComments::find()->where(['order_id' => $id])->orderBy([
	           'created_at' => SORT_DESC,
	        ])->all();

        $orderdetail = Orders::getOrderDetail($id);

        return $this->render('order', [
            'orderdetail' => $orderdetail,
            'comments' => $comments,
        ]);
    }
	public function actionReturnRequest($id)
    { 
		$this->layout = 'account'; 
		$app_model = Orders::findOne($id);
		if(Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->homeUrl);	
		}
		$app_model->is_refunded = 3;
		$app_model->refund_request = 1;
		
		if($app_model->save()){
			$model = Orders::find()->where(['user_id' => \Yii::$app->user->identity->id])->all();
			Yii::$app->getSession()->setFlash('success', Yii::t('app', "Refund Request has Been Submitted successfully."));
			return $this->redirect('orders');
		}
		
    }

}
