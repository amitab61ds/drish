<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductImagesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-images-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'main_image') ?>

    <?= $form->field($model, 'flip_image') ?>

    <?= $form->field($model, 'video') ?>

    <?php // echo $form->field($model, 'home_image') ?>

    <?php // echo $form->field($model, 'other_image') ?>

    <?php // echo $form->field($model, 'flip_image1') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'default') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
