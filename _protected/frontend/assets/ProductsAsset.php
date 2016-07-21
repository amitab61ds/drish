<?php
/**
 * -----------------------------------------------------------------------------
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * -----------------------------------------------------------------------------
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

// set @themes alias so we do not have to update baseUrl every time we change themes
Yii::setAlias('@themes', Yii::$app->view->theme->baseUrl);

/**
 * -----------------------------------------------------------------------------
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 * -----------------------------------------------------------------------------
 */
class ProductsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'css/fonts.css',
        'css/bootstrap.min.css',
        'css/style.css',
        'css/font-awesome.css',
        'css/responsive.css',
        'css/jquery-ui.css',
        'css/demo.css',
		'css/jquery.mmenu.all.css',
		'css/flaticon.css',
        
    ];
    public $js = [

        'js/jquery.min.js',
        'js/jquery-ui.js',
        'js/jquery.mmenu.all.min.js',
        'js/jquery.elevatezoom.js',
        'js/jquery.bxslider.min.js',
        'js/custom-product.js',
        'js/custom.js',
        //'js/bootstrap.min.js',

    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}

