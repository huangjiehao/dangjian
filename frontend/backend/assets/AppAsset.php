<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //全局CSS
    public $css = [
//        'css/site.css',
//		'css/bootstrap.min.css',
//        'https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css',
//        'https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css',
//        'plugins/daterangepicker/daterangepicker.css',
//        'plugins/datepicker/datepicker3.css',
//        'plugins/iCheck/all.css',
//        'plugins/colorpicker/bootstrap-colorpicker.min.css',
//        'plugins/timepicker/bootstrap-timepicker.min.css',
//        'plugins/select2/select2.min.css',
//        'dist/css/AdminLTE.min.css',
//        'dist/css/skins/_all-skins.min.css'
    ];
    //全局JS
    public $js = [
//        'https://cdn.bootcss.com/jquery/2.0.3/jquery.min.js',
//        'https//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js',
//        'https://cdn.bootcss.com/underscore.js/1.8.3/underscore-min.js',
//        'js/bootstrap.min.js',
//        'https://cdn.bootcss.com/jqueryui/1.12.1/jquery-ui.js',
//        'plugins/select2/select2.full.min.js',
//        'plugins/chartjs/Chart.min.js',
//        'https://cdn.bootcss.com/highcharts/5.0.12/highcharts.js',
//        'https://cdn.bootcss.com/highcharts/5.0.12/js/modules/exporting.js',
//        'https://cdn.bootcss.com/moment.js/2.18.1/moment.min.js',
//        'plugins/daterangepicker/daterangepicker.js',
//        'plugins/datepicker/bootstrap-datepicker.js',
//        'plugins/colorpicker/bootstrap-colorpicker.min.js',
//        'plugins/timepicker/bootstrap-timepicker.min.js',
//        'plugins/iCheck/icheck.min.js',
//        'plugins/fastclick/fastclick.js',
//        'dist/js/app.min.js',
//        'dist/js/demo.js',
//        'js/iCheck.js',
//        'js/uploadfiles/spark-md5.3.0.0.min.js',
//        'js/uploadfiles/upload.js',
//        'js/uploadfiles/upload.slice.js',
    ];
    //调用yii框架内置的bootstrap框架
    //依赖关系
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

    //定义按需加载JS方法，注意加载顺序在最后
    public static function addScript($view, $jsfile)
    {
        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }

    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile)
    {
        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }
}
