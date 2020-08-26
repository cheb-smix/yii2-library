<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use app\models\History;
use app\models\Exemplar;
use app\models\Student;

class HistoryController extends Controller
{
    public function actionList()
    {
        $history = History::find()
        ->with('student','exemplar')
        ->orderBy('date_taken DESC')
        ->all();
        return $this->render('list', compact('history'));
    }

    public function actionAdd($exemplar_id)
    {
        if (!$exemplar_id) {
            Yii::$app->session->setFlash('error','Экземпляр не указан');
            return $this->redirect(['history/list']);
        }
        $history = new History();
        $history->date_taken = date("Y-m-d");

        if ($history->load(\Yii::$app->request->post(), 'History') && $history->validate()) {
            if ($history->save()) {
                Yii::$app->session->setFlash('success','Данные приняты');
                return $this->redirect(['history/list']);
            } else {
                Yii::$app->session->setFlash('error','Ошибка');
            }
        }

        $exemplar = Exemplar::find()
        ->where(["id" => $exemplar_id])
        ->with("book","onhand")
        ->one();
        if ($exemplar["onhand"]) {
            Yii::$app->session->setFlash('error','Экземпляр уже на руках');
            return $this->redirect(['history/list']);
        }

        $students = ArrayHelper::map(Student::find()->all(), 'id', 'fio');

        return $this->render('add', compact('history','exemplar','students'));
    }

    public function actionReturn($id=0)
    {
        if ($id) {
            $history = History::find()
            ->where(['id' => $id])
            ->one();
        } else {
            return $this->redirect(['history/list']);
        }

        $history->date_returned = date("Y-m-d");
        
        if ($history->save()) {
            Yii::$app->session->setFlash('success','Данные приняты');
        } else {
            Yii::$app->session->setFlash('error','Ошибка');
        }
        return $this->redirect(['history/list']);
    }

}