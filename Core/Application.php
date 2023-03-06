<?php

namespace app\Core;
use app\Core\Router;
use app\Core\Response;

class Application{
    public static string $ROOT_DIR;
    public Router $router;
    public static Application $app;
    public Response $response;
    private Request $request;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->response = new Response();
        $this->request = new Request();
        $this->router=new Router($this->request,$this->response);

    }

    public function run(){
        echo $this->router->resolve();
    }
}