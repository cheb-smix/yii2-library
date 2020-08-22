<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%exemplar}}`.
 */
class m200822_142703_create_exemplar_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%exemplar}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'shelf_id' => $this->integer(),
        ]);

        Yii::$app->db->createCommand()->batchInsert('{{%exemplar}}', ['book_id','shelf_id'], [
            ['1','1'],
            ['1','1'],
            ['1','1'],
            ['1','1'],
            ['2','1'],
            ['2','1'],
            ['2','1'],
            ['3','3'],
            ['3','3'],
            ['3','3'],
            ['3','3'],
            ['3','3'],
            ['3','3'],
            ['3','3'],
            ['3','3'],
            ['3','4'],
            ['3','4'],
            ['3','4'],
        ])->execute();

        $this->createIndex(
            'idx-exemplar-book_id',
            'exemplar',
            'book_id'
        );

        $this->addForeignKey(
            'fk-exemplar-book_id',
            'exemplar',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-exemplar-shelf_id',
            'exemplar',
            'shelf_id'
        );

        $this->addForeignKey(
            'fk-exemplar-shelf_id',
            'exemplar',
            'shelf_id',
            'shelf',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-exemplar-shelf_id',
            'exemplar'
        );

        $this->dropIndex(
            'idx-exemplar-shelf_id',
            'exemplar'
        );

        $this->dropForeignKey(
            'fk-exemplar-book_id',
            'exemplar'
        );

        $this->dropIndex(
            'idx-exemplar-book_id',
            'exemplar'
        );

        $this->dropTable('{{%exemplar}}');
    }
}
