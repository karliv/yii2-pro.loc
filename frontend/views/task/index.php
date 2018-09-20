<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\ProjectUser;
use common\models\Task;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи';
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
                'attribute' => 'project_id',
                'label' => 'Проект',
                'value' => function($data) {
                    return Html::a($data->project->title, ['project/view', 'id' => $data->project_id]);
                },
                'format' => 'html'
                //'value' => 'project.title'
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
                'value' => 'updater.username'
            ],
            'created_at:date',
            'updated_at:date',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {take}',
                'buttons' => [
                        'take' => function ($url, Task $model, $key) {
                            $icon = \yii\bootstrap\Html::icon('ok');
                            return Html::a($icon, ['task/take', 'id' => $model->id], [
                                'data' => [
                                    'confirm' => 'Вы готовы взяться за этоу задачу?',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                ],
                'visibleButtons' => [
                    'update' => function (Task $model, $key, $index) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    'delete' => function (Task $model, $key, $index) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    'take' => function (Task $model, $key, $index) {
                        return Yii::$app->taskService->canTake($model->project, Yii::$app->user->identity);
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
