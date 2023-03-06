<?php

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

$app->router->get('/contact','contact');

$app->router->post('/contact',[SiteController::class,'contact']);

$app->router->get('/home','home');

$app->run();