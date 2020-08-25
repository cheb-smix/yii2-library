<?php


use app\models\Student;

$this->title = $book["title"];
$ttl_onhand = 0;
$students = [];
foreach($book["exemplars"] as $ex){
    if($ex["onhand"]){
        $students[$ex["onhand"]["student_id"]] = Student::findOne($ex["onhand"]["student_id"]);
        $ttl_onhand++;
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <img src="<?php echo $book["img"]; ?>" alt="<?php echo $book["title"]; ?>" style="width: 100%" >
        </div>
        <div class="col-md-9">
            <h1><?php echo $book["title"]; ?> <a class="btn btn-sm btn-info" href="?r=book/edit&id=<?php echo $book["id"]; ?>">Правка</a></h1>
            <table class="table">
                <tr><td>Автор</td><td><a href="?r=author&id=<?php echo $book["author_id"]; ?>"><?php echo $book["author"]["name"]; ?></a></td></tr>
                <tr><td>Дата выпуска</td><td><?php echo $book["releasedate"]; ?></td></tr>
                <tr><td>Количество экземпляров</td><td><?php echo count($book["exemplars"]); ?></td></tr>
                <tr><td>Экземпляров на руках</td><td><?php echo $ttl_onhand; ?></td></tr>
            </table>
            <br>
            <?php if($ttl_onhand){ ?>
            <h3>Экземпляры на руках</h3>
                <table class="table">
                <tr><th></th><th>Студент</th><th>Действия</th></tr>
                <?php foreach($book["exemplars"] as $ex){ ?>
                    <?php if(!$ex["onhand"]) continue; ?>
                    <tr>
                    <td><img src="<?php echo $students[$ex["onhand"]["student_id"]]["img"]; ?>" alt="<?php echo $students[$ex["onhand"]["student_id"]]["fio"]; ?>" style="width: 40px" ></td>
                    <td><?php echo $students[$ex["onhand"]["student_id"]]["fio"]; ?></td>
                    <td><a href="?r=history/return&id=<?php echo $ex["onhand"]["id"]; ?>" class="btn view btn-primary" title="Вернуть"><i class="fa fa-reply"></i></a></td>
                    </tr>
                <?php } ?>
                </table>
            <?php } ?>
        </div>
    </div>
</div>