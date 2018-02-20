<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.css',
        'https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.4/css/lightgallery.css',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'
    ];
    public $js = [
        'js/main.js',
        'https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.js',
        'https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.4/js/lightgallery.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
