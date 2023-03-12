<?php
namespace app\Core;

class Controller{
    private $layout= 'main';

    public function render($view,$params=[]){
       return Application::$app->router->renderView($view,$params);
    }

    public function setLayout($layout){
        Application::$layout=$layout;
        // $this->layout = $layout;
    }

    public function getLayout($layout){
        return Application::$app->getLayout($layout);;
    }
}