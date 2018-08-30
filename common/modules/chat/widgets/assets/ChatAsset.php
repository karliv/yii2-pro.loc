<?php

namespace common\modules\chat\widgets\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ChatAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //public $css = [
    //    'css/site.css',
    //];
    public $js = [
        'js/chat.js'
    ];
    //public $depends = [
    //    'yii\web\YiiAsset',
    //    'yii\bootstrap\BootstrapAsset',
    //];
}
