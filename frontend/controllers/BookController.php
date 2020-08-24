<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\models\Book;
use app\models\Bookcase;
use app\models\Author;
use app\models\Shelf;
use app\models\Exemplar;

class BookController extends Controller
{

    public function actionIndex($id=0)
    {
        if($id){
            $book = Book::find()
            ->where(['id' => $id])
            ->with('exemplars')
            ->one();
        }else{
            return $this->redirect(['book/list']);
        }
        return $this->render('index', compact('book'));
    }

    public function actionList(){
        $booklist = Bookcase::find()
        ->with('shelfes')
        ->all();

        return $this->render('list', compact('booklist'));
    }

    public function actionEdit($id=0)
    {
        if($id){
            $book = Book::findOne($id);
            $exemplars = Exemplar::find()
            ->where(['book_id' => $id])
            ->with("onhand")
            ->all();
        }else{
            $book = new Book();
            $exemplars = [];
        }

        $authors = ArrayHelper::map(Author::find()->all(), 'id', 'name');

        $shelfes = [];
        foreach(Shelf::find()->with("bookcase")->all() as $shelf){
            $shelfes[$shelf["id"]] = $shelf["bookcase"]["title"]." | ".$shelf["title"];
        }
        $postedExemplars = Yii::$app->request->post('Exemplar', []);
        $count = count($postedExemplars);
        if($count){
            $exemplars = [];
            for($i = 0; $i < $count; $i++){
                if($postedExemplars[$i]["id"]>0){
                    if($postedExemplars[$i]["book_id"]==0){
                        Exemplar::findOne($postedExemplars[$i]["id"])->delete();
                    }else{
                        $exemplars[] = Exemplar::findOne($postedExemplars[$i]["id"]);
                    }
                }else{
                    if($postedExemplars[$i]["book_id"]) $exemplars[] = new Exemplar();
                }
            }
            if (Model::loadMultiple($exemplars, Yii::$app->request->post()) && Model::validateMultiple($exemplars)) {
                foreach ($exemplars as $e){
                    if($e->book_id>0) $e->save(false);
                }
                Yii::$app->session->setFlash('success','Данные приняты');
                return $this->redirect(['book/index','id'=>$id]);
            }
        }else{
            if($book->load(\Yii::$app->request->post()) && $book->validate()){
                if($book->save()){
                    Yii::$app->session->setFlash('success','Данные приняты');
                    return $this->redirect(['book/index','id'=>$id]);
                }else{
                    Yii::$app->session->setFlash('error','Ошибка');
                }
            }
        }
        return $this->render('edit', compact(['book','authors','shelfes','exemplars']));
    }


}