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
$this->registerCss('legend {width:inherit; padding:0 10px; order-bottom:none;} legend {font-size: 1.2em !important;font-weight: bold !important;text-align: left !important;}');
$titles = array('Books'=>'Книги','Bookcases'=>'Шкафы','Authors'=>'Авторы','Students'=>'Ученики');
$forms = array('Books'=>'bform','Bookcases'=>'bcform','Authors'=>'aform','Students'=>'sform');
$infos = array('Books'=>'bookinfo','Authors'=>'authorinfo');
?>
<div class="site-search">
    <h1><?= Html::encode($this->title) ?></h1>
	<?
	$a = 0;
	foreach($found as $k=>$v){
		$c=is_array($v)?count($v):0;
		$a+=$c;
	}
	if($a>0){
		?><h5>В базе найдено <?= $a ?> соответствий</h5><?
	}else{
		?><h5>По Вашему запросу ничего не найдено</h5><?
	}
	foreach($found as $k=>$v){
		
		$c=is_array($v)?count($v):0;
		$a+=$c;
		if($c>0){
			?><fieldset class="form-group">
			<legend><?= $titles[$k] ?></legend>
			<?= (($k=="Authors" || $k=="Books")?'<div class=row>':'') ?><?
			for($i=0;$i<$c;$i++){
				$key = stristr($k,"Book")?"title":"name";
				if($k=="Authors" || $k=="Books"){
					?><div class="col-md-2 col-sm-3"><?= Html::a('<div class=item><div class='. ($k=="Authors"?"person":"book").'image '. ($v[$i]['img']!=""?'style="background-image:url('.$v[$i]['img'].')"':'') .'></div><div class=desc>'. $v[$i][$key] .'</div></div>', ['/library/'.$infos[$k],'id'=>$v[$i]['id']]) ?></div><?
				}else{
					?><?= Html::a('<i class="fa fa-user"></i> '.$v[$i][$key],['/library/'.$forms[$k],'id'=>$v[$i]['id']]) ?><?
				}
			}
			?><?= (($k=="Authors" || $k=="Books")?'</div>':'') ?><?
			?></fieldset><?
		}
	}
	
	?>
</div>