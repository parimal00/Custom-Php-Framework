<?php 

namespace app\Controllers;

use app\Core\Application;

class SiteController{
    public function contact(){
        return Application::$app->router->renderView('contact');
    }
}