<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii2mod\comments\widgets\Comment;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->username;
$this->title = 'Профиль пользователя: ' . $model->username;
?>
<div class="user-view">

    <h1>Профиль пользователя: <?= Html::encode($model->username)?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

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
