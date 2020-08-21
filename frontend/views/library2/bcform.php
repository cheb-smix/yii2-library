<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->params['breadcrumbs'][] = ['label' => 'Библиотека', 'url' => ['/library']];
$this->params['breadcrumbs'][] = ['label' => 'Список', 'url' => ['/library/bookcase']];
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
	<? $form = ActiveForm::begin(['options'=>['id'=>'bcform']]) ?>
	<?= $form->field($model,'title')->textInput(['value'=>$model['title']])?>
	<?= $form->field($model,'shelfes')->textInput(['type'=>'number','value'=>$model['shelfes']])?>
	<?= Html::submitButton('Отправить',['class'=>'btn btn-success']) ?>
	<? ActiveForm::end() ?>
	
	<? } ?>
</div>