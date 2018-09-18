<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
use yii2mod\comments\widgets\Comment;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->username;
$this->title = 'Профиль пользователя: ' . $model->username;
?>
<div class="user-view">

    <h1><?= Html::encode($model->username) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'value' => User::STATUS_LABELS[$model->status]
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <?= Comment::widget([
        'model' => $model,
    ]); ?>

</div>
