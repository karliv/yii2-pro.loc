<?php

use yii\widgets\Pjax;
use yii\helpers\Html;

Pjax::begin();

echo Html::a('Refresh', ['test/index'], ['class' => 'btn btn-primary']);
date_default_timezone_set('Europe/Moscow');
echo date('H:i:s');

Pjax::end();