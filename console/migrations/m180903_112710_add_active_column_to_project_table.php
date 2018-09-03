<?php

use yii\db\Migration;

/**
 * Handles adding active to table `project`.
 */
class m180903_112710_add_active_column_to_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('project', 'active', $this->boolean()->defaultValue(0)->after('description'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('project', 'active');
    }
}
