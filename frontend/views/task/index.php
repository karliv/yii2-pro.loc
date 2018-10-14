<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\ProjectUser;
use common\models\Task;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var array $projects */

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
                //'search' => '',
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
                'value' => 'updater.username',
                //'value' => function($data) {
                //    return Html::a($data->updater->username, ['user/view', 'id' => $data->updater->id]) ? $data->updated_by == null : '';
                //},
                'format' => 'html'
            ],
            'created_at:date',
            'updated_at:date',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {take} {surrender}',
                'buttons' => [
                    'take' => function ($url, Task $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('play');
                        return Html::a($icon, ['task/take', 'id' => $model->id], [
                            'data' => [
                                'confirm' => 'Вы готовы взяться за этоу задачу?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'surrender' => function ($url, Task $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('ok');
                        return Html::a($icon, ['task/complete', 'id' => $model->id], [
                            'data' => [
                                'confirm' => 'Задача выполнена?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ],
                'visibleButtons' => [
                    'update' => function (Task $model) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    'delete' => function (Task $model) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    'take' => function (Task $model) {
                        return Yii::$app->taskService->canTake($model->project, Yii::$app->user->identity) ? $model->executor_id == null : '';
                        //return Yii::$app->taskService->canTake($model, $model->executor);
                    },
                    'surrender' => function (Task $model) {
                        return Yii::$app->taskService->canComplete($model, Yii::$app->user->identity);
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
