<?php namespace app\assets;

use yii\web\AssetBundle;

class UserProfileBundle extends AppAsset
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/user/profile.css',
    ];

    public $js = [
        'js/user/profile.js'
    ];
}