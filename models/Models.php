<?php

namespace models;

use components\Db;

class Models
{
    protected $dbConnection;

    public function __construct()
    {
        $this->dbConnection = Db::getConnection();
    }
}