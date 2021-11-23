<?php
$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
echo '<br>Нужно сформирвоать - ' . $internalRoute;

$segments = explode('/', $internalRoute);
$controllerName = array_shift($segments) . 'Controller';
$controllerName = ucfirst($controllerName);

$actionName = 'action' . ucfirst(array_shift($segments));

$parameters = $segments;
debug($parameters);