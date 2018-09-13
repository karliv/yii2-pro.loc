<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\ProjectRest;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;

/**
 * Default controller for the `api` module
 */
class ProjectController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $dp = new ActiveDataProvider(['query' => ProjectRest::find()]);
        $dp->pagination->pageSize = 2;
        return $dp;
    }
}
