<?php

$this->title = $book["title"];
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$excnt = count($exemplars);
$script = <<< JS
let excnt = $excnt ;
$(".addExemplar").on("click",function(){
    let h = $(".exemplars .col-md-6:last-child").html();
    let ptrn = excnt-1
    h = h.replace(excnt,excnt+1).split(excnt-1).join(excnt);
    $(".exemplars").append('<div class="col-md-6">'+h+'</div>');
    $('#exemplar-'+excnt+'-id').val(0);
    $('#exemplar-'+excnt+'-shelf_id option:first-child').attr("selected","selected");
    excnt++;
});
$(document).delegate(".btn-danger","click",function(){
    let index = $(this).attr("data-index");
    $('#exemplar-'+index+'-book_id').val(0);
    $(this).closest(".col-md-6").hide("slow");
});
JS;
$this->registerJs( $script );
?>
<div class="col-md-3">
    <img src="<?php echo $book["img"]; ?>" alt="<?php echo $book["title"]; ?>" style="width:100%" >
</div>
<div class="col-md-9">
    <?php $form = ActiveForm::begin() ?>
        <?= $form->field($book, 'title') ?>
        <?= $form->field($book, 'releasedate') ?>
        <?= $form->field($book, 'author_id')->dropDownList($authors,[
            'prompt' => 'Укажите автора'
        ]); ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end() ?>
    <br>
    
    <?php $form = ActiveForm::begin() ?>
        <div class="row exemplars">
        <? foreach($exemplars as $index => $exemplar){ ?>
            <div class="col-md-6">
            <?= $form->field($exemplar, "[$index]id")->hiddenInput()->label('Экземпляр '.($index+1)) ?>
            <?= $form->field($exemplar, "[$index]book_id")->hiddenInput()->label(false) ?>
            <div class="input-group">

                <?= $form->field($exemplar, "[$index]shelf_id")->dropDownList($shelfes,[
                'prompt' => 'Укажите полку'
            ])->label(false); ?>

                <span class="input-group-btn">
                <?php if(!$exemplar["onhand"]){ ?>
                    <?= Html::button("<i class='fa fa-trash'></i>", ['class' => 'btn btn-danger', 'data-index'=>$index, 'title' => 'Удалить']) ?>
                <?php }else{ ?>
                    <?= Html::button("<i class='fa fa-trash'></i>", ['class' => 'btn btn-danger', 'data-index' => $index, 'disabled' => true, 'title' => 'Экземпляр на руках. Удаление не возможно!']) ?>
                <?php } ?>
                </span>
            </div>
            <br>
            </div>
        <? } ?>
        </div>
        <?= Html::button('Добавить экземпляр', ['class' => 'btn btn-primary addExemplar']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success pull-right']) ?>
    <?php ActiveForm::end() ?>
</div>