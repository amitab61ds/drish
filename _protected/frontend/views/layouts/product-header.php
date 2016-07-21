<?php
use frontend\widgets\HomeMenuMain;
use frontend\widgets\Search;
use frontend\widgets\CartProductCounter;
use yii\helpers\Url;
?>
   <div class="free-shipping"> 
   <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-5 pad-right">
                <div class="header">
                <a href="<?= Url::to(['site/index']) ?>" class="header-logo"><img src="<?= Yii::$app->params['baseurl'] ?>/images/drish-logo.png" alt="Drish" title="Drish"></a>
                    <a href="#menu" class="menu-bar"> <i class="fa fa-bars"></i></a>
                    <span class="menu-text">Menu</span>
                </div>
                <nav id="menu">
                    <?= HomeMenuMain::widget() ?>
                </nav>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-7 pad-left">
           		 <div class="cart-top-header nav-480">
                        <div class="top-link login-icon mob-cart">
                            <ul>
                            	<li class="s-icon"><a><img src="<?= Yii::$app->params['baseurl'] ?>/images/search-icon.png"></a></li>
                                <li class="user-icon">
                                	<?php 
									if(!Yii::$app->user->isGuest){ ?>
										<a href="<?= Url::to(['account/index']) ?>" title="login">
											<i class="glyph-icon flaticon-social-1"></i>
											<span class="login-text">Account</span>
										</a>
								<?php }else{ ?>
										<a href="<?= Url::to(['site/login']) ?>" title="login">
											<i class="glyph-icon flaticon-social-1"></i>
											<span class="login-text">Login</span>
										</a>
								<?php } ?>
                               </li>
                             <li>
                                  <a href="#"  title="Wishlist"> 
								  <div class="heart-area">
								<span class="cart-count">2</span> <i class="fa fa-heart-o"></i>
                                     </div> <span class="login-text">Wishlist</span> </a>
                                 
                                 </li>
                                <li class="cart-icon" title="cart" >
                               <div class="cart-box"><a href="<?= Url::to(['cart/cart']) ?>"> <span class="cart-count"><?= CartProductCounter::widget() ?></span>
							<i class="glyph-icon flaticon-cart"></i><span class="login-text">My Cart</span></a></div> 
                                </li>
                            </ul>
                        </div><!--end top-icon-->
                        <!--end top-icon-->
                        </div>
            </div>  
                      
            <div class="nav-none">
            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-5 nav-full">
            <div class="women-nav">
                        <div class="product_type">
                           <ul>
							  <li <?php if(Yii::$app->controller->id == 'men' && Yii::$app->controller->action->id == 'index'){ echo'style="display:none;"'; }  ?>><a href="<?= Url::to(['men/index']) ?>">Men</a></li>
							  <li>|</li>
							 <li <?php if(Yii::$app->controller->id == 'women' && Yii::$app->controller->action->id == 'index'){ echo'style="display:none;"'; }  ?>><a href="<?= Url::to(['women/index']) ?>">Women</a></li>
							  <li>|</li>
							  <li <?php if(Yii::$app->controller->id == 'children' && Yii::$app->controller->action->id == 'index'){ echo'style="display:none;"'; }  ?>><a href="<?= Url::to(['children/index']) ?>">Kids</a></li>
						   </ul>

                        </div><!--end product type-->
                    </div>
            	<div class="serach-area">
				 <?= Search::widget(['type'=>'second']) ?>
				</div>              
                 	<div class="cart-top-header">
                          <div class="top-link login-icon mob-cart">
                            <ul>
                            	<li class="s-icon"><a><img src="<?= Yii::$app->params['baseurl'] ?>/images/search-icon.png"></a></li>
                                <li class="user-icon">
                                	<a href="<?= Url::to(['site/login']) ?>" title="login">
                                        <i class="glyph-icon flaticon-social-1"></i>
                                        <span class="login-text">Login</span>
                                    </a>
                               </li>
                             <li>
                                  <a href="#"  title="Wishlist"> 
								  <div class="heart-area">
								<span class="cart-count">2</span> <i class="fa fa-heart-o"></i>
                                     </div> <span class="login-text">Wishlist</span> </a>
                                 
                                 </li>
                                <li class="cart-icon" title="cart" >
                               <div class="cart-box"><a href="<?= Url::to(['cart/cart']) ?>"> <span class="cart-count"><?= CartProductCounter::widget() ?></span>
							<i class="glyph-icon flaticon-cart"></i><span class="login-text">My Cart</span></a></div> 
                                </li>
                            </ul>
                        </div><!--end top-icon-->
                        <!--end top-icon-->
                        </div>
            </div>
            </div>
            
            <div class="pop-search">
            	<div class="serach-area">
            		<div class="search-right">   <input type="search" placeholder="Search" class="search-txt"></div>
             </div> 
            </div>
            
            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-5 nav-full">
            <div class="menu-header mob-header <?php if(!Yii::$app->user->isGuest){ echo'logged'; }?>">
                   	<div class="women-nav">
                        <div class="product_type">
                         <ul>
							 <li <?php if(Yii::$app->controller->id == 'men'){ echo'style="display:none;"'; }  ?>><a href="<?= Url::to([	'men/index']) ?>">Men</a></li>
								<li <?php if(Yii::$app->controller->id == 'men'){ echo'style="display:none;"'; }  ?>>|</li>
								<li <?php if(Yii::$app->controller->id == 'women'){ echo'style="display:none;"'; }  ?>><a href="<?= Url::to(['women/index']) ?>">Women</a></li>
								<li <?php if(Yii::$app->controller->id == 'women' || Yii::$app->controller->id == 'children'){ echo'style="display:none;"'; }  ?>>|</li>
								<li <?php if(Yii::$app->controller->id == 'children'){ echo'style="display:none;"'; }  ?>><a href="<?= Url::to(['children/index']) ?>">Children</a></li>
						   </ul>
                        </div><!--end product type-->
                    </div> 
            <div class="collections">
			<a href="#" class="view-collection">
                  <span class="view-col">View collections</span><span class="shop-bag"><img src="<?= Yii::$app->params['baseurl'] ?>/images/bag_icon.png"> </span></a></div>
				  <?php if(Yii::$app->user->isGuest){ ?>
              		<div class="foot-socials header-social">
                        <ul>
                                 <li><a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/images/Sign-in-with-Facebook.png"></a></li>
                                 <li><a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/images/Sign-in-with-Gmail.png"></a></li>  
                                  <li><a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/images/signin-btn.png"></a></li>
                        </ul>
                        
                    </div> 
                    <div class="foot-socials mob-social">
                        <ul>
                                 <li><a href="#"><i aria-hidden="true" class="fa fa-facebook"></i></a></li>
                                 <li><a href="#"><i aria-hidden="true" class="fa fa-google-plus"></i></a></li>
                                 <li><a href="#"><i aria-hidden="true" class="fa fa-instagram"></i></a></li>  
                        </ul>
                    </div>  
				  <?php } ?>
                	<div class="serach-area">
						  <?= Search::widget(['type'=>'second']) ?>
					</div>              
                 	<div class="cart-top-header">
                          <div class="top-link login-icon mob-cart">
                           <ul>
                            	<li class="s-icon"><a><img src="<?= Yii::$app->params['baseurl'] ?>/images/search-icon.png"></a></li>
                                <li class="user-icon">
                                	<a href="<?= Url::to(['site/login']) ?>" title="login">
                                        <i class="glyph-icon flaticon-social-1"></i>
                                        <span class="login-text">Login</span>
                                    </a>
                               </li>
                             <li>
                                  <a href="#"  title="Wishlist"> 
								  <div class="heart-area">
								<span class="cart-count">2</span> <i class="fa fa-heart-o"></i>
                                     </div> <span class="login-text">Wishlist</span> </a>
                                 
                                 </li>
                                <li class="cart-icon" title="cart" >
                               <div class="cart-box"><a href="<?= Url::to(['cart/cart']) ?>"> <span class="cart-count"><?= CartProductCounter::widget() ?></span>
							<i class="glyph-icon flaticon-cart"></i><span class="login-text">My Cart</span></a></div> 
                                </li>
                            </ul>
                        </div><!--end top-icon-->
                        <!--end top-icon-->
                        </div>           
                   </div> 
                   </div>         
            <!--end col-lg-1-->               
            </div>
    </div><!--end container-fluid-->
    </div>
 <!-- menu-end-->