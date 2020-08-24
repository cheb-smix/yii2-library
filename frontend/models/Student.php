<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Student model
 *
 * @property integer $id
 * @property string $fio
 * @property string $img
 */

class Student extends ActiveRecord
{
	public function attributeLabels()
	{
		return [
			'fio'=>'ФИО студента',
			'img'=>'Фотография',
		];
	}
	public function rules()
	{
		return [
			[ ['fio'], 'required' ],
			[ ['fio'], 'string', 'length'=>[5,100], 'message'=>'Wrong' ],
		];
	}
	public function getHistory()
	{
		return $this->hasMany(History::className(), ['student_id' => 'id'])->with("exemplar");
	}
}

