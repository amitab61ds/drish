
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

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
                    <li><a href="<?= Url::to(['account/index']) ?>" class="active">Account Dashboard</a></li>
                    <li><a href="<?= Url::to(['account/orders']) ?>">Orders Detail</a></li>
                    <li><a href="<?= Url::to(['account/mywishlist']) ?>">My Wishlist</a></li>
                </ul>
            </div>
        </div>
            </div>
        </div>
        <!-- end of left part of account list-->
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
       		 <div class="account-detail">
        		<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="hello-user">
							<h4>Hello, <?= $profile->fname?> <?= $profile->lname?> !</h4>
							<p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
							</div>
					</div>
				</div>
        		<div class="account-info">
            	<div class="row">
                	<div class="col-lg-12">
                    	<h3>Account Information</h3>
                        <div class="info-edit">
                            <h5>Contact Information <span><a href="<?= Url::to(['account/information']) ?>">Edit</a></span> </h5>
                            <p><?= $profile->fname?> <?= $profile->lname?></p>
                            <p><?= $user->email ?></p>
                            <p>Change Password</p>
              			</div>
                        <div class="info-edit">
                            <h5>Newsletters <span><a href="#">Edit</a></span> </h5>
                            <p>You are currently subscribed to 'General Subscription'. </p>
              			</div>
                        <div class="address-book">
                          <h5>Address Book <a href="#" class="manage-address">Manage Addresses</a></h5>
                         	 <div class="default-address">
                          	<p>Default Billing Address <span><a href="<?= Url::to(['account/billing-address']) ?>">EDIT ADDRESS</a></span></p>
                            <div class="billing-not">You have not set a default billing address.</div>
                          </div>
                             <div class="default-address">
                                <p>Default Shipping Address <span><a href="<?= Url::to(['account/shipping-address']) ?>">EDIT ADDRESS</a></span></p>
                                <div class="billing-not">You have not set a default billing address.</div>
                              </div>
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
