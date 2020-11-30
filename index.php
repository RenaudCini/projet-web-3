<?php

use Controller\Home;

require_once __DIR__ . '/autoload.php';

$requestUri = filter_input(INPUT_SERVER, 'REQUEST_URI');

if ($requestUri === '/') {
    $controller = new Home;
    $controller->home();
}

$controllerName = 'Controller\\' . ucfirst($controllerName);

$actionNAme = filter_input(INPUT_GET, 'action');


if (!$actionNAme) {
    $actionNAme = 'index';
}

if (!class_exists($controllerName)) {
    Http::createErrorResponse('la classe n\'existe pas', 404);
}


$controller = new $controllerName;

if (!method_exists($controllerName, $actionNAme)) {
    Http::createErrorResponse('la classe n\'existe pas', 404);
}
$controller->$actionNAme();
