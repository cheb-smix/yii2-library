<?php

$this->title = 'Авторы';

$colspan = 5;
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="?r=author/edit&id=0" class="btn btn-success btn-lg">Добавить нового автора</a>
        </div>
        <div class="col-12">
            <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Имя</th>
                    <th>Кол-во книг в базе</th>
                    <th>Кол-во экземпляров в базе</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($authors as $author){ ?>
                <tr data-id="<?php echo $author["id"]; ?>">
                    <td><img src="<?php echo $author["img"]; ?>" alt="<?php echo $author["name"]; ?>" width=30></td>
                    <td><?php echo $author["name"]; ?></td>
                    <td><?php echo count($author["books"]); ?></td>
                    <td><?php echo 0; ?></td>
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
    location.href = '?r=author/edit&id='+$(this).closest("tr").attr("data-id");
}).delegate(".view","click",function(){
    location.href = '?r=author&id='+$(this).closest("tr").attr("data-id");
});
JS;
$this->registerJs( $js );
?>
