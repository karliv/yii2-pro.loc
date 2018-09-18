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
            'project.title',
            'title',
            'description:ntext',
            'estimation',
            [
                'attribute' => 'executor_id',
                'value' => function($data) {
                    return Html::a($data->executor->username, ['user/view', 'id' => $data->executor->id]);
                },
                'format' => 'html'
            ],
            'started_at:date',
            'completed_at:date',
            [
                'attribute' => 'created_by',
                'value' => 'creator.username'
            ],
            [
                'attribute' => 'updated_by',
                'value' => 'updater.username'
            ],
            'created_at:date',
            'updated_at:date',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'update' => function (Task $model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_MANAGER);
                    },
                    'delete' => function (Task $model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, ProjectUser::ROLE_MANAGER);
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
