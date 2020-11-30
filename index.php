<?php

use Controller\Home;

require_once __DIR__ . '/autoload.php';

$requestUri = filter_input(INPUT_SERVER, 'REQUEST_URI');

if ($requestUri === '/') {
    $controller = new Home;
    $controller->home();
}
