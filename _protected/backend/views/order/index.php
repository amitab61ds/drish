<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <p class="pull-right">
                        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <?php Pjax::begin(); ?>    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn',"header"=>"Sr.No."],
                                [
                                    'label' => 'User Name',
                                    'attribute' => 'user_id',
                                    'value' => function ($model) {
                                        if ($model->user_id) {
                                            return $model->user->profiles->fname.' '.$model->user->profiles->lname;
                                        } else {
                                            return 'Not user';
                                        }
                                    },
                                    'contentOptions' => ['style' => 'width:160px;text-align:center'],
                                    'format' => 'raw',
                                ],
                                [
                                    'label' => 'Guest Name',
                                    'attribute' => 'guest_id',
                                    'value' => function ($model) {
                                        if ($model->guest_id) {
                                            return $model->guest->fname.' '.$model->guest->lname;
                                        } else {
                                            return 'Not Guest';
                                        }
                                    },
                                    'contentOptions' => ['style' => 'width:160px;text-align:center'],
                                    'format' => 'raw',
                                ],
                                'items_count',
                                //'price_total',
                                 'delivery_charges',
                                 'discount',
                                // 'discount_id',
                                 'grand_total',
                                // 'locked',
                                [
                                    'attribute' => 'payment_method',
                                    'value' => function ($model) {
                                        $status =  $model->getPayments();
                                        return $status[$model->payment_method];
                                    },
                                    'contentOptions' => ['style' => 'width:160px;text-align:center'],
                                    'format' => 'raw',
                                    'filter'=> $order->getPayments(),
                                ],
                                [
                                    'attribute' => 'payment_status',
                                    'value' => function ($model) {
                                        if ($model->payment_status) {
                                            return "Paid";
                                        } else {
                                            return "Pending";
                                        }
                                    },
                                    'contentOptions' => ['style' => 'width:160px;text-align:center'],
                                    'format' => 'raw',
                                    'filter'=>array("0"=>"Pending","1"=>"Paid"),
                                ],
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        $status =  $model->getOrderStatus();
                                         return $status[$model->status];
                                    },
                                    'contentOptions' => ['style' => 'width:160px;text-align:center'],
                                    'format' => 'raw',
                                    'filter'=> $order->getOrderStatus(),
                                ],

                                 'created_at:Date',
                                // 'updated_at',

                                ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
                                    'buttons' => [
                                        'vieworder' =>function ($url, $model, $key) {
                                            $options = array_merge([
                                                'title' => Yii::t('yii', 'View Order'),
                                                'aria-label' => Yii::t('yii', 'View Order'),
                                                'data-pjax' => '0',
                                            ], []);
                                            return Html::a('<span class="glyphicon glyphicon-folder-open"></span>', ['order/summary','id'=>$model->id], $options);
                                        },

                                    ],
                                    'template' => '{vieworder}', 'contentOptions' => ['style' => 'text-align:center'],
                                ],
                            ],
                        ]); ?>
                    <?php Pjax::end(); ?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>


