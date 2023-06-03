<?php

use app\Core\Application;

class M0002_create_users_table
{
    public function up()
    {
        echo "creating user table";
        $db = Application::$app->database;

        $query = "CREATE TABLE users(
            id int PRIMARY KEY AUTO_INCREMENT,
            name varchar(255),
            email varchar(255),
            password varchar(255)
            )";

        $db->pdo->exec($query);

        echo "completed".PHP_EOL;
    }
}
