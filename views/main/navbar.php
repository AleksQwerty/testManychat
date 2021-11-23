<?php

use models\Employees;

?>
<nav class="navbar navbar-expand-lg navbar-primary" style="background-color: #e3f2fd">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/departments/">Отделы <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/projects/">Проекты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/employees/">Сотрудники</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/reports/">Отчёты</a>
            </li>
            <?php if (trim($_SERVER['REQUEST_URI'], '/') == 'employees' || trim($_SERVER['REQUEST_URI'], '/') == ''): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Фильтр по отделу
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ((new Employees())->getDepartmentList() as $department): ?>
                                <a class="dropdown-item" href="/employees/department-filter/<?= $department->id?>"><?=$department->name?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Фильтр по проекту
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ((new Employees())->getProjectList() as $project): ?>
                            <a class="dropdown-item" href="/employees/project-filter/<?= $project->id?>"><?=$project->name?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
