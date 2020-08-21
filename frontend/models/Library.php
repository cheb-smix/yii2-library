<?php
namespace app\models;

use Yii;
use yii\base\Model;

class Library extends Model{
	public $search;

	public function rules(){
		return [
			[ 'search', 'trim' ],
		];
	}
}

