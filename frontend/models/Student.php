<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * History model
 *
 * @property integer $id
 * @property string $fio
 */

class Students extends ActiveRecord
{
	public function attributeLabels()
	{
		return [
			'fio'=>'ФИО студента',
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
		return $this->hasMany(History::className(), ['student_id' => 'id'])->getExemplar();
	}
}

