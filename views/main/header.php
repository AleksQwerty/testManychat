<?php

use models\Employees;

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <title>Hello, world!</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
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
                        <?php if (trim($_SERVER['REQUEST_URI'], '/') == 'employees' ||
                            trim($_SERVER['REQUEST_URI'], '/') == ''
                        || (mb_strpos($_SERVER['REQUEST_URI'], 'department-filter') != 0) || (mb_strpos($_SERVER['REQUEST_URI'], 'project-filter') != 0)): ?>
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
