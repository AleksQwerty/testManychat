<?php
require_once (ROOT . '/controllers/DepartmentsController.php');
require_once (ROOT . '/views/main/header.php');
?>
    <a href="/departments/create/" class="btn btn-success" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i></a>
    <table class="table table-striped table-hover">
                <thead class="thead-dark">
                <th>ID</th>
                <th>Наименование отдела</th>
                <th>Action</th>
                </thead>
                <tbody>
                <?php foreach ($departmentList as $item) {?>
                    <tr>
                        <td><?=$item->id?></td>
                        <td><?=$item->name?></td>
                        <td>
                            <a href="/departments/update/<?=$item->id?>" class="btn btn-success" data-toggle="modal" data-target="#update<?=$item->id?>"><i class="fa fa-edit"></i></a>
                            <a href="/departments/delete/<?=$item->id?>" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$item->id?>"><i class="fa fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <!-- Modal Update-->
                    <div class="modal fade" id="update<?=$item->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Изменить запись</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="update/<?=$item->id?>" method="post">
                                        <div class="form-group">
                                            <small>Наименование Отдела</small>
                                            <input type="text" class="form-control" name="name" value="<?=$item->name?>" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Сохранить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Update-->
                    <!-- Modal delete-->
                    <div class="modal fade" id="delete<?=$item->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Удалить  запись № <?=$item->id;?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <form action="delete/<?=$item->id?>" method="post">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                        <button type="submit" class="btn btn-danger" name="submit" value="submit">Удалить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal delete-->
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
<!-- Modal Create-->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить запись</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/departments/create/" method="post">
                    <div class="form-group">
                        <small>Наименование Отдела</small>
                        <input type="text" class="form-control" name="name" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once (ROOT . '/views/main/footer.php');
?>

