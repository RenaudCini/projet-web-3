<?php

namespace Controller;

abstract class Controller
{
    protected $model;
    protected $modelName;

    public function __construct()
    {
        $className = '\\Model\\' . $this->modelName;
        $this->model = new $className;
    }

    protected function render(string $path, array $vars = [])
    {
        extract($vars);

        include "view/header.html.php";
        include "view/$path.html.php";
        include "view/footer.html.php";
    }
}
