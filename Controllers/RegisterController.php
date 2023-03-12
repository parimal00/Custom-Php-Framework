<?php

namespace app\Controllers;

use app\Core\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        $this->setLayout('main');
        return $this->render('register');
    }

    public function store()
    {
    }
}
