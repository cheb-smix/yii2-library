<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use app\models\Book;
use app\models\Bookform;
use app\models\Author;
use app\models\Shelf;

class BookController extends Controller
{

    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');
        $book = Book::find()
        ->where(['id' => $id])
        ->with('author','exemplars')
        ->one();
        if(!$book){
            $this->redirect();
        }
        return $this->render('index', compact('book'));
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->get('id');
        $book = Book::find()
        ->where(['id' => $id])
        ->one();
        $authors = ArrayHelper::map(Author::find()->all(), 'id', 'name');
        $shelfes = [];
        foreach(Shelf::find()->with("bookcase")->all() as $shelf){
            $shelfes[$shelf["id"]] = $shelf["bookcase"]["title"]." | ".$shelf["title"];
        }

        $bookform = new Bookform();
        if($book){
            $bookform->title = $book["title"];
            $bookform->releasedate = $book["releasedate"];
            $bookform->author_id = $book["author_id"];
            $bookform->img = $book["img"];
        }
        
        return $this->render('edit', compact(['bookform','authors','shelfes']));
    }

}