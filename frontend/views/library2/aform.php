<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->params['breadcrumbs'][] = ['label' => 'Библиотека', 'url' => ['/library']];
$this->params['breadcrumbs'][] = ['label' => 'Список', 'url' => ['/library/author']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css');

$js = <<< JS
$('[data-toggle="tooltip"]').tooltip({delay: { show: 500, hide: 100 }});
JS;
$this->registerJs($js);

?>
<div class="site-bookcase">
    <h1><?= Html::encode($this->title) ?></h1>
	<? if(Yii::$app->user->isGuest){ ?>
    <p>
    Для работы с библиотекой необходимо <?= Html::a('авторизоваться','?r=site/login') ?>
    </p>
	<? }else{ ?>
	<? $form = ActiveForm::begin(['options'=>['id'=>'aform']]) ?>
	<?= $form->field($model,'name')->textInput(['value'=>$model['name']])?>
	<?= Html::submitButton('Отправить',['class'=>'btn btn-success']) ?>
	<? ActiveForm::end() ?>
	<br><br>
	<legend>Информация о книгах автора в наличии</legend><? 
	$n=count($books);
	if($n>0){
		?><table class="table"><thead><th>ID</th><th>Название книги</th><th>Дата издания</th><th>Количество</th><th>В наличии</th></thead><tbody><?
		for($i=0;$i<$n;$i++){
			?><tr><td><?= $books[$i]['id'] ?></td><td><?= Html::a('<i class="fa fa-book"></i> '.$books[$i]['title'],['library/bform','id'=>$books[$i]['id']]) ?></td><td><?= $books[$i]['releasedate'] ?></td><td><?= $books[$i]['sum'] ?></td><td><?= $availableArr[$books[$i]['id']] ?></td></tr><?
		}
		?></tbody></table><?
	}else{
		?><h5>В наличии нет книг данного автора.</h5><?
	}
	?>
	<? } ?>
</div>