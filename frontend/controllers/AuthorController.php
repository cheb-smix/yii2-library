<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Author;

class AuthorController extends Controller
{

    public function actionIndex($id=0)
    {
        if ($id) {
            $author = Author::find()
            ->where(['id' => $id])
            ->with("books")
            ->one();
        } else {
            return $this->redirect(['author/list']);
        }

        return $this->render('index', compact('author'));
    }

    public function actionList()
    {
        $authors = Author::find()
        ->with("books")
        ->all();

        return $this->render('list', compact('authors'));
    }

    public function actionEdit($id=0)
    {
        if ($id) {
            $author = Author::find()
            ->where(['id' => $id])
            ->with("books")
            ->one();
        } else {
            $author = new Author();
        }

        if ($author->load(\Yii::$app->request->post()) && $author->validate()) {
            if ($author->save()) {
                Yii::$app->session->setFlash('success','Данные приняты');
                return $this->redirect(['author/index','id'=>$id]);
            } else {
                Yii::$app->session->setFlash('error','Ошибка');
            }
        }

        return $this->render('edit', compact('author'));
    }

}