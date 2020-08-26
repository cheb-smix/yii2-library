<?php

$this->title = 'Книги';

$colspan = 5;
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="?r=book/edit&id=0" class="btn btn-success btn-lg">Добавить новую книгу</a>
        </div>
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
            <?php foreach ($booklist as $bc) { ?>
                <tr class="bg-primary"><th colspan="<?php echo $colspan; ?>"><?php echo $bc["title"]; ?> <i class="fa fa-edit btn" title="Редактировать"></i></th></tr>

                <?php foreach ($bc["shelfes"] as $shelf) { ?>
                    <?php if(count($shelf["exemplars"])==0) continue; ?>
                    <tr><th colspan="<?php echo $colspan; ?>"><?php echo $shelf["title"]; ?></th></tr>

                    <?php foreach ($shelf["exemplars"] as $exemplar) { ?>
                        <tr data-id="<?php echo $exemplar["book"]["id"]; ?>">
                            <td><img src="<?php echo $exemplar["book"]["img"]; ?>" alt="<?php echo $exemplar["book"]["title"]; ?>" width=30></td>
                            <td><?php echo $exemplar["book"]["title"]; ?></td>
                            <td><?php echo $exemplar["book"]["author"]["name"]; ?></td>
                            <td><?php echo $exemplar["book"]["releasedate"]; ?></td>
                            <td>
                            <?php if (!$exemplar["onhand"]) { ?>
                                <a href="?r=history/add&exemplar_id=<?php echo $exemplar["id"]; ?>" title="Выдача" class="btn view btn-success"><i class="fa fa-reply"></i></a>
                            <?php } else { ?>
                                <a href="?r=history/add&exemplar_id=<?php echo $exemplar["id"]; ?>" title="Экземпляр на руках" class="btn view btn-success" disabled><i class="fa fa-reply"></i></a>
                            <?php } ?>
                                <a href="?r=book&id=<?php echo $exemplar["book"]["id"]; ?>" title="Просмотр" class="btn view btn-info"><i class="fa fa-eye"></i></a>
                                <a href="?r=book/edit&id=<?php echo $exemplar["book"]["id"]; ?>" title="Правка" class="btn edit btn-primary"><i class="fa fa-pencil"></i></a>
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
