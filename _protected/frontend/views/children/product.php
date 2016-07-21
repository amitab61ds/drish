<?php
use frontend\widgets\RelatedProducts;
use frontend\widgets\SpecialProducts;
use frontend\widgets\CartForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

//echo"<prE>";print_r($model);die;
$this->registerJs("var product_price = ".json_encode($model->price)."; var varients = ".json_encode($varients).";", View::POS_END);

?>

<section class="product-area-outer">
    <div class="gry-bg">
        <div class="container-fluid cate-pad">

            <div class="row">
                <div class="col-ld-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="bredcrumb-nav">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="#">Adults</a></li>
                                    <li class="active"><a href="#">Men's Shoes</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 slider-bg">

                            <div id="example3" class="slider-pro">
                                <div class="sp-slides">
                                   <?php foreach($productImages as $otherimages){
                                       $images = unserialize($otherimages->other_image);
                                       foreach($images as $image){
                                           $urllarge = Yii::$app->params['baseurl'].'/uploads/product/other/'.$model->id.'/main/'.$image;
                                           $urlmed = Yii::$app->params['baseurl'].'/uploads/product/other/'.$model->id.'/large/'.$image;
                                           echo '<div class="sp-slide">';?>
                                           <img class="sp-image center-block" src="<?= $urlmed ?>
                                                data-src="<?= $urlmed ?>"
                                                data-small="<?= $urlmed ?>"
                                                data-medium="<?= $urlmed?>"
                                                data-large="<?=  $urllarge ?>"
                                                data-retina="<?=  $urllarge ?>"/>

                                           <?php echo"</div>";
                                       }

                                    } ?>
                                </div>

                                <div class="sp-thumbnails pro-thumb">
                                    <?php foreach($productImages as $otherimages){
                                        $images = unserialize($otherimages->other_image);
                                        foreach($images as $image){
                                            $urlthumb = Yii::$app->params['baseurl'].'/uploads/product/other/'.$model->id.'/thumbs/'.$image;
                                            ?>
                                            <img class="sp-thumbnail img-video" src="<?= $urlthumb ?>" >
                                            <?php
                                        }

                                    } ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end of slider thumbnail-->

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 bown-bg">
                    <div class="supper-soft">
                        <h3><?= $model->name ?></h3>
                        <h4 class="red-color"><i class="fa fa-inr"></i><?= $model->price ?></h4>
                        <div class="border-gry">
                            <?= html_entity_decode($model->descr) ?>
                        </div>

                        <div class="rating-area">
                            <div class="rating"> <span>Rating :</span>
                                 <ul>
								<?php 
								for($i=1;$i<=$rating->rating;$i++){
								 echo '<li><i class="fa fa-star"></i></li>';
								}
								$count = 5-$rating->rating;
								for($i=1;$i<=$count;$i++){
								 echo '<li><i class="fa fa-star-o"></i></li>';
								}
								?>
                                </ul>



                            </div>

                            <?= CartForm::widget(['model'=>$model,'varientModel'=>$varientModel,'cart'=>$cart]) ?>
                            <div class="share-with">

                                <p> Share with:</p>
                                <div class="foot-socials">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                        <li><a href="#" ><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div><!--end foot-social-->
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <div class="container-fluid cate-pad">
        <div class="prdoct-area">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="review-nav nav nav-tabs">
                        <ul>
                            <li class="active"><a href="#home" data-toggle="tab" aria-expanded="false">Product Details </a></li>
                            <li><a href="#menu1" data-toggle="tab" aria-expanded="true">Reviews (0)</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="home">
                            <div class="p-detail">
                            <?php
                            foreach($productDescValues as $descvalue){

                                echo'<p>'.$descvalue->attr->display_name.':</p><p>'.strip_tags($descvalue->value,"<b>").'</p>';
                            }
                            foreach($productTextValues as $textvalue){
                                echo'<p>'.$textvalue->attr->display_name.':</p><p>'.strip_tags($textvalue->value,"<b>").'</p>';
                            }
                            foreach($productDropdownValues as $dropvalue){
                                $getvalue = $dropdownValues->findOne($dropvalue->value_id);
                                echo'<p>'.$getvalue->attr->display_name.':</p><p>'.strip_tags($getvalue->name,"<b>").'</p>';
                            }
                            ?>


                                </div>
                        </div>

                        <div class="tab-pane fade" id="menu1">
                            <div class="review-form">
                                <h4>You're reviewing: <span>Casual Suede Toddler Sneakers</span></h4>
                                <h6>How do you rate this product? <em class="required">*</em></h6>
                                <table class="data-table col-md-12 table table-striped" id="product-review-table">

                                    <tbody>
                                    <tr class="first last odd">
                                        <th data-title=" star">Quality</th>
                                        <td class="value" data-title="1 star"><input type="radio" name="ratings[1]" id="Quality_1" value="1" class="radio"> 1star</td>
                                        <td class="value" data-title="2 star"><input type="radio" name="ratings[1]" id="Quality_2" value="2" class="radio">2star</td>
                                        <td class="value" data-title="3 star"><input type="radio" name="ratings[1]" id="Quality_3" value="3" class="radio">3star</td>
                                        <td class="value" data-title="4 star"><input type="radio" name="ratings[1]" id="Quality_4" value="4" class="radio">4star</td>
                                        <td class="value last" data-title="5 star"><input type="radio" name="ratings[1]" id="Quality_5" value="5" class="radio">5star</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <ul class="form-list">
                                    <li>
                                        <label for="nickname_field" class="required"><em>*</em>Nickname</label>
                                        <div class="input-box form-group">
                                            <input type="text" name="nickname" id="nickname_field" class="input-text required-entry form-control" value="">
                                        </div>
                                    </li>
                                    <li>
                                        <label for="summary_field" class="required"><em>*</em>Summary of Your Review</label>
                                        <div class="input-box form-group">
                                            <input type="text" name="title" id="summary_field" class="input-text required-entry form-control" value="">
                                        </div>
                                    </li>
                                    <li>
                                        <label for="review_field" class="required"><em>*</em>Review</label>
                                        <div class="input-box form-group">
                                            <textarea name="detail" id="review_field" rows="3" class="required-entry form-control"></textarea>
                                        </div>
                                    </li>
                                </ul>                        <div class="buttons-set">
                                    <button type="submit" title="Submit Review" class="button btn btn-kids"><span><span>Submit Review</span></span></button>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
                <!-- end of review-->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="complete-look">
                        <h4>Complete Your Look</h4>
                         <?= SpecialProducts::widget(['product_id' => $model->id]) ?>
                    </div>

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <hr class="border-line">
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= RelatedProducts::widget(['product_id' => $model->id]) ?>
              
            </div>


        </div>

    </div>
</section>  