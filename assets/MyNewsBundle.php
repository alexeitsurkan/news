<?php namespace app\assets;

use yii\web\AssetBundle;

class MyNewsBundle extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/news/my_news.css',
    ];
    public $depends = [
        AppAsset::class
    ];
}