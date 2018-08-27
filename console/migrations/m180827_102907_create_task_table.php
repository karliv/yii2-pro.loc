<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m180827_102907_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'estimation' => $this->integer()->notNull(),
            'executor_id' => $this->integer()->null(),
            'started_at' => $this->integer()->null(),
            'completed_at' => $this->integer()->null(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->null(),
            'created_at'=> $this->integer()->notNull(),
            'updated_at' => $this->integer()->null()
        ]);

        $this->addForeignKey(
            'task_user_exi', //Название ключа
            'task', //Таблица, где есть поле для связи
            'executor_id',
            'user', //Таблица, с которой происходит связь
            'id' //PK, итоговое целевое поле для связи
        );

        $this->addForeignKey(
            'task_user_cb', //Название ключа
            'task', //Таблица, где есть поле для связи
            'created_by',
            'user', //Таблица, с которой происходит связь
            'id' //PK, итоговое целевое поле для связи
        );

        $this->addForeignKey(
            'task_user_ub', //Название ключа
            'task', //Таблица, где есть поле для связи
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
        $this->dropForeignKey('task_user_exi', 'task');
        $this->dropForeignKey('task_user_cb', 'task');
        $this->dropForeignKey('task_user_ub', 'task');
        $this->dropTable('task');
    }
}
