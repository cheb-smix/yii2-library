<?php
namespace app\models;

use Yii;
use Yii\db\ActiveRecord;

class Bookcase extends ActiveRecord{
	public function attributeLabels(){
		return [
            'book_id'=>'Книга',
            'student_id'=>'Студент',
            'date_taken'=>'Дата выдачи',
            'date_returned'=>'Дата возврата'
		];
	}
	public function rules(){
		return [];
	}
	public function getStudent()
	{
		return $this->hasOne(Student::className(), ['id' => 'student_id']);
	}
	public function getBook()
	{
		return $this->hasOne(Book::className(), ['id' => 'book_id']);
	}
}
