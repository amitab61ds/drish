 <?php 
use frontend\widgets\Newsletters; 
?>
 <!-- design slider end-->
            <div class="social-section">
               <div class="row">
                  <div class="col-lg-3 col-sm-6 col-md-6">
				  	<?= Newsletters::widget() ?>
                     <!--end news-section-->
                  </div>
                  <!--end col-lg-5-->
                  <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                     <div class="facbook-post">   <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FDrish%2F813375862112493&amp;width=454&amp;height=298&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=true&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height: 298px;width: 454px;" allowTransparency="true"></iframe></div>
                  </div>
                  <!--end col-lg-2-->
					<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
						<div class="insta">
							<?= Yii::$app->params['settings']['insta_feed'] ?>
						</div>
					</div>
                  <!--end col-lg-2-->
                  <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                     <div class="winter-area">  <img class="img-responsive" alt="winter-area" src="<?= Yii::$app->params['baseurl'] ?>/images/winter-area-2.jpg"></div>
                  </div>
                  <!--end col-lg-3-->
               </div>
               <!--end row-->
            </div>
            <!-- newsletter end-->