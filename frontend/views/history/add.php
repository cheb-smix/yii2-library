<?php

$this->title = "Выдача экземпляра";
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

if(!$exemplar["book"]["img"]) $exemplar["book"]["img"] = "images/default_book.png";

?>
<div class="col-md-3">
    <img src="<?php echo $exemplar["book"]["img"]; ?>" alt="<?php echo $exemplar["book"]["title"]; ?>" style="width:100%" >
</div>
<div class="col-md-9">
    <legend>Выдача экземпляра <?php echo $exemplar["book"]["title"]; ?></legend>
    <?php $form = ActiveForm::begin() ?>
        <?= $form->field($history, 'date_taken')->widget(DatePicker::classname(), [ 'dateFormat' => 'yyyy-MM-dd', 'language' => 'ru']) ?>
        <?= $form->field($history, 'exemplar_id')->hiddenInput(["value" => $exemplar["id"]])->label(false) ?>
        <?= $form->field($history, 'student_id')->dropDownList($students,[
            'prompt' => 'Укажите студента'
        ]); ?>
        <?= Html::submitButton('Выдать экземпляр', ['class' => 'btn btn-success pull-right']) ?>
    <?php ActiveForm::end() ?>
    <br>
</div>