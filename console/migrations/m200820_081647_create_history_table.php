<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history}}`.
 */
class m200820_081647_create_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'date_taken' => $this->date()->notNull(),
            'date_returned' => $this->date()
        ]);

        Yii::$app->db->createCommand()->batchInsert('{{%history}}', ['book_id','student_id','date_taken','date_returned'], [
            ['1','1','2020-08-20',''],
            ['3','3','2020-08-21',''],
        ])->execute();

        $this->createIndex(
            'idx-history-book_id',
            'history',
            'book_id'
        );

        $this->addForeignKey(
            'fk-history-book_id',
            'history',
            'book_id',
            'book',
            'id',
            'NO ACTION'
        );

        $this->createIndex(
            'idx-history-student_id',
            'history',
            'student_id'
        );

        $this->addForeignKey(
            'fk-history-student_id',
            'history',
            'student_id',
            'student',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-history-student_id',
            'history'
        );

        $this->dropIndex(
            'idx-history-student_id',
            'history'
        );

        $this->dropForeignKey(
            'fk-history-book_id',
            'history'
        );

        $this->dropIndex(
            'idx-history-book_id',
            'history'
        );

        $this->dropTable('{{%history}}');
    }
}
