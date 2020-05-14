<?php namespace app\assets;

use yii\web\AssetBundle;

class StellarBundle extends AssetBundle
{
    public $sourcePath = '@app/node_modules';

    public $js = [
        'jquery.stellar/jquery.stellar.js',
    ];
}