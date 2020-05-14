<?php namespace app\assets;

use yii\web\AssetBundle;

class JQueryBundle extends AssetBundle
{
    public $sourcePath = '@app/node_modules/';

    public $js = [
        'jquery/dist/jquery.min.js'
    ];
}