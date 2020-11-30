<?php

namespace Controller;

class Home extends Controller
{
    protected $modelName = 'Home';

    public function home()
    {
        $this->render('home');
    }
}
