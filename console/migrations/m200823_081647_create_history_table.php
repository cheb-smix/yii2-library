<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history}}`.
 */
class m200823_081647_create_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history}}', [
            'id' => $this->primaryKey(),
            'exemplar_id' => $this->integer(),
            'student_id' => $this->integer()->notNull(),
            'date_taken' => $this->date()->notNull(),
            'date_returned' => $this->date()
        ]);

        Yii::$app->db->createCommand()->batchInsert('{{%history}}', ['exemplar_id','student_id','date_taken','date_returned'], [
            ['3','1','2020-08-20',''],
            ['10','3','2020-08-21',''],
        ])->execute();

        $this->createIndex(
            'idx-history-exemplar_id',
            'history',
            'exemplar_id'
        );

        $this->addForeignKey(
            'fk-history-exemplar_id',
            'history',
            'exemplar_id',
            'exemplar',
            'id'
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
            'id'
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
            'fk-history-exemplar_id',
            'history'
        );

        $this->dropIndex(
            'idx-history-exemplar_id',
            'history'
        );

        $this->dropTable('{{%history}}');
    }
}
