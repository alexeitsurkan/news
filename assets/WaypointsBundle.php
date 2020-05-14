<?php namespace app\assets;

use yii\web\AssetBundle;

class WaypointsBundle extends AssetBundle
{
    public $sourcePath = '@app/node_modules';

    public $js = [
        'waypoints/lib/jquery.waypoints.min.js',
    ];
}