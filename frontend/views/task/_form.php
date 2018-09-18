<?php

use common\models\Project;
use common\models\ProjectUser;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Task */
/* @var $form yii\widgets\ActiveForm */

$projects = Project::find()->byUser(Yii::$app->user->identity)->select('title')->indexBy('id')->column();
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'estimation')->textInput() ?>

    <?= $form->field($model, 'project_id')->dropDownList($projects) ?>

    <?= $form->field($model, 'executor_id')->dropDownList(
        ArrayHelper::map(User::find()->all(), 'id', 'username')
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
