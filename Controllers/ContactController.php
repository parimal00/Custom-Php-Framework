<?php

namespace app\Controllers;

use app\Core\Application;
use app\Core\Controller;
use app\Core\Request;

class ContactController extends Controller
{
    public function __construct()
    {
    }

    public function index(){
        $params = [
            'name'=>'The dude'
        ];
    //    return Application::$app->router->renderView('contact',$params);
       return $this->render('contact',$params);
    }


    public function store(Request $request){
        echo '<pre>';
        var_dump($request->getBody());
        echo '</pre>';
    }
}
