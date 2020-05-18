<?php namespace app\assets;

use yii\web\AssetBundle;

class SendNotifyBundle extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/user/send_notify.js'
    ];

    public $depends = [
        DualListboxBundle::class,
        AppAsset::class,
    ];
}