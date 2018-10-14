<?php

namespace common\models\query;
use common\models\User;

/**
 * This is the ActiveQuery class for [[\common\models\ProjectUser]].
 *
 * @see \common\models\ProjectUser
 */
class ProjectUserQuery extends \yii\db\ActiveQuery
{
    public function byUser($userId, $role = null) {
        $this->andWhere(['user_id' => $userId]);

        if ($role) {
            $this->andWhere(['role' => $role]);
        }

        return $this;
    }

//    public function onlyActive()  {
//        $query = User::find()->select('status')->onlyActive(); //$this->andWhere(['id' => $userId]);
//
//        return $query;
//    }

    /**
     * {@inheritdoc}
     * @return \common\models\ProjectUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\ProjectUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
