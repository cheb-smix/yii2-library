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
                    <th>Дата выпуска</th>
                    <th>Количество</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($booklist as $bc){ ?>
                <tr class="bg-primary"><th colspan="<?php echo $colspan; ?>"><?php echo $bc["title"]; ?> <button class="btn btn-info btn-sm">Редактировать</button></th></tr>
                <?php foreach($bc["shelfes"] as $shelf){ ?>
                    <?php if(count($shelf["books"])==0) continue; ?>
                    <tr><th colspan="<?php echo $colspan; ?>"><?php echo $shelf["title"]; ?></th></tr>
                    <?php foreach($shelf["books"] as $book){ ?>
                        <tr data-id="<?php echo $book["id"]; ?>">
                            <td><img src="<?php echo $book["img"]; ?>" alt="<?php echo $book["title"]; ?>" width=30></td>
                            <td><?php echo $book["title"]; ?></td>
                            <td><?php echo $book["releasedate"]; ?></td>
                            <td><?php echo $book["count"]; ?></td>
                            <td>
                                <button class="btn give btn-success">Выдача</button>
                                <button class="btn edit btn-info">Правка</button>
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
<script>
document.querySelector(".edit").onclick = function(){
    location.href = '?r=book';
}/*
$(document).delegate(".give","click",function(){
    alert($(this).closest("tr").attr("data-id"));
});*/
</script>