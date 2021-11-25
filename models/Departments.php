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

    /**
     * получение списка отделов
     * @return array
     */
    public function getDepartmentsList()
    {
        $sql = $this->dbConnection->prepare("SELECT * FROM main.departments order by id asc");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);

    }

    /**
     * удаление отдела
     * @param $id
     * @return bool
     */
    public function deleteRecord($id)
    {
        $id = intval($id);
        $sql = "DELETE FROM main.departments where id = :id";
        $result = $this->dbConnection->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * добавление нового отдела
     * @param array $options
     * @return false|string
     */
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

    /**
     * обнолвние наименования отдела
     * @param array $options
     * @param       $id
     * @return false|string
     */
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