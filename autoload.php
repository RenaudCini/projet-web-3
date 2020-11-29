<?php

spl_autoload_register(function ($className) {
    $classPath = 'lib/' . str_replace("\"", "/", $className) . '.php';

    if (file_exists($classPath)) {
        require_once $classPath;
    }
});

