<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project_user`.
 */
class m180827_103024_create_project_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project_user', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'role' => $this->text()
        ]);

        $this->addForeignKey(
            'project_user_user_cb', //Название ключа
            'project_user', //Таблица, где есть поле для связи
            'user_id',
            'user', //Таблица, с которой происходит связь
            'id' //PK, итоговое целевое поле для связи
        );

        $this->addForeignKey(
            'project_user_user_ub', //Название ключа
            'project_user', //Таблица, где есть поле для связи
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
        $this->dropForeignKey('project_user_user_cb', 'project_user');
        $this->dropForeignKey('project_user_user_ub', 'project_user');
        $this->dropTable('project_user');
    }
}
