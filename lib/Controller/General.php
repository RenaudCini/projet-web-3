<?php

namespace Controller;

class General extends Controller
{
    protected $modelName = 'General';

    public function home()
    {
        $this->render('home');
    }
}
