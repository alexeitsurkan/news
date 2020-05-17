<?php namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/animate.css',
        'css/icomoon.css',
        'css/bootstrap.css',
        'css/style.css',
    ];
    public $js = [
        'js/main.js',
    ];
    public $depends = [
        JQueryBundle::class,
        JQueryEasingBundle::class,
        BootstrapBundle::class,
        WaypointsBundle::class,
    ];
}