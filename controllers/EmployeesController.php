<?php

use models\Employees;

class EmployeesController
{
    public function actionIndex()
    {
        $employeeList = [];
        $employeeList = (new Employees())->getEmployeesList();
        $departmentLists = (new Employees())->getDepartmentList();
        require_once(ROOT . '/views/employees/index.php');
        return true;
    }

    public function actionDelete($id)
    {
        if (isset($_POST['submit'])) {
            (new Employees())->deleteRecord($id) ? header('Location: /employees/') : header(
                'Location: /employees/delete/' . $id
            );
        }

        require_once(ROOT . '/views/employees/index.php');
        return true;
    }

    public function actionCreate($name)
    {
        $options = [];
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['surname'] = $_POST['surname'];
            $options['gender_id'] = $_POST['gender_id'];
            $options['birthday'] = $_POST['birthday'];
            $options['gross'] = $_POST['gross'];
            $options['department_id'] = $_POST['department_id'] ?? null;
            $options['project_id'] = $_POST['project_id'] ?? null;

            //массив ошибок в форме
            $errorText = [];
            //првоерка имени на пустоту
            if (empty($options['name'])) {
                $errorText[] = 'Наименование отдела не может быть пустым';
            }

            //если нет ошибок то создаем новый отдел
            if (empty($errorText)) {
                (new Employees())->addNewRecord($options);
                header('Location: /employees/');
            }
            require_once(ROOT . '/views/employees/index.php');
            return true;
        }
    }

    public function actionUpdate($id)
    {
        if (isset($_POST['submit'])) {

            $options['name'] = $_POST['name'];
            $options['surname'] = $_POST['surname'];
            $options['gender_id'] = $_POST['gender_id'];
            $options['birthday'] = $_POST['birthday'];
            $options['gross'] = $_POST['gross'];
            $options['department_id'] = $_POST['department_id'] ?? null;
            $options['project_id'] = $_POST['project_id'] ?? null;
            //собираем массив ошибок в форме
            $errorText = [];

            //проверка имени на пустоту
            if (empty($options['name'])) {
                $errorText[] = 'Наименование отдела не может быть пустым';
            }

            //если нет ошибок то создаем новый отдел
            if (empty($errorText)) {
                (new Employees())->updateRecord($options, $id);
                header('Location: /employees/');
            }
            require_once(ROOT . '/views/employees/index.php');
            return true;
        }
    }
}