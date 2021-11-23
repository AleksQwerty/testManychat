<?php

use models\Projects;

class ProjectsController
{
    public function actionIndex()
    {
        $projectList = [];
        $projectList = (new Projects())->getProjectsList();
        require_once (ROOT . '/views/projects/index.php');
        return true;
    }

    public function actionView($id)
    {
        $departmentList = (new Projects())->getProjectById($id);
        return true;
    }

    public function actionDelete($id)
    {
        if (isset($_POST['submit'])){
            (new Projects())->deleteRecord($id) ? header('Location: /projects/') : header('Location: /projects/delete/' . $id);
        }

        require_once(ROOT . '/views/projects/index.php');
        return true;
    }

    public function actionCreate()
    {

        $options = [];
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];

            //собираем массив ошибок в форме
            $errorText = [];

            //проверка имени на пустоту
            if (empty($options['name'])) {
                $errorText[] = 'Наименование проекта не может быть пустым';
            }

            //если нет ошибок то создаем новый отдел
            if (empty($errorText)) {
                (new Projects())->addNewRecord($options);
                header('Location: /projects/');
            }
            require_once(ROOT . '/views/projects/index.php');
            return true;
        }
    }

    public function actionUpdate($id)
    {
        if (isset($_POST['submit'])) {

            $options['name'] = $_POST['name'];
            //собираем массив ошибок в форме
            $errorText = [];

            //проверка имени на пустоту
            if (empty($options['name'])) {
                $errorText[] = 'Наименование проекта не может быть пустым';
            }

            //если нет ошибок то создаем новый отдел
            if (empty($errorText)) {
                (new Projects())->updateRecord($options, $id);
                header('Location: /projects/');
            }
            require_once(ROOT . '/views/projects/index.php');
            return true;
        }
    }
}