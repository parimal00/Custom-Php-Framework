<?php

namespace app\Core;
use app\Core\Router;

class Application{
    public Router $router;

    public function __construct()
    {
        $this->router=new Router();
    }

    public function run(){
        $this->router->resolve();
    }
}