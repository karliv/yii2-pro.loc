<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Проект',
                'value' => 'project.title'
            ],
            [
                'attribute' => 'title',
                'label' => 'Задача',
                'value' => 'title'
            ],
            //'description:ntext',
            [
                'attribute' => 'estimation',
                'label' => 'Оценка',
                'value' => 'estimation'
            ],
            [
                'attribute' => 'executor_id',
                'label' => 'Исполнитель',
                'value' => 'executor.username',
                'format' => 'html'
            ],
            'started_at:date',
            'completed_at:date',
            [
                'attribute' => 'created_by',
                'label' => 'Создал',
                'value' => function($data) {
                    return Html::a($data->creator->username, ['user/view', 'id' => $data->creator->id]);
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'updated_by',
                'label' => 'Обновил',
                'value' => 'updater.username',
                'format' => 'html'
            ],
            'created_at:date',
            'updated_at:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
