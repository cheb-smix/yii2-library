<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Bookform extends ActiveRecord
{
	public $title;
	public $releasedate;
	public $author_id;
	public $img;
	
	
	public function attributeLabels()
	{
		return [
			'title'=>'Название книги',
			'releasedate'=>'Дата выхода',
			'author_id'=>'Автор',
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
	}
}
