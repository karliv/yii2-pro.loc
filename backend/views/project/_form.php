<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Project;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\MultipleInputColumn;
use common\models\ProjectUser;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form yii\widgets\ActiveForm */
/* @var array $activeUser */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php if (!$model->isNewRecord): ?>

    <?= $form->field($model, 'active')->dropDownList(Project::STATUS_LABELS) ?>

    <?= $form->field($model, Project::RELATION_PROJECT_USERS)->widget(MultipleInput::class, [
        'id' => 'project_widget',
        'max' => 10,
        'min' => 0,
        'addButtonPosition' => MultipleInput::POS_HEADER,
        'columns' => [
            [
                'name' => 'user_id',
                'type' => MultipleInputColumn::TYPE_STATIC,
                'value' => function($data) {
                    return $data ? Html::a($data->user->username, ['user/view', 'id' => $data->user_id]) : '';
                }
            ],
            [
                'name' => 'project_id',
                'type' => 'hiddenInput',
                'defaultValue' => $model->id
            ],
            [
                'name' => 'user_id',
                'type' => 'dropDownList',
                'title' => 'User',
                'items' => $activeUser
            ],
            [
                'name' => 'role',
                'type' => 'dropDownList',
                'title' => 'Role',
                'items' => ProjectUser::ROLE_LABELS
            ]
        ]
    ]); ?>
    <?php endif; ?>

    <div class="form-group">
        <div class="col-sm-offset-2"><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
