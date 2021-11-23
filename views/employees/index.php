<?php

use models\Employees;
use models\Genders;

require_once (ROOT . '/controllers/EmployeesController.php');
require_once (ROOT . '/models/Employees.php');
require_once (ROOT . '/views/main/header.php');
?>
<a href="/employees/create/" class="btn btn-success" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i></a>
<table class="table table-striped table-hover">
                <thead class="thead-dark">
                <th>ID</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Пол</th>
                <th>Зар.плата</th>
                <th>ДР</th>
                <th>Отдел</th>
                <th>Проект</th>
                <th>Action</th>
                </thead>
                <tbody>
                <?php

                foreach ($employeeList as $item) {?>
                    <tr>
                        <td><?=$item->id?></td>
                        <td><?=$item->name?></td>
                        <td><?=$item->surname?></td>
                        <td><?=(new Genders())->getGendersById($item->gender)?></td>
                        <td><?=$item->gross?></td>
                        <td><?=$item->birthday?></td>
                        <td><?=(new Employees())->getDepartmentNameById($item->department_id) ?? null?></td>
                        <td><?=(new Employees())->getProjectNameById($item->project_id) ?? null?></td>
                        <td>
                            <a href="/employees/update/<?=$item->id?>" class="btn btn-success" data-toggle="modal" data-target="#update<?=$item->id?>"><i class="fa fa-edit"></i></a>
                            <a href="/employees/delete/<?=$item->id?>" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$item->id?>"><i class="fa fa-trash-alt"></i></a>
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
                                            <small>Имя</small>
                                            <input type="text" class="form-control" name="name" value="<?=$item->name?>" required>
                                        </div>
                                        <div class="form-group">
                                            <small>Фамилия</small>
                                            <input type="text" class="form-control" name="surname" value="<?=$item->surname?>">
                                        </div>
                                        <div class="form-group">
                                            <small>Выберите пол</small>
                                            <select name="gender_id">
                                                
                                                <?php foreach ((new Genders())->getGendersList() as $gender): ?>
                                                <?php $isActive = '';
                                                if ($gender->id == $item->gender){$isActive = 'selected';}
                                                ?>
                                                    <option value="<?=$gender->id?>" <?=$isActive?>>
                                                        <?=($gender->name)?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <small>День Рождения</small>
                                            <input type="date" class="form-control" name="birthday" value="<?=$item->birthday?>" required>
                                        </div>
                                        <div class="form-group">
                                            <small>Заработная плата</small>
                                            <input type="number" class="form-control" name="gross" value="<?=$item->gross?>" required>
                                        </div>
                                        <?php if(!empty((new Employees())->getDepartmentList())) : ?>
                                            <div class="form-group">
                                                <small>Выбрать другой отдел</small>
                                                <select name="department_id">
                                                    <?php foreach ((new Employees())->getDepartmentList() as $department): ?>
                                                        <?php $isActive = '';
                                                        if ($department->id == $item->department_id){$isActive = 'selected';}
                                                        ?>
                                                        <option value="<?= $department->id?>" <?=$isActive?>>
                                                            <?=$department->name?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        <?php endif;?>

                                        <?php if(!empty((new Employees())->getProjectList())) : ?>
                                            <div class="form-group">
                                                <small>Выбрать другой проект</small>
                                                <select name="project_id">
                                                    <?php foreach ((new Employees())->getProjectList() as $project): ?>
                                                        <?php $isActive = '';
                                                        if ($project->id == $item->project_id){$isActive = 'selected';}
                                                        ?>
                                                        <option value="<?= $project->id?>" <?=$isActive?>>
                                                            <?=$project->name?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        <?php endif;?>
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
                <form action="/employees/create/" method="post">
                    <div class="form-group">
                        <small>Имя</small>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <small>Фамилия</small>
                        <input type="text" class="form-control" name="surname">
                    </div>
                    <div class="form-group">
                        <small>Выберите пол</small>
                        <select name="gender_id">
                            <?php foreach ((new Genders())->getGendersList() as $gender): ?>
                                <option value="<?=$gender->id?>">
                                    <?=($gender->name)?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <small>День Рождения</small>
                        <input type="date" class="form-control" name="birthday" required>
                    </div>
                    <div class="form-group">
                        <small>Заработная плата</small>
                        <input type="number" class="form-control" name="gross" required>
                    </div>

                    <?php if(!empty((new Employees())->getDepartmentList())) : ?>
                    <div class="form-group">
                        <small>Выбрать отдел</small>
                        <select name="department_id">
                                <?php foreach ((new Employees())->getDepartmentList() as $department): ?>
                                    <option value="<?= $department->id?>">
                                        <?=$department->name?>
                                    </option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif;?>

                    <?php if(!empty((new Employees())->getProjectList())) : ?>
                        <div class="form-group">
                            <small>Выбрать проект</small>
                            <select name="project_id">
                                <?php foreach ((new Employees())->getProjectList() as $project): ?>
                                    <option value="<?= $project->id?>">
                                        <?=$project->name?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif;?>

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

