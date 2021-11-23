<?php

namespace models;

use components\Db;
use PDO;

class Projects
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = Db::getConnection();
    }

    /**
     * получение списка проектов
     * @return array
     */
    public function getProjectsList()
    {
        $sql = $this->dbConnection->prepare("SELECT * FROM main.projects order by id asc");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);

    }

    /**
     * получение проекта по его ID
     * @param $id
     * @return array
     */
    public function getProjectById($id)
    {
        $id = intval($id);
        $query = $this->dbConnection->query("SELECT * FROM main.projects where id = {$id}");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * удаление проекта
     * @param $id
     * @return bool
     */
    public function deleteRecord($id)
    {
        $id = intval($id);
        $sql = "DELETE FROM main.projects where id = :id";
        $result = $this->dbConnection->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * создание нового проекта
     * @param array $options
     * @return false|string
     */
    public function addNewRecord(array $options)
    {
        $departmentName = $options['name'];
        $sql = "INSERT INTO main.projects
(\"name\")
values (?);";
        $result = $this->dbConnection->prepare($sql);

        if ($result->execute([$departmentName])){
            return $this->dbConnection->lastInsertId();
        }
        return false;
    }

    /**
     * обновление имени существующего проекта
     * @param array $options
     * @param       $id
     * @return false|string
     */
    public function updateRecord(array $options, $id)
    {
        $projectName = $options['name'];
        $sql = "UPDATE main.projects
            SET \"name\"=?, updated_at=now() WHERE id=?; ";
        $result = $this->dbConnection->prepare($sql);

        if ($result->execute([$projectName, $id])){
            return $this->dbConnection->lastInsertId();
        }
        return false;
    }

    /**
     * устанавливаем проект в список сотрудников
     * @param array $employeeList
     * @param       $id
     * @return false|string
     */
    public function addNewEmployeesInProject(array $employeeList, $id)
    {
        $strEmp = implode(', ', $employeeList);
        $result = $this->dbConnection->prepare("UPDATE main.employees
            SET project_id={$id}, updated_at=now() WHERE id IN ({$strEmp})");
        if ($result->execute()){
            return $this->dbConnection->lastInsertId();
        }
        return false;
    }
}
