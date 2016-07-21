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
class InnerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'css/fonts.css',
        'css/bootstrap.min.css',
        'css/jquery.bxslider.css',
        'css/style.css',
        'css/font-awesome.css',
        'css/responsive.css',
        'css/flaticon.css',
        'css/demo.css',
        'css/jquery.mmenu.all.css',
    ];
    public $js = [

        'js/jquery.bxslider.min.js',
        'js/custom.js',
        'js/modernizr.custom.js',
        'js/toucheffects.js',
        'js/bootstrap.min.js',
        'js/jquery.mmenu.all.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}

