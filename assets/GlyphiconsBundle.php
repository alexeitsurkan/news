<?php namespace app\assets;

use yii\web\AssetBundle;

class GlyphiconsBundle extends AssetBundle
{
    public $sourcePath = '@app/node_modules';

    public $js = [
        'glyphicons/glyphicons.js',
        'glyphicons/glyphicons.spec.js',
    ];

    public $depends = [
        AppAsset::class,
    ];
}