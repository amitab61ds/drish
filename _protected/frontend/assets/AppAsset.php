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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'css/jquery.fullPage.css',
        'css/bootstrap.min.css',
        'css/style_new.css',
        'css/responsive.css',
        'css/flaticon.css',
    ];
    public $js = [
        'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js',
        'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js',
        'js/jquery.fullPage.js',
    ];

    public $depends = [
      //  'yii\web\YiiAsset',
    ];
}

