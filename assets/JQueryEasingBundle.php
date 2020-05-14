<?php namespace app\assets;

use yii\web\AssetBundle;

class JQueryEasingBundle extends AssetBundle
{
    public $sourcePath = '@app/node_modules';

    public $js = [
        'jquery.easing/jquery.easing.min.js',
    ];

}