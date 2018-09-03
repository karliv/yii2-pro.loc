<?php

namespace frontend\controllers;


use yii\web\Controller;

class ChatSampleController extends Controller
{
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionTest() {
        return 245356;
    }
}