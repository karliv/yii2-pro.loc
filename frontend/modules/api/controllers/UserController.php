<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\UserRest;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

/**
 * Default controller for the `api` module
 */
class UserController extends Controller
{
    //public $modelClass = 'frontend\modules\api\models\UserRest';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::class,
            'auth' => function($username, $password) {
                return UserRest::findOne([
                    'username' => $username,
                    'auth_key' => $password,
                ]);
            },
            'only' => ['view']
        ];
        return $behaviors;
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $dp = new ActiveDataProvider(['query' => UserRest::find()]);
        //$dp->pagination->pageSize = 2;
        return $dp;
    }

    public function actionView($id)
    {
        return UserRest::findOne($id);
    }
}
