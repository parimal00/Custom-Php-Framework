<?php

use app\Core\Application;

require_once __DIR__.'/vendor/autoload.php';

$app = new Application();

$app->router->get('/',function(){
    return "hello from /";
});

$app->router->get('/user',function(){
    return "hello from user";
});


$app->run();