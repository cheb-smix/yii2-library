<?php


use yii\helpers\Html;
$this->params['breadcrumbs'][] = ['label' => 'Библиотека', 'url' => ['/library']];
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
	<? }else{ 
	$n=count($bookcases);
	?><a href="?r=library/bcform&id=new" class="btn btn-primary btn-block"><i class="fa fa-plus" ></i> Добавить новый шкаф</a><?
	for($i=0;$i<$n;$i++){
		?><a href="?r=library/bcform&id=<?= $bookcases[$i]['id'] ?>" class="btn btn-default btn-block"><i class="fa fa-tasks" ></i> <?= ($i+1).' '.$bookcases[$i]['title'] ?></a><?
	}
	?>
	<? } ?>
</div>