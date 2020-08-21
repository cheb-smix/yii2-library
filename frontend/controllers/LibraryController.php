<?
namespace app\controllers;

use Yii;
use app\models\Library;
use app\models\Bookcases;
use app\models\Authors;
use app\models\Students;
use app\models\Books;
use app\models\Bookinfo;
use yii\web\Controller;

class LibraryController extends Controller
{
	public function actionIndex()
    {
		$model = new Library();
		$books = Books::find()->all();
		$authors = Authors::find()->all();
		$authorsarr = array();
		$n=count($authors);
		for($i=0;$i<$n;$i++){
			$authorsarr[$authors[$i]['id']]=$authors[$i]['name'];
		}
		unset($authors);
		$this->view->title = 'Библиотека';
        return $this->render('index',compact('model','books','authorsarr'));
    }
	public function actionSearch()
    {
		$this->view->title = 'Поиск в базе';
		$phrase = $_POST['Library']['search'];
		
		$found = array("Books"=>Books::find()->filterWhere(['like', 'title', $phrase])->all(),"Authors"=>Authors::find()->filterWhere(['like', 'name', $phrase])->all());
		if($n=count($found['Authors'])>0){
			for($i=0;$i<$n;$i++){
				$found['Books'] = array_merge(Books::find($found['Authors'][$i]['id'])->all(),$found['Books']);
			}
		}
		if(!Yii::$app->user->isGuest){
			$found["Bookcases"]=Bookcases::find()->filterWhere(['like', 'title', $phrase])->all();
			$found["Students"]=Students::find()->filterWhere(['like', 'name', $phrase])->all();
		}
        return $this->render('search',compact('found'));
    }
	public function actionBookcase(){
		$bookcases = Bookcases::find()->all();
		$this->view->title = 'Книжные шкафы';
		return $this->render('bookcase',compact('bookcases'));
	}
	public function actionBookinfo($id=1){
		$model = new Bookinfo();
		
		$book = Books::findOne($id);
		$taken_ids = unserialize($book['takenby']);
		$taken_ids = is_array($taken_ids)?$taken_ids:array();

		if(count($_POST)>0){
			if(isset($_POST['Bookinfo']['give']) and $_POST['Bookinfo']['give'] > 0){
				if(in_array($_POST['Bookinfo']['give'],$taken_ids)){
					Yii::$app->session->setFlash('error','Этому ученику уже была выдана эта книга!');
				}else{
					$taken_ids[]=$_POST['Bookinfo']['give'];
					$book['takenby']=serialize($taken_ids);
					if($book->save()){
						Yii::$app->session->setFlash('success','Книга успешно выдана');
						return $this->refresh();
					}else{
						Yii::$app->session->setFlash('error','Ошибка выдачи книги');
					}
				}
			}
			if(isset($_POST['Bookinfo']['take'])){
				$index = array_search($_POST['Bookinfo']['take'],$taken_ids);
				if($index >= 0){
					unset($taken_ids[$index]);
					$taken_ids = array_values($taken_ids);
					$book['takenby']=serialize($taken_ids);
					if($book->save()){
						Yii::$app->session->setFlash('success','Книга успешно возвращена на полку');
						return $this->refresh();
					}else{
						Yii::$app->session->setFlash('error','Ошибка возврата книги');
					}
				}else{
					Yii::$app->session->setFlash('error','У этого ученика нет этой книги на руках');
				}
			}
		}
		
		$author = Authors::findOne($book['author_id']);
		
		$taken_num = count($taken_ids);
		$available = $book['sum'] - $taken_num;
		$bookcase = Bookcases::findOne($book['bookcaseid']);
		$bookcase = $bookcase['title'];
		$takenby = array();
		$students = Students::find()->all();
		$studbooks = array();
		$sc = count($students);
		for($i=0;$i<$sc;$i++){
			$studbooks[$students[$i]['id']] = count(Books::find()->filterWhere(['like', 'takenby', '"'.$students[$i]['id'].'"'])->all());
		}

		for($i=0;$i<$taken_num;$i++){
			$takenby[] = Students::findOne($taken_ids[$i]);
		}
		$this->view->title = $book['title'];
		return $this->render('bookinfo',compact('model','book','author','available','bookcase','takenby','students','taken_ids','studbooks'));
		
	}
	public function actionBcform($id="new"){
		\Yii::$app->language = 'ru'; 
		$model = new Bookcases();
		if($id!="new"){
			$model = Bookcases::findOne($id);
		}
		if($model->load(Yii::$app->request->post())){

			if($model->save()){
				Yii::$app->session->setFlash('success','Данные приняты');
				return $this->redirect(['library/bookcase']);
			}else{
				Yii::$app->session->setFlash('error','Ошибка');
			}
		}
		
		$this->view->title = ($id=="new"?"Добавление":"Правка").' шкафа';
		return $this->render('bcform',compact('model'));
	}
	
	public function actionAuthor(){
		$authors = Authors::find()->all();
		$this->view->title = 'Авторы';
		return $this->render('author',compact('authors'));
	}
	public function actionAuthorinfo($id=1){
		$author = Authors::findOne($id);
		$books = Books::find()->where(['author_id'=>$id])->all();
		$this->view->title = $author['name'];
		$bc = count($books);
		$availableArr = array();
		for($i=0;$i<$bc;$i++){
			$taken_ids = unserialize($books[$i]['takenby']);
			$taken_ids = is_array($taken_ids)?$taken_ids:array();
			$taken_num = count($taken_ids);
			$availableArr[$books[$i]['id']] = $books[$i]['sum'] - $taken_num;
		}
		return $this->render('authorinfo',compact('author','books','availableArr'));
	}
	public function actionAform($id="new"){
		\Yii::$app->language = 'ru'; 
		$model = new Authors();
		if($id!="new"){
			$model = Authors::findOne($id);
		}
		if($model->load(Yii::$app->request->post())){

			if($model->save()){
				Yii::$app->session->setFlash('success','Данные приняты');
				return $this->redirect(['library/author']);
			}else{
				Yii::$app->session->setFlash('error','Ошибка');
			}
		}
		$books = Books::find()->where(['author_id'=>$id])->all();
		$bc = count($books);
		$availableArr = array();
		for($i=0;$i<$bc;$i++){
			$taken_ids = unserialize($books[$i]['takenby']);
			$taken_ids = is_array($taken_ids)?$taken_ids:array();
			$taken_num = count($taken_ids);
			$availableArr[$books[$i]['id']] = $books[$i]['sum'] - $taken_num;
		}
		$this->view->title = ($id=="new"?"Добавление":"Правка").' автора';
		return $this->render('aform',compact('model','author','books','availableArr'));
	}
	
	public function actionStudent(){
		$students = Students::find()->all();
		$this->view->title = 'Ученики';
		return $this->render('student',compact('students'));
	}
	public function actionSform($id="new"){
		\Yii::$app->language = 'ru'; 
		
		$model = new Students();
		$takenbooks = array();
		if($id!="new"){
			$model = Students::findOne($id);
			$takenbooks = Books::find()->filterWhere(['like', 'takenby', '"'.$id.'"'])->all();
		}
		if($model->load(Yii::$app->request->post())){

			if($model->save()){
				Yii::$app->session->setFlash('success','Данные приняты');
				return $this->redirect(['library/student']);
			}else{
				Yii::$app->session->setFlash('error','Ошибка');
			}
		}
		
		$this->view->title = ($id=="new"?"Добавление":"Правка").' ученика';
		return $this->render('sform',compact('model','takenbooks'));
	}
	
	public function actionBook(){
		$books = Books::find()->all();
		$this->view->title = 'Книги';
		return $this->render('book',compact('books'));
	}
	public function actionBform($id="new"){
		\Yii::$app->language = 'ru'; 
		
		$model = new Books();
		if($id!="new"){
			$model = Books::findOne($id);
		}
		if($model->load(Yii::$app->request->post())){

			if($model->save()){
				Yii::$app->session->setFlash('success','Данные приняты');
				return $this->redirect(['library/book']);
			}else{
				Yii::$app->session->setFlash('error','Ошибка');
			}
		}
		$author_ids = Authors::find()->all();
		$ain = count($author_ids);
		$aids = array('0'=>'Выберите автора');
		for($i=0;$i<$ain;$i++){
			$aids[(string)$author_ids[$i]['id']]=$author_ids[$i]['name'];
		}
		
		$bc = Bookcases::find()->all();
		
		$this->view->title = ($id=="new"?"Добавление":"Правка").' книги';
		return $this->render('bform',compact('model','aids','bc'));
	}
}
?>