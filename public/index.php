<?php

use app\Controllers\ContactController;
use app\Controllers\LoginController;
use app\Controllers\RegisterController;
use app\Controllers\SiteController;
use app\Core\Application;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsa' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$rootPath = dirname(__DIR__);
$app = new Application($rootPath, $config);

$app->router->get('/', function () {
    return "hello from /";
});

$app->router->get('/user', function () {
    return "hello from user";
});

$app->router->get('/admin', function () {
    return "hello from admin";
});

$app->router->get('/contact', [ContactController::class, 'index']);

$app->router->post('/contact', [ContactController::class, 'store']);

$app->router->get('/login', [LoginController::class, 'index']);

$app->router->get('/register', [RegisterController::class, 'index']);

$app->router->post('/register', [RegisterController::class, 'store']);

$app->router->get('/home', 'home');

$app->run();

          
