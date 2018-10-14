<?php

namespace common\models\query;
use common\models\ProjectUser;

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

//    public function byComplete($ex) {
//        $this->andWhere(['completed_at' => null]);
//        //$this->andWhere(['executor_id' => $ex]);
//
//        return $this;
//    }

    public function byExecute($ex) {
        //$query = User::find()->select('id')->byComplete($ex);
        $this->where(['executor_id' => $ex]);
        $this->andWhere(['completed_at' => null]);
        //$this->andWhere(['not', ['started_at' => null]]);
        return $this;
    }

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
