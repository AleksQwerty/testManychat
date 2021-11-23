<?php

$host = 'localhost';
$port = 5432;
$dbName = 'test';
$userName = 'test';
$password = 'testLocal';

try {
    $pdo = new PDO("pgsql:host=pgsql;port=5432;dbname=test;",'test','testLocal');
} catch (PDOException $e) {
    echo 'Ошибка соединения с БД' . $e->getMessage();
}