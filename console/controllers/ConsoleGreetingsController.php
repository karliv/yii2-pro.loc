<?php

namespace console\controllers;

use yii\console\Controller;

/**
 * This console command output simple expression "Hello, world"
 * @package console\controllers
 */
class ConsoleGreetingsController extends Controller
{
    public function actionIndex()
    {
        echo "Hello, world \n";
    }
}