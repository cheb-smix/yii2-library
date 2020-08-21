<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Book;

class BookController extends Controller
{

    public function actionIndex(){
        $id = Yii::$app->request->get('id');
        $book = Book::find()
        ->where(['id' => $id])
        ->with('author','shelf')
        ->one();
        if(!$book){
            $this->redirect();
        }
        return $this->render('index', compact('book'));
    }

}