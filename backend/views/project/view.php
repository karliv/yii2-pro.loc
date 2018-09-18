<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii2mod\comments\widgets\Comment;
use common\models\Project;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'id',
            'title',
            'description',
            [
                'attribute' => 'active',
                'value' => Project::STATUS_LABELS[$model->active]
            ],
            [
                'attribute' => 'created_by',
                'value' => $model->creator->username
            ],
            [
                'attribute' => 'updated_by',
                'value' => $model->updater->username
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <?= Comment::widget([
        'model' => $model,
    ]); ?>

</div>
