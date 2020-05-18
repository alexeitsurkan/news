<?php namespace app\assets;


use yii\web\AssetBundle;

class DualListboxBundle extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/bootstrap-duallistbox/bootstrap-duallistbox.css',
    ];

    public $js = [
        'js/bootstrap-duallistbox/jquery.bootstrap-duallistbox.js',
    ];

    public $depends = [
        AppAsset::class,
    ];
}