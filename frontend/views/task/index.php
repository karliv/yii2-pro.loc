<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\ProjectUser;
use common\models\Task;

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
                'value' => function($data) {
                    return Html::a($data->executor->username, ['user/view', 'id' => $data->executor->id]);
                },
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
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_MANAGER);
                    },
                    'delete' => function (Task $model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_MANAGER);
                    },
                    'take' => function (Task $model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_DEVELOPER);
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
