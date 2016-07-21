<?php

namespace frontend\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use common\models\Wishlist;
use yii\filters\VerbFilter;
use common\models\WishlistSearch;
use yii\web\NotFoundHttpException;
use common\models\Product;

/**
 * WishlistController implements the CRUD actions for Wishlist model.
 */
class WishlistController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Wishlist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WishlistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Wishlist model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Wishlist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Wishlist();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->client_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	public function actionRemove($id)
    {
		if(Yii::$app->user->isGuest){
			return $this->redirect("/site/index"); 
			}else{
			$client_id = Yii::$app->user->identity->id;
			if (($model = Wishlist::findOne(['client_id'=> $client_id])) !== null) {
				$product = UniversityCourses::find()->where(['id'=>$id])->one();
				$products = unserialize($model->products);
				if(!in_array($product->id, $products)){
					$result = "This course is not present in your wishlist";
					$label = "Add to Wishlist";
					$enabled = "true";
					$success = false;
					return $this->redirect("/site/index");
				} else {
					
					if(($key = array_search($product->id, $products)) !== false) {
						unset($products[$key]);
						}
						$model->products = serialize($products);
						$model->save();
						Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Course has been removed from your Wishlist!'));
						return $this->redirect("/account/mywishlist"); 
				}
			}
		}
	}
	public function actionAdd()
    {
       $request = Yii::$app->request;
       if ($request->isAjax) {
			$id = Yii::$app->request->post('pid');
			$product = Product::find()->where(['id'=>$id])->one();
			$type = Yii::$app->request->post('isadded');
			if(Yii::$app->user->isGuest){
			$result = "Please login/register to create wishlist";
			$label = "Add to Wishlist";
			$enabled = "true";
			Yii::$app->response->format = Response::FORMAT_JSON;	
			return [
				'result'=>$result,
				'label'=>$label,
				'enabled'=>$enabled,
				'success'=>false,
			];
			}else{
			$client_id = Yii::$app->user->identity->id;
			if($type=="true"){
				if (($model = Wishlist::findOne(['client_id' => $client_id])) !== null) {
					$products = unserialize($model->products);
					if (!in_array($product->id, $products)) {
						$products[] = $product->id;
						$result = "Product is added to your wishlist";
						$label = "Remove from Wishlist";
						$enabled = "false";
						$success = true;
					} else {
						$result = "This Product is already added to your wishlist";
						$label = "Remove from Wishlist";
						$enabled = "false";
						$success = false;
					}
					sort($products);
					$model->products = serialize($products);
					
				} else {
					$model = new Wishlist();
					$model->client_id = $client_id;
					$model->products = serialize(array($product->id));
					$result = "Course is added to your wishlist";
					$label = "Remove from Wishlist";
					$enabled = "false";
					$success = true;
				}
				$model->save();
				if($success==true){
					$count = Wishlist::getCoursesCount($client_id);
				} else {
					$count = array("","");
				}
				Yii::$app->response->format = Response::FORMAT_JSON;	
				return [
					'result'=>$result,
					'label'=>$label,
					'enabled'=>$enabled,
					'counts'=>$count,
					'success'=>true,
				];
			} else {
				if (($model = Wishlist::findOne(['client_id'=> $client_id])) !== null) {
					
					$products = unserialize($model->products);
					
					if(!in_array($product->id, $products)){
						
						$result = "This Product is not present in your wishlist";
						$label = "Add to Wishlist";
						$enabled = "true";
						$success = false;
					} else {
						if(($key = array_search($product->id, $products)) !== false) {
							unset($products[$key]);
							}
						$result = "This Product is removed from your wishlist";
						$label = "Add to Wishlist";
						$enabled = "true";
						$success = true;
					}				
					$model->products = serialize($products);
					$model->save();
					if($success==true){
						$count = Wishlist::getCoursesCount($client_id);
					} else {
						$count = array("","");
					}
					
				} else {
					$result = "This Product is not present in your wishlist";
					$label = "Add to Wishlist";
					$enabled = "true";
					$success = false;
				}
				
				Yii::$app->response->format = Response::FORMAT_JSON;	
				return [
					'result'=>$result,
					'label'=>$label,
					'enabled'=>$enabled,
					'counts'=>$count,
					'success'=>$success,
				];
			}
			}
		}
    }

    /**
     * Updates an existing Wishlist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->client_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Wishlist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Wishlist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wishlist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wishlist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
