<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Shelf model
 *
 * @property integer $id
 * @property string $title
 * @property integer $bookcase_id
 */

class Shelf extends ActiveRecord
{
	public function attributeLabels()
	{
		return [
            'title'=>'Идентификатор полки',
            'bookcase_id'=>'Шкаф'
		];
	}
	public function rules()
	{
		return [
			[ ['title','bookcase_id'], 'required' ],
            [ ['title'], 'string', 'length'=>[5,100], 'message'=>'Wrong' ],
            [ ['bookcase_id'], 'number', 'min'=>1, 'message'=>'Выберите шкаф' ],
		];
	}
	public function getBookcase()
	{
		return $this->hasOne(Bookcase::className(), ['id' => 'bookcase_id']);
	}
	public function getExemplars()
	{
		return $this->hasMany(Exemplar::className(), ['shelf_id' => 'id'])->with("book");
	}
}

