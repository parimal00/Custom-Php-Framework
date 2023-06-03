<?php

namespace app\Core;
use app\Core\Router;
use app\Core\Response;
use app\Core\Database;

class Application{
    public static string $ROOT_DIR;
    public Router $router;
    public static Application $app;
    public Response $response;
    private Request $request;
    public static string $layout = 'nav';
    public Database $database;

    public function __construct($rootPath,array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->response = new Response();
        $this->request = new Request();
        $this->router=new Router($this->request,$this->response);
        $this->database = new Database($config['db']);
    }

    public function run(){
        echo $this->router->resolve();
    }

    // public function setLayout($layout){
    //     $this->layout = $layout;
    // }
    
    // public function getLayout(){
    //     return $this->layout;
    // }
}