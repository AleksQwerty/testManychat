<?php

use models\Departments;


include_once ROOT . '/models/Departments.php';

class DepartmentsController
{
    public function __construct()
    {
    }

    public function actionIndex()
    {
        $departmentList = [];
        $departmentList = (new Departments())->getDepartmentsList();
        require_once(ROOT . '/views/departments/index.php');
        return true;
    }

    public function actionView($id)
    {
        $departmentList = (new Departments())->getDepartmentById($id);
        debug($departmentList);
        return true;
    }

    public function actionDelete($id)
    {
        if (isset($_POST['submit'])){
            (new Departments())->deleteRecord($id) ? header('Location: /departments/') : header('Location: /departments/delete/' . $id);
        }

        require_once(ROOT . '/views/departments/index.php');
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
                $errorText[] = 'Наименование отдела не может быть пустым';
            }

            //если нет ошибок то создаем новый отдел
            if (empty($errorText)) {
                (new Departments())->addNewRecord($options);
                header('Location: /departments/');
            }
            require_once(ROOT . '/views/departments/index.php');
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
                $errorText[] = 'Наименование отдела не может быть пустым';
            }

            //если нет ошибок то создаем новый отдел
            if (empty($errorText)) {
                (new Departments())->updateRecord($options, $id);
                header('Location: /departments/');
            }
            require_once(ROOT . '/views/departments/index.php');
            return true;
        }
    }
}