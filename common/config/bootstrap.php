<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

\yii\base\Event::on(\common\services\ProjectService::class,
    \common\services\ProjectService::EVENT_ASSIGN_ROLE, function (\common\services\AssignRoleEvent $e) {
    Yii::info(['ProjectService::EVENT_ASSIGN_ROLE', $e->dump()], '_');
    $views = ['html' => 'assignRoleToProject-html', 'text' => 'assignRoleToProject-text'];
    $data = ['user' => $e->user, 'project' => $e->project, 'role' => $e->role];
    Yii::$app->emailService->send($e->user->email, 'New role '.$e->role, $views, $data);
});