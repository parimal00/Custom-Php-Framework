<?php

namespace app\Core;

class Router{
    protected $routes = [];
    private Request $request;
    
    public function __construct()
    {
        $this->request = new Request();
    }

    public function get($path,$closure){
        $this->routes['get'][$path] = $closure;
    }

    public function resolve(){
        $path = $this->request->getPath();
        $method = strtolower($this->request->getMethod());
        $callback = $this->routes[$method][$path] ?? false;

        if($callback===false){
            echo "not found";
            exit;
        }
       echo $callback();
    }
}