<?php

namespace app\Core;

class Router{
    protected $routes = [];
    private Request $request;
    private Response $response;
    
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path,$closure){
        $this->routes['get'][$path] = $closure;
    }

    public function post($path,$closure){
        $this->routes['post'][$path] = $closure;
    }

    public function resolve(){
        $path = $this->request->getPath();
        $method = strtolower($this->request->getMethod());
        $callback = $this->routes[$method][$path] ?? false;

        if($callback===false){
            $this->response->setStatusCode(404);
            return $this->renderView('_404');
        }

        if(is_string($callback)){
            return $this->renderView($callback);
        }

        if(is_array($callback)){
           return call_user_func([new $callback[0],$callback[1]]);
        }
       
        return call_user_func($callback);
    }
    
    public function renderView($view){
        $layout = $this->layoutContent();
        $test = $this->renderViewOnly($view);
        return str_replace('{{content}}',$test,$layout);
    }

    private function layoutContent(){
        ob_start();
        include_once Application::$ROOT_DIR."/Views/layouts/nav.php";
        return ob_get_clean();
    }

    private function renderViewOnly($view){
        ob_start();
        include_once Application::$ROOT_DIR."/Views/$view.php";
        return ob_get_clean();
    }

    private function renderContent($content){
        $layout = $this->layoutContent();    
        return str_replace('{{content}}',$content,$layout);
    }
}