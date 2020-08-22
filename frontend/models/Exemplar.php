<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Exemplar extends ActiveRecord
{
	/*public function attributeLabels()
	{
		return [
			'title'=>'Название книги',
			'releasedate'=>'Дата выхода',
			'author_id'=>'Автор',
			'count'=>'Количество',
			'shelf_id'=>'Полка',
			'img'=>'Обложка'
		];
	}
	public function rules()
	{
		return [
			[ ['title','releasedate'], 'required' ],
			[ ['title'], 'string', 'length'=>[5,100], 'message'=>'Wrong' ],
			[ ['author_id','shelf_id'], 'number', 'min'=>1, 'message'=>'Выберите автора' ],
		];
    }*/
	public function getBook()
	{
		return $this->hasOne(Book::className(), ['id' => 'book_id'])->with("author");
    }
    public function getShelf()
	{
		return $this->hasOne(Shelf::className(), ['id' => 'shelf_id']);
	}
}
