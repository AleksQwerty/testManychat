<?php

namespace components;

class Router
{
    public $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Возвращает строку запроса
     * @return string
     */
    private function getUri()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * Получаем имя контроллера
     * @param $name
     * @return string
     */
    private function getControllerName(&$name)
    {
        $controllerName = array_shift($name) . 'Controller';
        return $this->getUcFirstName($controllerName);
    }

    /**
     * Преобразуем первую букву в верхний регистр
     * @param $string
     * @return string
     */
    private function getUcFirstName($string)
    {
        return ucfirst($string);
    }

    /**
     * Получаем имя action
     * @param $name
     * @return string
     */
    private function getActionName(&$name)
    {
        $actionName = array_shift($name);
        return 'action' . $this->getUcFirstName($actionName);
    }

    /**
     * разбиваем путь для получения имени контроллера и action
     * @param $path
     * @return false|string[]
     */
    private function getSegmentedPath($path)
    {
       return explode('/', $path);
    }

    /**
     * получаем путь расположения файла класса-контроллера
     * @param $fileName
     * @return string
     */
    private function getPathToFileController($fileName)
    {
        return ROOT . '/controllers/' . $fileName . '.php';
    }

    /**
     * Подключаем файл если существует
     * @param $filePath
     */
    private function includeFileIfExists($filePath)
    {
        if (file_exists($filePath)){
            include_once ($filePath);
        }else{
            echo 'такого файла не существует';
        }
    }

    /**
     * получаем массив параметров запроса
     * @param $controllerObject
     * @param $actionName
     * @param $parameters
     * @return mixed
     */
    private function getArrParameters($controllerObject, $actionName, $parameters)
    {
//        echo '<pre>';
//        var_dump(['$controllerObject' => $controllerObject, '$actionName' => $actionName, '$parameters' => $parameters]);
        return call_user_func_array([$controllerObject, $actionName], $parameters);
    }


    public function run()
    {
        //достаем строку запроса
        $uri = $this->getUri();

//        var_dump($uri);
//        var_dump($this->routes);


        foreach ($this->routes as $uriPattern => $path) {

            //сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)){
//                debug($uriPattern . '-' . $uri);
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);


                $segments = $this->getSegmentedPath($internalRoute);
                $controllerName = $this->getControllerName($segments);
                $actionName = $this->getActionName($segments);

                //кладем оставшиеся параметры
                $parameters = $segments;

                //получаем путь расположения файла класса-контроллера
                $controllerFilePath = $this->getPathToFileController($controllerName);

                //Подключаем файл если существует
                $this->includeFileIfExists($controllerFilePath);

                //создаем экземпляр класса контроллера и достаем action
                $controllerObject = new $controllerName();
                
                $result = $this->getArrParameters($controllerObject, $actionName, $parameters);

                if ($result != null){
                    break;
                }
            }
        }
    }
}