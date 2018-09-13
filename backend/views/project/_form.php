<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Project;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\MultipleInputColumn;
use common\models\ProjectUser;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $userList  */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->dropDownList(Project::STATUS_LABELS) ?>

    <?php if (!$model->isNewRecord): ?>
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
                'items' => User::find()->select('username')->indexBy('id')->column()
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
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
