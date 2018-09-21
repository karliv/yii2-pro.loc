<?php

namespace common\services;

use Yii;
use common\models\Project;
use common\models\ProjectUser;
use common\models\Task;
use common\models\User;
use yii\base\Component;

class TaskService extends Component
{
    public function canUpdate(Project $project, User $user) {
        return Yii::$app->projectService->hasRoles($project, $user, [ProjectUser::ROLE_MANAGER]);
    }

    public function canManage(Project $project, User $user) {
        return Yii::$app->projectService->hasRole($project, $user, ProjectUser::ROLE_MANAGER);
    }

    public function canTake(Project $project, User $user) {
        return Yii::$app->projectService->hasRole($project, $user, ProjectUser::ROLE_DEVELOPER);
    }

    //public function canComplete(Task $task, User $user) {
    //    return $this->hasEx($task, $user);
    //}

    public function takeTask(Task $task) {
        $task->executor_id = Yii::$app->user->id;
        $task->started_at = time();
        return $task->save();
    }

    public function completeTask(Task $task) {
        $task->executor_id = Yii::$app->user->id;
        $task->completed_at = time();
        return $task->save();
    }
}