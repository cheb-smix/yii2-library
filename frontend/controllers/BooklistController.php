<?php
namespace frontend\controllers;

use yii\web\Controller;
use app\models\Bookcase;

class BooklistController extends Controller
{

    public function actionIndex(){
        $booklist = Bookcase::find()
        ->with('shelfes')
        ->all();

        return $this->render('index', compact('booklist'));
    }

}