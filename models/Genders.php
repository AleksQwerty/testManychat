<?php

namespace models;

use components\Db;
use PDO;

class Genders
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = Db::getConnection();
    }

    /**
     * получение конкретного пола
     * @param $id
     * @return mixed
     */
    public function getGendersById($id)
    {
        $id = intval($id);
        $sql = "SELECT name FROM main.genders where id = :id";
        $result = $this->dbConnection->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $name = $result->fetchAll(PDO::FETCH_OBJ);
        foreach ($name as $item) {
            return $item->name;
        }

    }

    /**
     * получение списка полов
     * @return array
     */
    public function getGendersList()
    {
        $sql = $this->dbConnection->prepare("SELECT * FROM main.genders order by id asc");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
}