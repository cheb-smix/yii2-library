<?php

$this->title = 'История';

$colspan = 6;
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Студент</th>
                    <th>Книга</th>
                    <th>Дата выдачи</th>
                    <th>Дата возврата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($history as $h) { ?>
                <tr>
                    <td><img src="<?php echo $h["student"]["img"]; ?>" alt="<?php echo $h["student"]["fio"]; ?>" width=30><img src="<?php echo $h["exemplar"]["book"]["img"]; ?>" alt="<?php echo $h["exemplar"]["book"]["title"]; ?>" width=30></td>
                    <td><a href="?r=student&id=<?php echo $h["student"]["id"]; ?>"><?php echo $h["student"]["fio"]; ?></a></td>
                    <td><a href="?r=book&id=<?php echo $h["exemplar"]["book"]["id"]; ?>"><?php echo $h["exemplar"]["book"]["title"]; ?></a></td>
                    <td><?php echo $h["date_taken"]; ?></td>
                    <td><?php echo $h["date_returned"]; ?></td>
                    <td>
                        <?php if ($h["date_returned"]) { ?>
                            <a href="?r=history/return&id=<?php echo $h["id"]; ?>" class="btn view btn-primary" title="Экземпляр возвращён" disabled><i class="fa fa-reply"></i></a>
                        <?php } else { ?>
                            <a href="?r=history/return&id=<?php echo $h["id"]; ?>" class="btn view btn-primary" title="Вернуть"><i class="fa fa-reply"></i></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
</div>