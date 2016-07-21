<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">

				   <p class="pull-right">
        <?= Html::a('Add Product Images', ['create','product_id' => $product_id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header'=>'Sr.No.'],

			[
				'attribute' => 'color',
				'format' => 'html',
				'value' => function ($model) {
					return $model->getColorName($model->color);
				},
				'contentOptions' => ['style' => 'width:200px;height:100px;text-align:left;vertical-align: middle;'],
			],
			[
				'attribute' => 'main_image',
				'format' => 'html',
				'value' => function ($model) {
					return Html::img( Yii::$app->params['baseurl'] . '/uploads/product/main/'.$model->product_id.'/thumbs/'.$model->main_image,
						['width' => '80px']);
				},
				'contentOptions' => ['style' => 'width:200px;height:100px;text-align:left;vertical-align: middle;'],
			],
			[
				'attribute' => 'home_image',
				'format' => 'html',
				'value' => function ($model) {
					return Html::img( Yii::$app->params['baseurl'] . '/uploads/product/home/'.$model->product_id.'/thumbs/'.$model->home_image,
						['width' => '80px']);
				},
				'contentOptions' => ['style' => 'width:200px;height:100px;text-align:left;vertical-align: middle;'],
			],
			[
				'attribute' => 'flip_image',
				'format' => 'html',
				'value' => function ($model) {
					return Html::img( Yii::$app->params['baseurl'] . '/uploads/product/flip/'.$model->product_id.'/thumbs/'.$model->flip_image,
						['width' => '80px']);
				},
				'contentOptions' => ['style' => 'width:200px;height:100px;text-align:left;vertical-align: middle;'],
			],
			[
				'attribute' => 'status',
				'value' => function ($model) {
					if ($model->status) {
						return Html::a(Yii::t('app', 'Active'), null, [
							'class' => 'btn btn-success status',
							'data-id' => $model->id,
							'href' => 'javascript:void(0);',
						]);
					} else {
						return Html::a(Yii::t('app', 'Inactive'), null, [
							'class' => 'btn btn-danger status',
							'data-id' => $model->id,
							'href' => 'javascript:void(0);',
						]);
					}
				},
				'contentOptions' => ['style' => 'width:160px;text-align:center'],
				'format' => 'raw',
				'filter'=>array("1"=>"Active","0"=>"Inactive"),
			],
            // 'home_image',
            // 'other_image:ntext',
            // 'flip_image1',
            // 'color',
            // 'default',

             ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
				'buttons' => [
					'update' =>function ($url, $model, $key) {
					$options = array_merge([
					'title' => Yii::t('yii', 'Update Image'),
					'aria-label' => Yii::t('yii', 'Update Image'),
					'data-pjax' => '0',
					], []);
					return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['product-images/update','id'=> $model->id , 'product_id'=> $model->product_id], $options);
					},
					 'viewitems' =>function ($url, $model, $key) {
						$options = array_merge([
							'title' => Yii::t('yii', 'View Items'),
							'aria-label' => Yii::t('yii', 'View Items'),
							'data-pjax' => '0',
						], []);
						return Html::a('<span class="glyphicon glyphicon-folder-open"></span>', ['varient-product/color-index','id'=>$model->product_id , 'color' => $model->color], $options);
					},
				],
				'template' => '{update}{viewitems} ', 'contentOptions' => ['style' => 'width:160px;text-align:center'],
				 'contentOptions' => ['style' => 'text-left:center;margin-left:10px;vertical-align: middle;letter-spacing:10px;'],
			 ],
        ],
    ]); ?>

				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div>
