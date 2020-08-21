<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css');

$js = <<< JS
$('[data-toggle="tooltip"]').tooltip({delay: { show: 500, hide: 100 }});
$('#searcher').on('keydown',function(e){
	if(e.keyCode==13){
		$('#sbutton').click();
	}
});
JS;
$this->registerJs($js);
$this->registerCssFile('@web/css/lib.css');
$this->registerCss('.btns i{font-size:40px !important;margin-top:11px}.btns .btn{width:70px;height:70px;text-align:center;}');
?>
<div class="site-library">
    <h1><?= Html::encode($this->title) ?></h1>
	<? if(Yii::$app->user->isGuest){ ?>
    <p>
    Для работы с библиотекой необходимо <?= Html::a('авторизоваться','?r=site/login') ?>
    </p>
	<? }else{ ?>
	<div class="input-group btns">
	<a href="?r=library/bookcase" class="btn btn-primary" data-toggle="tooltip" title="" data-original-title="Книжные шкафы"><i class="fa fa-tasks" ></i></a> 
	<a href="?r=library/author" class="btn btn-primary" data-toggle="tooltip" title="" data-original-title="Авторы"><i class="fa fa-tags" ></i></a> 
	<a href="?r=library/student" class="btn btn-primary" data-toggle="tooltip" title="" data-original-title="Ученики"><i class="fa fa-user" ></i></a> 
	<a href="?r=library/book" class="btn btn-primary" data-toggle="tooltip" title="" data-original-title="Книги"><i class="fa fa-book" ></i></a> 
	</div>
	<? } ?>
	<? $form = ActiveForm::begin(['action'=>['library/search'],'options'=>['id'=>'searchform','style'=>'display:inline-block']]) ?>
	  <?= $form->field($model,'search')->hiddenInput()->label(false, ['style'=>'display:none'])?>
	<? ActiveForm::end() ?>
	<div class="input-group">
	  <input type="text" class="form-control" placeholder="Поиск в библиотеке" aria-describedby="sbutton" id=searcher >
	  <span class="input-group-addon" id="sbutton" style="cursor:pointer" onclick="$('#library-search').val($('#searcher').val()); $('#searchform').submit()"><i class="fa fa-search"></i></span>
	</div><br>
	<div class=row>
	<?
	$bn = count($books);
	for($i=0;$i<$bn;$i++){
		?><div class="col-md-2 col-sm-3"><?= Html::a('<div class=item><div class=bookimage '. ($books[$i]['img']!=""?'style="background-image:url('.$books[$i]['img'].')"':'') .'></div><div class=desc>'. $books[$i]['title'] .'<br>'. $books[$i]['releasedate'] .'<br>'. $authorsarr[$books[$i]['author_id']] .'</div></div>', ['/library/bookinfo','id'=>$books[$i]['id']]) ?>
		</div><?
	}
	?>
	</div>
</div>