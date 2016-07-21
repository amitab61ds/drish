
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$user_id = \Yii::$app->user->identity->id;
?>

<!-- account dashboard -->
     <section class="dashboard-user">
       <div class="container-fluid craftsmanship-area">
         <div class="user-dashboard">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard-list">
                <h4>Account</h4>
                    <ul class="acc-dash">
						<li><a href="<?= Url::to(['account/index']) ?>" >Account Dashboard</a></li>
						<li><a href="<?= Url::to(['account/orders']) ?>" class='active'>Orders Detail</a></li>
						<li><a href="<?= Url::to(['account/mywishlist']) ?>" >My Wishlist</a></li>
					</ul>
                </div>
            </div>
                </div>
            </div>
            <!-- end of left part of account list-->
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                 <div class="account-detail record-pro">
                    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hello-user">
                            <h4>Order History</h4>
                            <p>Here are the orders you have placed since the creation of your account.</p>
                            </div>
                            <div class="order-history">
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Order</th>
                                    <th>Date</th>
                                    <th>Total Price</th>
                                    <th>Order</th>
                                    <th>Status</th>
									<th>Refund/Return</th>
                                    <th>Details</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
								<?php if($model){
										$i=1;
										foreach($model as $models){
										?>
										<tr>
											<td>#<?= $models->id ?></td>
											<td><?= Yii::$app->formatter->asDate( $models->created_at,'php:d/m/Y');?></td>
											<td><?= $models->price_total ?></td>
											<td> Cash On Delivery (COD)</td>
											<td> 
											 <?php if($models->status == 1){ echo'Complete' ; } ?>
											 <?php if($models->status == 2){ echo'Closed' ; } ?>
											 <?php if($models->status == 3){ echo'Pending' ; } ?>
											 <?php if($models->status == 4){ echo'Processed' ; } ?>
											 <?php if($models->status == 5){ echo'Partially Shipped' ; } ?>
											 <?php if($models->status == 6){ echo'Shipping' ; } ?>
											 <?php if($models->status == 7){ echo'Shipped' ; } ?>
											 <?php if($models->status == 8){ echo'Partially Returned' ; } ?>
											 <?php if($models->status == 9){ echo'Returned' ; } ?>
											 <?php if($models->status == 10){ echo'Canceled' ; } ?>
												
											</td>
											<td>
											<?php if(Yii::$app->params['settings']['refund_day'] <= 14 ){
											if ($models->is_refunded == 3) {
												echo  "<b>Refund In Progress</b>";
											} else if ($models->is_refunded == 1) {
												echo "<b>Refunded</b>";
											} else if ($models->is_refunded == 0) { ?>
												<a href="<?= Url::to(['account/return-request','id' => $models->id]) ?>">Request For Refund</a>
											<?php	} else {
												echo "<b>No Refund Applicable</b>";
											}
											?>
											<?php }else{ ?>
											Refund/Return Not Applicable
											<?php } ?>
											</td>
											<td> <a href="<?= Url::to(['account/order','id' => $models->id]) ?>">Details</a></td>
										</tr>
									<?php $i++; }
									}else{ ?>
										<tr>
											<td colspan='7'><h4> No applications submitted by you.</h4></td>
										</tr>
								   <?php } ?>
                                 
                                </tbody>
                            </table>
                            </div>
                            </div>
                    </div>
                </div>
                    
            </div>
            </div>
            <!-- end of right part of account detail-->
        </div>
    </div>
       </div>
     </section>
<!-- account dashboard end -->




            
			