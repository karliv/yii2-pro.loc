<?php

use yii\db\Migration;

/**
 * Handles adding project_id to table `task`.
 */
class m180903_114355_add_project_id_column_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'project_id', $this->integer()->notNull()->after('estimation'));

        $this->addForeignKey(
            'task_project_pro', //Название ключа
            'task', //Таблица, где есть поле для связи
            'project_id',
            'project', //Таблица, с которой происходит связь
            'id' //PK, итоговое целевое поле для связи
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('task', 'project_id');

        $this->dropForeignKey('task_project_pro', 'task');
    }
}
