<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * History model
 *
 * @property integer $id
 * @property integer $exemplar_id
 * @property integer $student_id
 * @property string $date_taken
 * @property string $date_returned
 */

class History extends ActiveRecord{
	public function attributeLabels(){
		return [
            'exemplar_id'=>'Экземпляр книги',
            'student_id'=>'Студент',
            'date_taken'=>'Дата выдачи',
            'date_returned'=>'Дата возврата'
		];
	}
	public function rules(){
		return [
			[ ['exemplar_id','student_id','date_taken'], 'required' ],
            [ ['student_id'], 'number', 'min'=>1, 'message'=>'Выберите студента' ],
		];
	}
	public function getStudent()
	{
		return $this->hasOne(Student::className(), ['id' => 'student_id']);
	}
	public function getExemplar()
	{
		return $this->hasOne(Exemplar::className(), ['id' => 'exemplar_id'])->with("book");
	}
}
