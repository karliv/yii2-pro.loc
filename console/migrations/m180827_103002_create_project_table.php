<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project`.
 */
class m180827_103002_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->null(),
            'created_at'=> $this->integer()->notNull(),
            'updated_at' => $this->integer()->null()
        ]);

        $this->addForeignKey(
            'project_user_cb', //Название ключа
            'project', //Таблица, где есть поле для связи
            'created_by',
            'user', //Таблица, с которой происходит связь
            'id' //PK, итоговое целевое поле для связи
        );

        $this->addForeignKey(
            'project_user_ub', //Название ключа
            'project', //Таблица, где есть поле для связи
            'updated_by',
            'user', //Таблица, с которой происходит связь
            'id' //PK, итоговое целевое поле для связи
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('project_user_cb', 'project');
        $this->dropForeignKey('project_user_ub', 'project');
        $this->dropTable('project');
    }
}
