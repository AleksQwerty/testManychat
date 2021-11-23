<?php

use models\Employees;
use models\Genders;

require_once (ROOT . '/controllers/DepartmentsController.php');
require_once (ROOT . '/views/main/header.php');
?>
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
                </thead>
                <tbody>
                <?php

                foreach ($employeesList as $item) {?>
                    <tr>
                        <td><?=$item->id?></td>
                        <td><?=$item->name?></td>
                        <td><?=$item->surname?></td>
                        <td><?=(new Genders())->getGendersById($item->gender)?></td>
                        <td><?=$item->gross?></td>
                        <td><?=$item->birthday?></td>
                        <td><?=(new Employees())->getDepartmentNameById($item->department_id) ?? null?></td>
                        <td><?=(new Employees())->getProjectNameById($item->project_id) ?? null?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            </table>
        </div>
    </div>
</div>
<?php require_once (ROOT . '/views/main/footer.php');?>