<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Exemplar model
 *
 * @property integer $id
 * @property integer $book_id
 * @property integer $shelf_id
 */

class Exemplar extends ActiveRecord
{

	public function attributeLabels()
	{
		return [
			'id'=>'Экземпляр',
			'book_id'=>'ID книги',
			'shelf_id'=>'ID полки',
		];
	}

	public function rules()
	{
		return [
			[ ['book_id','shelf_id'], 'required' ],
		];
	}

	public function getOnhand(){
		return $this->hasOne(History::className(), ['exemplar_id' => 'id'])->where(['date_returned' => NULL]);
	}

	public function getBook()
	{
		return $this->hasOne(Book::className(), ['id' => 'book_id'])->with("author");
	}
	
    public function getShelf()
	{
		return $this->hasOne(Shelf::className(), ['id' => 'shelf_id']);
	}
	
}
