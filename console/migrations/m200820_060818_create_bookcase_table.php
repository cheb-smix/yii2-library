<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bookcase}}`.
 */
class m200820_060818_create_bookcase_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bookcase}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull()->defaultValue('Шкаф')
        ]);
        Yii::$app->db->createCommand()->batchInsert('{{%bookcase}}', ['title'], [
            ['Шкаф А1'],
            ['Шкаф А2'],
            ['Шкаф Б1'],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bookcase}}');
    }
}
