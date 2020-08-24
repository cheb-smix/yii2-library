<?php

$this->title = 'Книги';

$colspan = 5;
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Наименование</th>
                    <th>Автор</th>
                    <th>Дата выпуска</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($booklist as $bc){ ?>
                <tr class="bg-primary"><th colspan="<?php echo $colspan; ?>"><?php echo $bc["title"]; ?> <i class="fa fa-edit btn" title="Редактировать"></i></th></tr>
                <?php foreach($bc["shelfes"] as $shelf){ ?>
                    <?php if(count($shelf["exemplars"])==0) continue; ?>
                    <tr><th colspan="<?php echo $colspan; ?>"><?php echo $shelf["title"]; ?></th></tr>
                    <?php foreach($shelf["exemplars"] as $exemplar){ ?>
                        <tr data-id="<?php echo $exemplar["book"]["id"]; ?>">
                            <td><img src="<?php echo $exemplar["book"]["img"]; ?>" alt="<?php echo $exemplar["book"]["title"]; ?>" width=30></td>
                            <td><?php echo $exemplar["book"]["title"]; ?></td>
                            <td><?php echo $exemplar["book"]["author"]["name"]; ?></td>
                            <td><?php echo $exemplar["book"]["releasedate"]; ?></td>
                            <td>
                                <button class="btn give btn-success" title="Выдача"><i class="fa fa-reply"></i></button>
                                <button class="btn view btn-info" title="Просмотр"><i class="fa fa-eye"></i></button>
                                <button class="btn edit btn-primary" title="Правка"><i class="fa fa-pencil"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                <tr><td></td></tr>
            <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$js = <<< JS
$(document).delegate(".edit","click",function(){
    location.href = '?r=book/edit&id='+$(this).closest("tr").attr("data-id");
}).delegate(".view","click",function(){
    location.href = '?r=book&id='+$(this).closest("tr").attr("data-id");
}).delegate(".give","click",function(){
    alert($(this).closest("tr").attr("data-id"));
});
JS;
$this->registerJs( $js );
?>
