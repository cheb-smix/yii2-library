<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Book model
 *
 * @property integer $id
 * @property string $title
 * @property string $releasedate
 * @property integer $author_id
 * @property string $img
 */

class Book extends ActiveRecord
{

	public function attributeLabels()
	{
		return [
			'title'=>'Название книги',
			'releasedate'=>'Дата выхода',
			'author_id'=>'Автор',
			'img'=>'Обложка',
		];
	}

	public function rules()
	{
		return [
			[ ['title','releasedate'], 'required' ],
			[ ['title'], 'string', 'length'=>[5,100], 'message'=>'Wrong' ],
			[ ['author_id'], 'number', 'min'=>1, 'message'=>'Выберите автора' ],
		];
	}
	
	public function getAuthor()
	{
		return $this->hasOne(Author::className(), ['id' => 'author_id']);
	}

	public function getExemplars()
	{
		return $this->hasMany(Exemplar::className(), ['book_id' => 'id'])->with("shelf","onhand");
	}
	
}
