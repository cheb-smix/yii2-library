<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Author model
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $img
 */

class Author extends ActiveRecord{
	public function attributeLabels()
	{
		return [
			'name'=>'Имя автора',
			'description'=>'Описание',
			'img'=>'Фотография'
		];
	}
	public function rules()
	{
		return [
			[ ['name'], 'required' ],
			[ ['name'], 'string', 'length'=>[5,100], 'message'=>'Wrong' ],
		];
	}
	public function getBooks()
	{
		return $this->hasMany(Book::className(), ['author_id' => 'id']);
	}
}

