<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;


/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.css',
        "css/fonts.css",
        "css/font.css",
        "css/daterangetime.css",
        "css/datetime.css",
        'css/site.css',
        'css/select2.min.css',
    ];
    public $js = [
        //"js/jquery.min.js",
        "js/moment.js",
        //"js/bootstrap.js"
        "js/datetime.js",
        "js/datepicker.js",
        "js/main.js",
        'js/chart.js',
        'js/jquery.select2.js',
        "js/pgenable.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
        'yii\bootstrap5\BootstrapPluginAsset'
    ];
}
