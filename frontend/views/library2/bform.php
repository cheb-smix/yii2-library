<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->params['breadcrumbs'][] = ['label' => 'Библиотека', 'url' => ['/library']];
$this->params['breadcrumbs'][] = ['label' => 'Список', 'url' => ['/library/book']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css');

$bcc = count($bc);
$bcs = array('0'=>'Выберите шкаф хранения');
$bcj = array();
for($i=0;$i<$bcc;$i++){
	$bcs[(string)$bc[$i]['id']]=$bc[$i]['title'];
	$bcj[(string)$bc[$i]['id']]=array('title'=>$bc[$i]['title'],'shelfes'=>$bc[$i]['shelfes']);
}
$shelfes = array();
for($i=1;$i<$bcj[$model['bookcaseid']]['shelfes'];$i++){
	$shelfes[$i]=$i;
}
$js = <<< JS
$('[data-toggle="tooltip"]').tooltip({delay: { show: 500, hide: 100 }});
$('#books-bookcaseid').on('change',function(){
	if(this.value != 0){
		$('#books-shelf').html('');
		$('#books-shelf').append('<option value=0 selected>Выберите полку</option>');
		for(i=1;i<=bcs[this.value]['shelfes'];i++){
			$('#books-shelf').append('<option value="'+i+'">'+i+'</option>');
		}
	}
});
JS;

$this->registerJs("var bcs = JSON.parse('".json_encode($bcj,JSON_UNESCAPED_UNICODE)."');");
$this->registerJs($js);
?>
<div class="site-bookcase">
    <h1><?= Html::encode($this->title) ?></h1>
	<? if(Yii::$app->user->isGuest){ ?>
    <p>
    Для работы с библиотекой необходимо <?= Html::a('авторизоваться','?r=site/login') ?>
    </p>
	<? }else{ ?>
	<? $form = ActiveForm::begin(['options'=>['id'=>'bform']]) ?>
	<?= $form->field($model,'title')->textInput(['value'=>$model['title']])?>
	<?= $form->field($model,'releasedate')->textInput(['type'=>'date','value'=>$model['releasedate']])?>
	<?= $form->field($model,'author_id')->dropDownList($aids)?>
	<?= $form->field($model,'sum')->textInput(['type'=>'number','value'=>(isset($model['sum'])?$model['sum']:1)])?>
	<?= $form->field($model,'bookcaseid')->dropDownList($bcs)?>
	<?= $form->field($model,'shelf')->dropDownList($shelfes)?>
	<?= Html::submitButton('Отправить',['class'=>'btn btn-success']) ?>
	<? ActiveForm::end() ?>
	
	<? } ?>
</div>