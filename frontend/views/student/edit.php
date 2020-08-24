<?php

$this->title = $student["fio"];
use yii\helpers\Html;
use yii\widgets\ActiveForm;

if(!$student["img"]) $student["img"] = "images/default_user.png";
?>
<div class="col-md-3">
    <img src="<?php echo $student["img"]; ?>" alt="<?php echo $student["fio"]; ?>" style="width:100%" >
</div>
<div class="col-md-9">
    <?php $form = ActiveForm::begin() ?>
        <?= $form->field($student, 'fio') ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success pull-right']) ?>
    <?php ActiveForm::end() ?>
</div>