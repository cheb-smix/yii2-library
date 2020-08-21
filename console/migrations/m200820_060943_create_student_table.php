<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%student}}`.
 */
class m200820_060943_create_student_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%student}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(200)->notNull()
        ]);
        Yii::$app->db->createCommand()->batchInsert('{{%student}}', ['fio'], [
            ['Иванов Иван'],
            ['Семёнов Семён'],
            ['Петров Пётр'],
            ['Ложкин Виталий'],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%student}}');
    }
}
