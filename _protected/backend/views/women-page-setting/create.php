<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WomenPageSetting */

$this->title = 'Create Women Page Setting';
$this->params['breadcrumbs'][] = ['label' => 'Women Page Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="women-page-setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
