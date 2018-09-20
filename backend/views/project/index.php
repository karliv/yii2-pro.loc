<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Project;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            //'id',
            [
                'attribute' => 'title',
                'label' => 'Название',
            ],
//            [
//                'attribute' => 'description',
//                'format' => 'ntext',
//                'options' => [
//                    'width' => 70
//                ]
//            ],
            [
                'attribute' => Project::RELATION_PROJECT_USERS.'role',
                'label' => 'Роль',
                'value' => function(Project $model) {
                    return join(', ', $model->getProjectUsers()->select('role')
                        ->where(['user_id' => \Yii::$app->user->id])->column());
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'active',
                'filter' => Project::STATUS_LABELS,
                'label' => 'Активность',
                'value' => function(Project $model){return Project::STATUS_LABELS[$model->active];}
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Создал',
                'value' => function(Project $model) {
                    return Html::a($model->creator->username, ['user/view', 'id' => $model->creator->id]);
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'updated_at',
                'label' => 'Обновил',
                'value' => function(Project $model) {
                    return Html::a($model->updater->username, ['user/view', 'id' => $model->updater->id]);
                },
                'format' => 'html'
            ],

            //[
            //    'attribute' => 'created_at',
            //    'label' => 'Создано',
            //    'value' => function($data) {
            //        return date('M d, Y g:i a', $data->created_at);
            //    }
            //],

            //[
            //    'attribute' => 'updated_at',
            //    'label' => 'Обнавленно',
            //    'value' => function($data) {
            //        return date('M d, Y g:i A', $data->updated_at);
            //    }
            //],
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
