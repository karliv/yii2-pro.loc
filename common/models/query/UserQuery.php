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
class UserQuery extends \yii\db\ActiveQuery
{
    public function onlyActive()  {
        $this->andWhere(['status' => User::STATUS_ACTIVE]);

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
