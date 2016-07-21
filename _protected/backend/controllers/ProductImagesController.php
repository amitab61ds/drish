<?php

namespace backend\controllers;

use Yii;
use common\models\ProductImages;
use common\models\ProductImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use common\traits\ImageUploadTrait;
/**
 * ProductImagesController implements the CRUD actions for ProductImages model.
 */
class ProductImagesController extends Controller
{
	use ImageUploadTrait;
	public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductImages models.
     * @return mixed
     */
    public function actionIndex($product_id=0)
    {
        $searchModel = new ProductImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$product_id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'product_id' => $product_id,
        ]);
    }
	public function actionViewimages($product_id=0)
    {
        $searchModel = new ProductImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$product_id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'product_id' => $product_id,
        ]);
    }

    /**
     * Displays a single ProductImages model.
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
     * Creates a new ProductImages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($product_id=0)
    {
        $model = new ProductImages();
		$model->product_id = $product_id;
		$main_image = UploadedFile::getInstance($model, 'main_image');
		$home_image = UploadedFile::getInstance($model, 'home_image');
		$video = UploadedFile::getInstance($model, 'video');
		$main_image = UploadedFile::getInstance($model, 'main_image');
		$flip_image = UploadedFile::getInstance($model, 'flip_image');
		$flip_image1 = UploadedFile::getInstance($model, 'flip_image1');
		$other_images = UploadedFile::getInstances($model, 'other_image');
        if ($model->load(Yii::$app->request->post())) {
			$size = Yii::$app->params['folders']['size'];
			$folder = array('uploadMain','uploadThumbs','uploadMedium');
			 $model->product_id = $product_id;
			if($main_image)
			{
				$name = time().rand(10,1000);
				$main_folder = "product/main/".$product_id;
				$image_name= $this->uploadImage($main_image,$name,$main_folder,$size,$folder);
				$model->main_image = $image_name;
			}
			if($home_image)
			{
				$name = time().rand(10,1000);
				$main_folder = "product/home/".$product_id;
				$image_name1 = $this->uploadImage($home_image,$name,$main_folder,$size,$folder);
				$model->home_image = $image_name1;
			}
			if($video)
			{
				$name = time().rand(10,1000);
				$main_folder = "product/video/".$product_id;
				$image_name2 = $this->uploadFile($video,$name,$main_folder);
				$model->video = $image_name2;
			}
			if($flip_image)
			{
				$name = time().rand(10,1000);
				$main_folder = "product/flip/".$product_id;
				$image_name3 = $this->uploadImage($flip_image,$name,$main_folder,$size,$folder);
				$model->flip_image = $image_name3;
			}
			if($flip_image1)
			{
				$name = time().rand(10,1000);
				$main_folder = "product/flip1/".$model->product_id;
				$image_name3= $this->uploadImage($flip_image1,$name,$main_folder,$size,$folder);
				$model->flip_image1 = $image_name3;
			}
			//save all other images
			if($other_images)
			{

				$prod_otherimages = array();
				foreach($other_images as $other_image){

					$name = time().rand(10,1000);
					$main_folder = "product/other/".$product_id;
					$image_name4 = $this->uploadImage($other_image,$name,$main_folder,$size,$folder);
					$prod_otherimages[] = $image_name4;
				}
				$model->other_image = serialize($prod_otherimages);
			}
			$model->save();
			Yii::$app->getSession()->setFlash('success', Yii::t('app', "Congratulations! your Images Has been created Succcessfully."));
             return $this->redirect(['viewimages', 'product_id' => $product_id]);
        }else {
            return $this->render('create', [
                'model' => $model,
                'product_id' => $product_id,
            ]);
        }
    }

    /**
     * Updates an existing ProductImages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$product_id=0)
    { 
        $model = $this->findModel($id);
		$model->product_id = $product_id;
		$main_image = UploadedFile::getInstance($model, 'main_image');
		$home_image = UploadedFile::getInstance($model, 'home_image');
		$video = UploadedFile::getInstance($model, 'video');
		$main_image = UploadedFile::getInstance($model, 'main_image');

		$flip_image = UploadedFile::getInstance($model, 'flip_image');
		$flip_image1 = UploadedFile::getInstance($model, 'flip_image1');
		$other_images = UploadedFile::getInstances($model, 'other_image');
        if ($model->load(Yii::$app->request->post())) {
			$data = $model->getData($id);
			$size = Yii::$app->params['folders']['size'];
			/*$folder = array('uploadMain','uploadLarge','uploadThumbs','uploadMedium','custom1','custom2','custom3','custom4'); */
			$folder = array('uploadMain','uploadThumbs','uploadMedium');
			$model->product_id = $product_id;
			//save main image
			if($main_image)
			{
				$name = time().rand(10,1000);
				$main_folder = "product/main/".$model->product_id;
				$image_name= $this->uploadImage($main_image,$name,$main_folder,$size,$folder);
				$model->main_image = $image_name;
			}else{
				$model->main_image = $data->main_image;
			}
			if($home_image)
			{
				$name = time().rand(10,1000);
				$main_folder = "product/home/".$model->product_id;
				$image_name1 = $this->uploadImage($home_image,$name,$main_folder,$size,$folder);
				$model->home_image = $image_name1;
			}else{
				$model->home_image = $data->home_image;
			}
			if($video)
			{
				$name = time().rand(10,1000);
				$main_folder = "product/video/".$model->product_id;
				$image_name2 = $this->uploadFile($video,$name,$main_folder);
				$model->video = $image_name2;
			}else{
				$model->video = $data->video;
			}
			if($flip_image)
			{
				$name = time().rand(10,1000);
				$main_folder = "product/flip/".$model->product_id;
				$image_name3= $this->uploadImage($flip_image,$name,$main_folder,$size,$folder);
				$model->flip_image = $image_name3;
			}else{
				$model->flip_image = $data->flip_image;
			}
			if($flip_image1)
			{
				$name = time().rand(10,1000);
				$main_folder = "product/flip1/".$model->product_id;
				$image_name6= $this->uploadImage($flip_image1,$name,$main_folder,$size,$folder);
				$model->flip_image1 = $image_name6;
			}else{
				$model->flip_image1 = $data->flip_image1;
			}
			//save all other images
			if($other_images)
			{

				$prod_otherimages = array();
				foreach($other_images as $other_image){

					$name = time().rand(10,1000);
					$main_folder = "product/other/".$model->product_id;
					$image_name4= $this->uploadImage($other_image,$name,$main_folder,$size,$folder);
					$prod_otherimages[] = $image_name4;
				}
				$model->other_image = serialize($prod_otherimages);
			}else{
				$model->other_image = $data->other_image;
			}
			$model->save();
			Yii::$app->getSession()->setFlash('success', Yii::t('app', "Congratulations! your Images Has been Updated Succcessfully."));
            return $this->redirect(['viewimages', 'product_id' => $product_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'product_id' => $product_id,
            ]);
        }
    }

    /**
     * Deletes an existing ProductImages model.
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
     * Finds the ProductImages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductImages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductImages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
