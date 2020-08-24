<?php

$this->title = $book["title"];

?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <img src="<?php echo $book["img"]; ?>" alt="<?php echo $book["title"]; ?>" style="width: 100%" >
        </div>
        <div class="col-md-9">
            <h1><?php echo $book["title"]; ?> <a class="btn btn-sm btn-info" href="?r=book/edit&id=<?php echo $book["id"]; ?>">Правка</a></h1>
            <table class="table">
                <tr><td>Автор</td><td><?php echo $book["author"]["name"]; ?></td></tr>
                <tr><td>Дата выпуска</td><td><?php echo $book["releasedate"]; ?></td></tr>
                <tr><td>Количество экземпляров</td><td><?php echo count($book["exemplars"]); ?></td></tr>
            </table>
        </div>
    </div>
</div>