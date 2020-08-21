<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->params['breadcrumbs'][] = ['label' => 'Библиотека', 'url' => ['/library']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css');
$this->registerCssFile('@web/css/lib.css');
$js = <<< JS
$('[data-toggle="tooltip"]').tooltip({delay: { show: 500, hide: 100 }});
JS;
$this->registerJs($js);

$sc = count($students);
$sa = array('0'=>'Выберите ученика');
for($i=0;$i<$sc;$i++){
	if(!in_array($students[$i]['id'],$taken_ids)){
		$sa[(string)$students[$i]['id']]=$students[$i]['name'];
	}
}

?>
<div class="site-bookinfo">
    <h1><?= Html::encode($this->title) ?></h1>
	<div class=row>
	<div class="col-sm-3"><div class=bookimage <?= ($book['img']!=""?'style="background-image:url('.$book['img'].')"':'') ?>></div>
	<? if(!Yii::$app->user->isGuest){ 
	if($available>0){
	?>
	<? $form = ActiveForm::begin(['options'=>['id'=>'giveform']]) ?>
	<?= $form->field($model,'give')->dropDownList($sa)?>
	<?= Html::submitButton('Выдать книгу',['class'=>'btn btn-success btn-block']) ?>
	<? ActiveForm::end(); 
	}else{
		?><legend>Нет книг в наличии для выдачи</legend><?
	}
	?>
	<? } ?>
	</div>
	<div class="col-sm-9">
	<div class=row>
	<div class="col-sm-4">
	Автор:<br>Год издания<br>В наличии<br>Доступно<br>
	<? if(!Yii::$app->user->isGuest){ ?>
	Шкаф<br>Полка
	<? } ?>
	</div>
	<div class="col-sm-8">
	<?= Html::a('<i class="fa fa-user"></i> '.$author['name'],['library/authorinfo','id'=>$author['id']]) ?><br><?= $book['releasedate'] ?><br><?= $book['sum'] ?><br><?= $available ?><br>
	<? if(!Yii::$app->user->isGuest){ ?>
	<?= $bookcase ?><br><?= $book['shelf'] ?>
	<? } ?>
	</div>
	<? if(!Yii::$app->user->isGuest){ ?>
	<div class="col-sm-12"><br>
	<legend>Информация о выданных экземплярах</legend><? 
	$n=count($takenby);
	if($n>0){
		?><table class="table"><thead><th>ID</th><th>Имя Фамилия ученика</th><th>Книг на руках</th><th>Действия</th></thead><tbody><?
		for($i=0;$i<$n;$i++){
			?><tr><td><?= $takenby[$i]['id'] ?></td><td><?= Html::a('<i class="fa fa-user"></i> '.$takenby[$i]['name'],['library/sform','id'=>$takenby[$i]['id']]) ?></td><td><?= $studbooks[$takenby[$i]['id']] ?></td><td>
			<? $form = ActiveForm::begin(['options'=>['id'=>'takeform','style'=>'display:inline-block']]) ?>
			<?= $form->field($model,'take')->hiddenInput(['value'=>$takenby[$i]['id']])->label(false, ['style'=>'display:none']) ?>
			<?= Html::submitButton('<i class="fa fa-reply"></i>',['class'=>'btn btn-warning','data-toggle'=>'tooltip','data-original-title'=>'Вернуть книгу на полку']) ?>
			<? ActiveForm::end(); ?>
			<?= Html::a('<i class="fa fa-eye"></i>',['library/sform','id'=>$takenby[$i]['id']], ['class' => 'btn btn-primary','data-toggle'=>'tooltip','data-original-title'=>'Просмотр карточки ученика']) ?>
			</td></tr><?
		}
		?></tbody></table><?
	}else{
		?><h5>Все книги на полках. Данных о выдаче на руки нет.</h5><?
	}
	?></div>
	<? } ?>
	</div>
	</div>
	</div>

</div>