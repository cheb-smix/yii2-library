<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Bookcase extends ActiveRecord
{
	public function attributeLabels()
	{
		return [
			'title'=>'Название/идентификатор шкафа'
		];
	}
	public function rules()
	{
		return [
			[ ['title'], 'required' ],
			[ 'title', 'string', 'length'=>[2,100], 'message'=>'Wrong' ],
		];
	}
	public function getShelfes()
	{
		return $this->hasMany(Shelf::className(), ['bookcase_id' => 'id'])->with("exemplars");
	}
}
