<?php

namespace common\services;

use Yii;
use common\models\Project;
use common\models\ProjectUser;
use common\models\Task;
use common\models\User;
use yii\base\Component;
use yii\base\Event;

class AssignRoleEvent extends Event
{
    public $project;
    public $user;
    public $role;

    public function dump() {
        return ['project' => $this->project->id, 'user' => $this->user->id, 'role' => $this->role];
    }
}

class ProjectService extends Component
{
    const  EVENT_ASSIGN_ROLE = 'event_assign_role';

    public function getRoles(Project $project, User $user) {
        return $project->getProjectUsers()->byUser($user->id)->select('role')->column();
    }

    public function hasRole(Project $project, User $user, $role) {
        return in_array($role, $this->getRoles($project, $user));
    }

    public function hasRoles(Project $project, User $user, $roles) {
        return in_array($this->getRoles($project, $user), $roles);
    }

    public function canUpdate(Project $project, User $user) {
        return $this->hasRoles($project, $user, [ProjectUser::ROLE_MANAGER]);
    }

    public function canTake(Project $project, User $user) {
        return $this->hasRoles($project, $user, [ProjectUser::ROLE_DEVELOPER]);
    }

    public function takeTask(Task $task, User $user) {
        $task->executor_id = Yii::$app->user->id;
        $task->started_at = time();
        return $task->save();
    }

    /**
     * @param Project $project
     * @param User $user
     * @param $role
     */
    public function assignRole(Project $project, User $user, $role) {
        $event = new AssignRoleEvent();
        $event->project = $project;
        $event->user = $user;
        $event->role = $role;
        $this->trigger(self::EVENT_ASSIGN_ROLE, $event);
    }
}