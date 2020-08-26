<?php

$this->title = $author["name"];
use yii\helpers\Html;
use yii\widgets\ActiveForm;

if (!$author["img"]) $author["img"] = "images/default_user.png";
?>
<div class="col-md-3">
    <img src="<?php echo $author["img"]; ?>" alt="<?php echo $author["name"]; ?>" style="width:100%" >
</div>
<div class="col-md-9">
    <?php $form = ActiveForm::begin() ?>
        <?= $form->field($author, 'name') ?>
        <?= $form->field($author, 'description')->textarea(['rows' => '15']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success pull-right']) ?>
    <?php ActiveForm::end() ?>
</div>