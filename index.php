<?php

use components\Router;
use components\Db;

spl_autoload_register(function($class) {
    $filename = str_replace('\\', '/', $class) . '.php';
    require($filename);
});

define('ROOT', dirname(__FILE__));

// подключение файлов системы
include 'debug.php';


$router = new Router();
$router->run();

