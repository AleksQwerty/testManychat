<?php
require_once (ROOT . '/controllers/ReportsController.php');
require_once (ROOT . '/views/main/header.php');
?>
<table class="table table-striped table-hover">
                <thead class="thead-dark">
                <th>ID проекта</th>
                <th>Наименование проекта</th>
                <th>Бюджет</th>
                </thead>
                <tbody>
                <?php foreach ($reportList as $item) {?>
                    <tr>
                        <td><?=$item->id?></td>
                        <td><?=$item->name?></td>
                        <td><?=$item->budget ?? 'нет бюджета'?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once (ROOT . '/views/main/footer.php');
?>

