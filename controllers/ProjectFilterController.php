<?php
use models\Employees;

class ProjectFilterController
{
    public function actionIndex($projectId)
    {
        $employeesList = (new Employees())->getEmployeesByProject($projectId);
        require_once(ROOT . '/views/filter/index.php');
        return true;
    }
}