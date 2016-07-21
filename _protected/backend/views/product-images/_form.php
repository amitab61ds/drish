<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\slider\Slider;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\ProductImages */
/* @var $form yii\widgets\ActiveForm */
	if($model->main_image){
	   $main_image = Yii::$app->params['baseurl'] . '/uploads/product/main/'.$model->product_id.'/thumbs/'.$model->main_image;
   }else{
	   $main_image = Yii::$app->params['baseurl'] . '/uploads/no-image.png';
   }
   if($model->flip_image){
	   $main_image1 =Yii::$app->params['baseurl'] . '/uploads/product/flip/'.$model->product_id.'/thumbs/'.$model->flip_image;
   }else{
	   $main_image1 = Yii::$app->params['baseurl'] . '/uploads/no-image.png';
   }
   if($model->flip_image1){
	   $main_imagef1 =Yii::$app->params['baseurl'] . '/uploads/product/flip1/'.$model->product_id.'/thumbs/'.$model->flip_image1;
   }else{
	   $main_imagef1 = Yii::$app->params['baseurl'] . '/uploads/no-image.png';
   }
   if($model->home_image){
	   $main_image2 = Yii::$app->params['baseurl'] . '/uploads/product/home/'.$model->product_id.'/thumbs/'.$model->home_image;
   }else{
	   $main_image2 = Yii::$app->params['baseurl'] . '/uploads/no-image.png';
   }
   if($model->video){
	   $main_image3e = Yii::$app->params['baseurl'] . '/uploads/product/video/'.$model->product_id.'/'.$model->video;
	   $img_url = '<div class="vid"><video  autoplay="" loop="" controls style="max-width:300px;max-height:200px;"><source src="'.$main_image3e.'" type="video/mp4">Your browser does not support the video tag.</video></div>';
   }else{
	  $img_url = '<img src="'.Yii::$app->params['baseurl'].'/uploads/no-video.jpg" style="width:200px;height:150px;">';
   }

?>

<div class="product-images-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
		<?= $form->field($model, 'color')->dropDownList(
				$model->Color,
				[
					'prompt'=>'- Select Color -',
					'class'=>'form-control select2',
				]
			);?>
			<div class="row">
				<div class="col-md-6">
					<div class="img-box1">
					   <h4 class="head4-borderd">Main image:</h4>
					   <?= $form->field($model, 'main_image')->widget(FileInput::classname(),
						  [
							  'options' => ['accept' => 'image/*'],
							  'pluginOptions' => [
								  'showCaption' => false,
								  'showRemove' => false,
								  'showUpload' => false,
								  'initialPreview'=>[
									  Html::img($main_image, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
								  ],
							  ]
						  ])->label(false);
						  ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="img-box1">
					   <h4 class="head4-borderd">Flip image:</h4>
					   <?= $form->field($model, 'flip_image')->widget(FileInput::classname(),
						  [
							  'options' => ['accept' => 'image/*'],
							  'pluginOptions' => [
								  'showCaption' => false,
								  'showRemove' => false,
								  'showUpload' => false,
								  'initialPreview'=>[
									  Html::img($main_image1, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
								  ],
							  ]
						  ])->label(false);
						  ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="img-box1">
					   <h4 class="head4-borderd">Flip image One:</h4>
					   <?= $form->field($model, 'flip_image1')->widget(FileInput::classname(),
						  [
							  'options' => ['accept' => 'image/*'],
							  'pluginOptions' => [
								  'showCaption' => false,
								  'showRemove' => false,
								  'showUpload' => false,
								  'initialPreview'=>[
									  Html::img($main_imagef1, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
								  ],
							  ]
						  ])->label(false);
						  ?>
					</div>
				</div>
				 <div class="col-md-6">
					  <div class="img-box1">
						  <h4 class="head4-borderd">Home image:</h4>
						  <?= $form->field($model, 'home_image')->widget(FileInput::classname(),
							  [
								  'options' => ['accept' => 'image/*'],
								  'pluginOptions' => [
									  'showCaption' => false,
									  'showRemove' => false,
									  'showUpload' => false,
									  'initialPreview'=>[
										  Html::img($main_image2, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
									  ],
								  ]
							  ])->label(false);
						  ?>
					  </div>
				</div>
			</div>
			<!--div class="row">
				 <div class="col-md-12">
					  <h4 class="head4-borderd">Featured video:</h4>
					  <div class="form-group field-course-name">
						<div class="image_div">
							<!--?= $img_url  ?-->
						<!--/div>

					<?php  // Usage with ActiveForm and model
					/* echo $form->field($model, 'video')->widget(FileInput::classname(),
						  [
							  'options' => ['accept' => 'video/*'],
							  'pluginOptions' => [
								  'showCaption' => false,
								  'showRemove' => false,
								  'showUpload' => false,
							  ]
						  ])->label(false); */
					  ?>
					</div>
					  
				 </div>
			</div-->
			<div class="row">
				<div class="col-md-12">
					<h4 class="head4-borderd">Please upload here all other images:</h4>
					<div class="image_div">
					<?php
					$images = unserialize($model->other_image);
					if($images){
							 echo "<div class='file-updat'><ul>";
							foreach($images as $images)
							{
								echo "<li class='file-preview-frame' >";
								echo"<img src='". Yii::$app->params['baseurl']."/uploads/product/other/".$model->product_id."/thumbs/".$images ."' class='file-preview-image' style='width:auto;height:160px;' >";
								//$image[] = \Yii::$app->request->baseUrl."/".$images->image_path;
								echo "</li>";
							}
							echo "</ul></div><div class='clearfix'></div>";
						
						 echo $form->field($model, 'other_image[]')->widget(FileInput::classname(),
						   [
							   'options' => ['accept' => 'image/*','multiple' => true],
							   'pluginOptions' => [
								   'showCaption' => false,
								   'showRemove' => false,
								   'showUpload' => false,
							   ]
						   ])->label(false);
					  
				  }else{
							$main_imager = Yii::$app->params['baseurl'].'/uploads/no-image.png';
							echo $form->field($model, 'other_image[]')->widget(FileInput::classname(),
							[
							   'options' => ['accept' => 'image/*','multiple' => true],
							   'pluginOptions' => [
								   'showCaption' => false,
								   'showRemove' => false,
								   'showUpload' => false,
								   'initialPreview'=>[
									   Html::img($main_imager, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
								   ],
							   ]
							])->label(false);
						}
					?>
						</div>
					<?php
					   // Usage with ActiveForm and model
					  
					   ?>
				</div>
			  </div>
	<?= $form->field($model, 'default')->dropDownList(['0' => 'UnActive','1' => 'Active']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
