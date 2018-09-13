<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Project;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
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

            'id',
            'title',
//            [
//                'attribute' => 'description',
//                'format' => 'ntext',
//                'options' => [
//                    'width' => 70
//                ]
//            ],
            [
                'attribute' => 'active',
                'filter' => Project::STATUS_LABELS,

                'value' => function(Project $model){return Project::STATUS_LABELS[$model->active];}
            ],
            [
                'attribute' => 'creator',
                'value' => 'creator.username'
            ],
            [
                'attribute' => 'updater',
                'value' => 'updater.username'
            ],
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
