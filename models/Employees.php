<?php

namespace models;

use components\Db;
use PDO;

class Employees
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = Db::getConnection();
    }

    public function getEmployeesList()
    {
        $sql = $this->dbConnection->prepare("SELECT * FROM main.employees order by id asc");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteRecord($id)
    {
        $id = intval($id);
        $sql = "DELETE FROM main.employees where id = :id";
        $result = $this->dbConnection->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * Получение наименования отдела по отделу
     * @param $departmentId
     * @return mixed
     */
    public function getDepartmentNameById($departmentId)
    {
        $departmentId = intval($departmentId);
        $sql = "SELECT name FROM main.departments where id = :id";
        $result = $this->dbConnection->prepare($sql);
        $result->bindParam(':id', $departmentId, PDO::PARAM_INT);
        $result->execute();
        $name = $result->fetchAll(PDO::FETCH_OBJ);
        foreach ($name as $item) {
            return $item->name;
        }
    }

    /**
     * @param $projectId
     * @return mixed
     */
    public function getProjectNameById($projectId)
    {
        $projectId = intval($projectId);
        $sql = "SELECT name FROM main.projects where id = :id";
        $result = $this->dbConnection->prepare($sql);
        $result->bindParam(':id', $projectId, PDO::PARAM_INT);
        $result->execute();
        $name = $result->fetchAll(PDO::FETCH_OBJ);
        foreach ($name as $item) {
            return $item->name;
        }
    }

    public function getEmployeesByDepartment($departmentId)
    {
        $sql = "SELECT * FROM main.employees where department_id =:id order by name asc";
        $result = $this->dbConnection->prepare($sql);
        $result->bindParam(':id', $departmentId, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function getEmployeesByProject($projectId)
    {
        $sql = "SELECT * FROM main.employees where project_id =:id order by name asc";
        $result = $this->dbConnection->prepare($sql);
        $result->bindParam(':id', $projectId, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function getDepartmentList()
    {
        $sql = $this->dbConnection->prepare("SELECT id, name FROM main.departments order by name asc");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProjectList()
    {
        $sql = $this->dbConnection->prepare("SELECT id, name FROM main.projects order by name asc");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    public function addNewRecord(array $options)
    {
        $employeeName = $options['name'];
        $employeeSurname = $_POST['surname'];
        $employeeGender = $_POST['gender_id'];
        $employeeBirthday = $_POST['birthday'];
        $employeeGross = $_POST['gross'];
        $employeeDepartmentId = $_POST['department_id'];
        $employeeProjectId = $_POST['project_id'];

        $sql = "INSERT INTO main.employees
(\"name\", surname, gender, birthday, gross, department_id, project_id)
values (?, ?, ?, ?, ?, ?, ?);";

        $result = $this->dbConnection->prepare($sql);

        if ($result->execute(
            [
                $employeeName,
                $employeeSurname,
                $employeeGender,
                $employeeBirthday,
                $employeeGross,
                $employeeDepartmentId,
                $employeeProjectId
            ]
        )) {
            return $this->dbConnection->lastInsertId();
        }
        return false;
    }

    public function updateRecord(array $options, $id)
    {
        $employeeName = $options['name'];
        $employeeSurname = $options['surname'];
        $employeeGender = $options['gender_id'];
        $employeeBirthday = $options['birthday'];
        $employeeGross = $options['gross'];
        $employeeDepartmentId = $options['department_id'];
        $employeeProjectId = $options['project_id'];

        $sql = "UPDATE main.employees
            SET \"name\"=?, surname=?, gender=?, birthday=?, gross=?, department_id=?, project_id=?, updated_at=now() WHERE id=?; ";
        $result = $this->dbConnection->prepare($sql);

        if ($result->execute(
            [
                $employeeName,
                $employeeSurname,
                $employeeGender,
                $employeeBirthday,
                $employeeGross,
                $employeeDepartmentId,
                $employeeProjectId,
                $id
            ]
        )) {
            return $this->dbConnection->lastInsertId();
        }
        return false;
    }

}