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
            $callback = [new $callback[0],$callback[1]];
           return call_user_func($callback,$this->request);
        }
       
        return call_user_func($callback,$this->request);
    }
    
    public function renderView($view,$params=[]){
        $layout = $this->layoutContent();
        $test = $this->renderViewOnly($view,$params);
        return str_replace('{{content}}',$test,$layout);
    }

    private function layoutContent(){
        ob_start();
        $layout = Application::$layout;
        include_once Application::$ROOT_DIR."/Views/layouts/$layout.php";
        return ob_get_clean();
    }

    private function renderViewOnly($view,$params){
        foreach($params as $key => $param){
            $$key = $param;
        }

        ob_start();
        include_once Application::$ROOT_DIR."/Views/$view.php";
        return ob_get_clean();
    }

    private function renderContent($content){
        $layout = $this->layoutContent();    
        return str_replace('{{content}}',$content,$layout);
    }
}