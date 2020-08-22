<?php

$this->title = $bookform["title"];
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="col-md-3">
    <img src="<?php echo $bookform["img"]; ?>" alt="<?php echo $bookform["title"]; ?>" style="width:100%" >
</div>
<div class="col-md-9">
    <?php $form = ActiveForm::begin() ?>
        <?= $form->field($bookform, 'title') ?>
        <?= $form->field($bookform, 'releasedate') ?>
        <?= $form->field($bookform, 'author_id')->dropDownList($authors,[
            'prompt' => 'Укажите автора'
        ]); ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end() ?>
</div>