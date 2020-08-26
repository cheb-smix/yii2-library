<?php

$this->title = $student["fio"];
$ttl_onhand = 0;
foreach ($student["history"] as $history) if (!$history["date_returned"]) $ttl_onhand++;
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <img src="<?php echo $student["img"]; ?>" alt="<?php echo $student["fio"]; ?>" style="width: 100%" >
        </div>
        <div class="col-md-9">
            <h1><?php echo $student["fio"]; ?> <a class="btn btn-sm btn-info" href="?r=student/edit&id=<?php echo $student["id"]; ?>">Правка</a></h1>
            <table class="table">
                <tr><td>Имя</td><td><?php echo $student["fio"]; ?></td></tr>
                <tr><td>Записей в истории</td><td><?php echo count($student["history"]); ?></td></tr>
                <tr><td>Книг на руках</td><td><?php echo $ttl_onhand; ?></td></tr>
            </table>
            <?php if ($ttl_onhand) { ?>
            <br>
            <h3>Книги на руках</h3>
            <table class="table">
            <tr><th></th><th>Наименование</th><th>Автор</th><th>Дата выдачи</th><th>Действия</th></tr>
            <?php foreach ($student["history"] as $history) { ?>
                <?php if ($history["date_returned"]) continue; ?>
                <tr>
                    <td><img src="<?php echo $history["exemplar"]["book"]["img"]; ?>" alt="<?php echo $history["exemplar"]["book"]["title"]; ?>" width=30></td>
                    <td><a href="?r=book&id=<?php echo $history["exemplar"]["book"]["id"]; ?>"><?php echo $history["exemplar"]["book"]["title"]; ?></a></td>
                    <td><a href="?r=author&id=<?php echo $history["exemplar"]["book"]["author"]["id"]; ?>"><?php echo $history["exemplar"]["book"]["author"]["name"]; ?></a></td>
                    <td><?php echo $history["date_taken"]; ?></td>
                    <td><a class="btn btn-info" href="?r=history/return&id=<?php echo $history["id"]; ?>">Вернуть</a></td>
                </tr>
            <?php } ?>
            </table>
            <br>
            <?php } ?>

            <?php if (count($student["history"]) > $ttl_onhand) { ?>
            <h3>История</h3>
            <table class="table">
            <tr><th></th><th>Наименование</th><th>Автор</th><th>Дата выдачи</th><th>Дата возврата</th></tr>
            <?php foreach ($student["history"] as $history) { ?>
                <?php if (!$history["date_returned"]) continue; ?>
                <tr>
                    <td><img src="<?php echo $history["exemplar"]["book"]["img"]; ?>" alt="<?php echo $history["exemplar"]["book"]["title"]; ?>" width=30></td>
                    <td><a href="?r=book&id=<?php echo $history["exemplar"]["book"]["id"]; ?>"><?php echo $history["exemplar"]["book"]["title"]; ?></a></td>
                    <td><a href="?r=author&id=<?php echo $history["exemplar"]["book"]["author"]["id"]; ?>"><?php echo $history["exemplar"]["book"]["author"]["name"]; ?></a></td>
                    <td><?php echo $history["date_taken"]; ?></td>
                    <td><?php echo $history["date_returned"]; ?></td>
                </tr>
            <?php } ?>
            </table>
            <?php } ?>
        </div>
    </div>
</div>