<?php

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class ProjectController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\ProjectRest';
}
