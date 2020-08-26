<?php

$this->title = $author["name"];

?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <img src="<?php echo $author["img"]; ?>" alt="<?php echo $author["name"]; ?>" style="width: 100%" >
        </div>
        <div class="col-md-9">
            <h1><?php echo $author["name"]; ?> <a class="btn btn-sm btn-info" href="?r=author/edit&id=<?php echo $author["id"]; ?>">Правка</a></h1>
            <table class="table">
                <tr><td>Имя</td><td><?php echo $author["name"]; ?></td></tr>
                <tr><td>Описание</td><td><?php echo $author["description"]; ?></td></tr>
                <tr><td>Количество книг в базе</td><td><?php echo count($author["books"]); ?></td></tr>
            </table>
            <h4><strong>Книги в базе</strong></h4>
            <table class="table">
            <tr><th>Наименование</th><th>Количество экземпляров</th><th>Из них на руках</th></tr>
            <?php foreach ($author["books"] as $book) { ?>
                <?
                $onhand = 0;
                foreach ($book["exemplars"] as $ex) if($ex["onhand"]) $onhand++;
                ?>
                <tr><td><a href="?r=book&id=<?php echo $book["id"]; ?>"><?php echo $book["title"]; ?></a></td><td><?php echo count($book["exemplars"]); ?></td><td><?php echo $onhand; ?></td></tr>
            <?php } ?>
            </table>
        </div>
    </div>
</div>