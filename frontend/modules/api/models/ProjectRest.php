<?php

namespace frontend\modules\api\models;

use common\models\Project;

class ProjectRest extends Project
{
    public function fields()
    {
        return ['id', 'title', 'description', 'active'];
    }
}