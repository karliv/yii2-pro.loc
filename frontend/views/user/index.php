<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $searchModel common\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'username',
                //'value' => Html::a($model->username, ['user/view', 'id' => $model->id]),
                'value' => function($data) {
                    return Html::a($data->username, ['user/view', 'id' => $data->id]);
                },
                'format' => 'html'
            ],
            'email:email',
            [
                'attribute' => 'status',
                'filter' => User::STATUS_LABELS,
                'value' => function(User $model){return User::STATUS_LABELS[$model->status];}
            ],
            'created_at:datetime',
            'updated_at:datetime',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
