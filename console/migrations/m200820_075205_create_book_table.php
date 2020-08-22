<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m200820_075205_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200)->notNull(),
            'releasedate' => $this->date(),
            'author_id' => $this->integer()->notNull(),
            'img' => $this->string(200)
        ]);

        Yii::$app->db->createCommand()->batchInsert('{{%book}}', ['title','author_id','releasedate','img'], [
            ['Повелители мечей','1','1971-01-01','images/book1.jpg'],
            ['Элрик из Мелнибонэ','1','1978-08-08','images/book2.jpg'],
            ['Ведьмак: «Последнее желание»','2','1996-04-15','images/book3.jpg'],
        ])->execute();

        $this->createIndex(
            'idx-book-author_id',
            'book',
            'author_id'
        );

        $this->addForeignKey(
            'fk-book-author_id',
            'book',
            'author_id',
            'author',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-book-author_id',
            'book'
        );

        $this->dropIndex(
            'idx-book-author_id',
            'book'
        );

        $this->dropTable('{{%book}}');
    }
}
