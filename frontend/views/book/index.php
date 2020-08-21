<?php

$this->title = 'Библиотека';

?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <img src="<?php echo $book["img"]; ?>" alt="<?php echo $book["title"]; ?>" style="height: 40vh; float: left; margin: 2vh;" >
            <legend><?php echo $book["title"]; ?></legend>
            <p><?php echo $book["author"]["name"]; ?> (<?php echo $book["releasedate"]; ?>)</p>
        </div>
    </div>
</div>