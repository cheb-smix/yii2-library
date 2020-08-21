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
            'author_id' => $this->integer()->notNull(),
            'releasedate' => $this->date(),
            'count' => $this->integer()->notNull(),
            'shelf_id' => $this->integer(),
            'img' => $this->string(200)
        ]);

        Yii::$app->db->createCommand()->batchInsert('{{%book}}', ['title','author_id','releasedate','count','shelf_id','img'], [
            ['Повелители мечей','1','1971-01-01','5','1','images/book1.jpg'],
            ['Элрик из Мелнибонэ','1','1978-08-08','3','2','images/book2.jpg'],
            ['Ведьмак: «Последнее желание»','1','1996-04-15','8','6','images/book3.jpg'],
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

        $this->createIndex(
            'idx-book-shelf_id',
            'book',
            'shelf_id'
        );

        $this->addForeignKey(
            'fk-book-shelf_id',
            'book',
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
            'fk-book-author_id',
            'book'
        );

        $this->dropIndex(
            'idx-book-author_id',
            'book'
        );

        $this->dropForeignKey(
            'fk-book-shelf_id',
            'book'
        );

        $this->dropIndex(
            'idx-book-shelf_id',
            'book'
        );

        $this->dropTable('{{%book}}');
    }
}
