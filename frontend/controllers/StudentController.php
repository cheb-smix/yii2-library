<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Student;

class StudentController extends Controller
{

    public function actionIndex($id=0){
        if($id){
            $student = Student::find()
            ->where(['id' => $id])
            ->with("history")
            ->one();
        }else{
            return $this->redirect(['student/list']);
        }

        return $this->render('index', compact('student'));
    }

    public function actionList(){
        $students = Student::find()->all();

        return $this->render('list', compact('students'));
    }

    public function actionEdit($id=0){
        if($id){
            $student = Student::find()
            ->where(['id' => $id])
            ->with("history")
            ->one();
        }else{
            $student = new Student();
        }

        if($student->load(\Yii::$app->request->post()) && $student->validate()){
            if($student->save()){
                Yii::$app->session->setFlash('success','Данные приняты');
                return $this->redirect(['student/index','id'=>$id]);
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }
        }

        return $this->render('edit', compact('student'));
    }

}