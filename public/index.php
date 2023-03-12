<?php

use app\Controllers\ContactController;
use app\Controllers\LoginController;
use app\Controllers\RegisterController;
use app\Controllers\SiteController;
use app\Core\Application;

require_once __DIR__.'/../vendor/autoload.php';

$rootPath = dirname(__DIR__);
$app = new Application($rootPath);

$app->router->get('/',function(){
    return "hello from /";
});

$app->router->get('/user',function(){
    return "hello from user";
});

$app->router->get('/admin',function(){
    return "hello from admin";
});

$app->router->get('/contact',[ContactController::class,'index']);

$app->router->post('/contact',[ContactController::class,'store']);

$app->router->get('/login',[LoginController::class,'index']);

$app->router->get('/register',[RegisterController::class,'index']);

$app->router->get('/home','home');

$app->run();