<?php

use models\Employees;

class DepartmentFilterController
{
    public function actionIndex($departmentId)
    {
        $employeesList = (new Employees())->getEmployeesByDepartment($departmentId);
        require_once(ROOT . '/views/filter/index.php');
        return true;
    }
}