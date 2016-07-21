<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->registerJs("
function wordsdesc(){	
	var val = $('#searchform-search').val();	
		$.ajax({
		url: 'finder/search',
		type: 'post',
		dataType: 'json',
		data: { searchevent : val},
		success: function (response) {	
			$('#search_li').empty();
			if(response != '' && response != null){
				$.each( response, function( key, value ) {
					link = value.link;
					$('#search_li').append('<li><a href='+link+' >'+value.name+'</a></li>');
				});
			}else{
				$('#search_li').append('<li><a href=# >No Items Found !</a></li>');
			}
					
		}
	});
}
function wordsdescs(){	
	var val = $('#search_form').val();	
		$.ajax({
		url: 'finder/search',
		type: 'post',
		dataType: 'json',
		data: { searchevent : val},
		success: function (response) {	
			$('#search_li1').empty();
			if(response != '' && response != null){
				$.each( response, function( key, value ) {
					link = value.link;
					$('#search_li1').append('<li><a href='+link+' >'+value.name+'</a></li>');
				});
			}else{
				$('#search_li1').append('<li><a href=# >No Items Found !</a></li>');
			}
					
		}
	});
}
$('#searchform-search').keyup(function () {
	var len = $('#searchform-search').val().length;
	if(len >= 3){
		wordsdesc();
	}	
	});
	$('#search_form').keyup(function () {
	var len = $('#search_form').val().length;
	if(len >= 3){
		wordsdescs();
	}	
	});"
);

?>

<?php $form = ActiveForm::begin([
	'action'=>['finder/product-search'],
	'id'     => "SearchForm",
	'method'     => "GET",
	'enableAjaxValidation'   => false,
]); ?>
 <?php if($type == "second"){ ?>
		<div class="search-right"> 
			<?= $form->field($model, 'search')->textInput(['maxlength' => true,"placeholder" => "Search...",'class'=>"search-txt"])->label(false) ?>
		</div>
		<ul id="search_li">
		</ul>
 <?php }else{ ?>
		 <div class="input-group search-bar-home">
		 <?= $form->field($model, 'search')->textInput(['id'=>'search_form','maxlength' => true,"placeholder" => "Search products",'class'=>"form-control"])->label(false) ?>
            <div class="input-group-btn search-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
		<div class="search-result">
		<ul id="search_li1">
		</ul>
		</div>
<?php } ?>
 <?php ActiveForm::end(); ?>
