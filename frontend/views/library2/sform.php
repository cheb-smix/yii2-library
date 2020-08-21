<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => 'Библиотека', 'url' => ['/library']];
$this->params['breadcrumbs'][] = ['label' => 'Список', 'url' => ['/library/student']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css');

$js = <<< JS
$('[data-toggle="tooltip"]').tooltip({delay: { show: 500, hide: 100 }});
JS;
$this->registerJs($js);

?>
<div class="site-student">
    <h1><?= Html::encode($this->title) ?></h1>
	<? if(Yii::$app->user->isGuest){ ?>
    <p>
    Для работы с библиотекой необходимо <?= Html::a('авторизоваться','?r=site/login') ?>
    </p>
	<? }else{ ?>
	<? $form = ActiveForm::begin(['options'=>['id'=>'sform']]) ?>
	<?= $form->field($model,'name')->textInput(['value'=>$model['name']])?>
	<?= Html::submitButton('Отправить',['class'=>'btn btn-success']) ?>
	<? ActiveForm::end() ?><br><br>
	<legend>Информация о выданных книгах</legend>
	<?
	$n=count($takenbooks);
	if($n>0){
		?><table class="table"><thead><th>ID</th><th>Название книги</th><th>Действия</th></thead><tbody><?
		for($i=0;$i<$n;$i++){
			?><tr><td><?= $takenbooks[$i]['id'] ?></td><td><?= Html::a('<i class="fa fa-book"></i> '.$takenbooks[$i]['title'],['library/bform','id'=>$takenbooks[$i]['id']]) ?></td><td>
			<? $form = ActiveForm::begin(['options'=>['id'=>'takeform','style'=>'display:inline-block']]) ?>
			<?= $form->field($model,'take')->hiddenInput(['value'=>$takenbooks[$i]['id']])->label(false, ['style'=>'display:none']) ?>
			<?= Html::submitButton('<i class="fa fa-reply"></i>',['class'=>'btn btn-warning','data-toggle'=>'tooltip','data-original-title'=>'Вернуть книгу на полку']) ?>
			<? ActiveForm::end(); ?>
			</td></tr><?
		}
		?></tbody></table><?
	}else{
		?><h5>Нет данных о выданных книгах.</h5><?
	}
	} ?>
</div>