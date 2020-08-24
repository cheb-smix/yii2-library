<?php

$this->title = 'Студенты';

$colspan = 3;
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="?r=student/edit&id=0" class="btn btn-success btn-lg">Добавить нового студента</a>
        </div>
        <div class="col-12">
            <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Имя</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($students as $student){ ?>
                <tr data-id="<?php echo $student["id"]; ?>">
                    <td><img src="<?php echo $student["img"]; ?>" alt="<?php echo $student["fio"]; ?>" width=30></td>
                    <td><?php echo $student["fio"]; ?></td>
                    <td>
                        <button class="btn view btn-info" title="Просмотр"><i class="fa fa-eye"></i></button>
                        <button class="btn edit btn-primary" title="Правка"><i class="fa fa-pencil"></i></button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$js = <<< JS
$(document).delegate(".edit","click",function(){
    location.href = '?r=student/edit&id='+$(this).closest("tr").attr("data-id");
}).delegate(".view","click",function(){
    location.href = '?r=student&id='+$(this).closest("tr").attr("data-id");
});
JS;
$this->registerJs( $js );
?>
