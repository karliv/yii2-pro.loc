<?php

namespace frontend\modules\api\models;

//use common\models\Project;
use frontend\modules\api\models\ProjectRest;
use common\models\User;

class UserRest extends User
{
    public function fields()
    {
        return ['id', 'name' => 'username'];
    }

    public function extraFields()
    {
        return ['projectUsers', 'projects'];
    }

    public function getProjects()
    {
        return $this->hasMany(ProjectRest::className(), ['id' => 'project_id'])->via('projectUsers');
    }
}