<?php

use Controller\Recette;

require_once __DIR__ . '/autoload.php';


$controllerName = filter_input(INPUT_GET, 'controller');

if (!$controllerName) {
    $controllerName = 'article';
}

$controllerName ='Controller\\' . ucfirst($controllerName);

$actionNAme = filter_input(INPUT_GET, 'action');


if (!$actionNAme)
{
    $actionNAme = 'index';
}

if (!class_exists($controllerName)) {
    Http::createErrorResponse('la classe n\'existe pas', 404);
}


$controller = new $controllerName;

if(!method_exists($controllerName,$actionNAme))
{
    Http::createErrorResponse('la classe n\'existe pas', 404);

}
$controller->$actionNAme();
