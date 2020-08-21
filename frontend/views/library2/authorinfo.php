<?php


use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Библиотека', 'url' => ['/library']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css');
$this->registerCssFile('@web/css/lib.css');
$js = <<< JS
$('[data-toggle="tooltip"]').tooltip({delay: { show: 500, hide: 100 }});
JS;
$this->registerJs($js);

?>
<div class="site-authorinfo">
    <h1><?= Html::encode($this->title) ?></h1>
	<div class=row>
	<div class="col-sm-3"><div class=personimage></div>
	</div>
	<div class="col-sm-9">
	<?= $author['description'] ?><br><br>
	<legend>Информация о книгах автора в наличии</legend><? 
	$n=count($books);
	if($n>0){
		?><table class="table"><thead><th>ID</th><th>Название книги</th><th>Дата издания</th><th>Количество</th><th>В наличии</th></thead><tbody><?
		for($i=0;$i<$n;$i++){
			?><tr><td><?= $books[$i]['id'] ?></td><td><?= Html::a('<i class="fa fa-book"></i> '.$books[$i]['title'],['library/bookinfo','id'=>$books[$i]['id']]) ?></td><td><?= $books[$i]['releasedate'] ?></td><td><?= $books[$i]['sum'] ?></td><td><?= $availableArr[$books[$i]['id']] ?></td></tr><?
		}
		?></tbody></table><?
	}else{
		?><h5>В наличии нет книг данного автора.</h5><?
	}
	?>
	</div>
	</div>

</div>