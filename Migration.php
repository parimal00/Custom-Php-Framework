<?php

use app\Controllers\ContactController;
use app\Controllers\LoginController;
use app\Controllers\RegisterController;
use app\Controllers\SiteController;
use app\Core\Application;
use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dsa' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];


$app = new Application(__DIR__, $config);

$app->database->applyMigrations();


