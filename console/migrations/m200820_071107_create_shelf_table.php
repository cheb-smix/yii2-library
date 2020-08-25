<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shelf}}`.
 */
class m200820_071107_create_shelf_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shelf}}', [
            'id' => $this->primaryKey(),
            'bookcase_id' => $this->integer()->notNull(),
            'title' => $this->string(20)->notNull()->defaultValue('Полка I')
        ]);

        Yii::$app->db->createCommand()->batchInsert('{{%shelf}}', ['bookcase_id','title'], [
            ['1','Полка I'],
            ['1','Полка II'],
            ['1','Полка III'],
            ['2','Полка I'],
            ['2','Полка II'],
            ['2','Полка III'],
            ['3','Полка I'],
            ['3','Полка II'],
            ['3','Полка III'],
        ])->execute();

        $this->createIndex(
            'idx-shelf-bookcase_id',
            'shelf',
            'bookcase_id'
        );

        $this->addForeignKey(
            'fk-shelf-bookcase_id',
            'shelf',
            'bookcase_id',
            'bookcase',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-shelf-bookcase_id',
            'shelf'
        );

        $this->dropIndex(
            'idx-shelf-bookcase_id',
            'shelf'
        );

        $this->dropTable('{{%shelf}}');
    }
}
