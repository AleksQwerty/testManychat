<?php

namespace models;

use components\Db;
use PDO;

class Departments
{

    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = Db::getConnection();
    }

    public function getDepartmentsList()
    {
        $sql = $this->dbConnection->prepare("SELECT * FROM main.departments order by id asc");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);

    }

    public function getDepartmentById($id)
    {
        $id = intval($id);
        $query = $this->dbConnection->query("SELECT * FROM main.departments where id = {$id}");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteRecord($id)
    {
        $id = intval($id);
        $sql = "DELETE FROM main.departments where id = :id";
        $result = $this->dbConnection->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public function addNewRecord(array $options)
    {
        $departmentName = $options['name'];
        $sql = "INSERT INTO main.departments
(\"name\")
values (?);";
        $result = $this->dbConnection->prepare($sql);

        if ($result->execute([$departmentName])){
            return $this->dbConnection->lastInsertId();
        }
        return false;

    }

    public function updateRecord(array $options, $id)
    {
        $departmentName = $options['name'];
        $sql = "UPDATE main.departments
            SET \"name\"=?, updated_at=now() WHERE id=?; ";
        $result = $this->dbConnection->prepare($sql);

        if ($result->execute([$departmentName, $id])){
            return $this->dbConnection->lastInsertId();
        }
        return false;

    }

}