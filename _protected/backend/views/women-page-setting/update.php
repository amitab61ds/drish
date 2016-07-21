<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WomenPageSetting */
if($model->id == 2){
	$this->title = 'Men Page Setting: ';
	$this->params['breadcrumbs'][] = ['label' => 'Men Page Listing', 'url' => ['update?id=2']];
	$this->params['breadcrumbs'][] = 'Update';	
}else{
$this->title = 'Women Page Setting: ';
$this->params['breadcrumbs'][] = ['label' => 'Women Page Listing', 'url' => ['update?id=1']];
$this->params['breadcrumbs'][] = 'Update';	
}

?>
<div class="pages-index">
	<div class="row">
        <div class="col-md-12">
			<div class="box">
                <div class="box-body table-responsive">
					<?= $this->render('_form', [
						'model' => $model,
					]) ?>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row --> 
</div>


