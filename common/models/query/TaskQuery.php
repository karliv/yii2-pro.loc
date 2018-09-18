<?php

namespace common\models\query;
use common\models\Project;
use common\models\ProjectUser;
use common\models\User;

/**
 * This is the ActiveQuery class for [[\common\models\Task]].
 *
 * @see \common\models\Task
 */
class TaskQuery extends \yii\db\ActiveQuery
{
    public function byUser($userId, $role = null) {
        $query = ProjectUser::find()->select('project_id')->byUser($userId);
        return $this->andWhere(['project_id' => $query]);
    }

//    public function onlyActive($userId, $active = null)  {
//        $query = User::find()->select('status')->onlyActive($userId);
//        return $this->andWhere(['project_id' => $query]);
//
//        $this->andWhere(['user_id' => $userId]);
//
//        if ($active) {
//            $this->andWhere(['active' => $active]);
//        }
//
//        return $this;
//    }

    /**
     * {@inheritdoc}
     * @return \common\models\Task[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Task|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
