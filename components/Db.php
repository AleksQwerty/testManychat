<?php

namespace components;

use PDO;
use PDOException;

class Db
{
    public static function getConnection()
    {
        $host = 'pgsql';
        $port = 5432;
        $dbName = 'test';
        $userName = 'test';
        $password = 'testLocal';

        try {
            $dbConnection = new PDO("pgsql:host=$host;port=$port;dbname=$dbName;",$userName,$password);
        } catch (PDOException $e) {
            echo 'Ошибка соединения с БД' . $e->getMessage();
        }
        return $dbConnection;
    }

}