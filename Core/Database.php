<?php

namespace app\Core;



use PDO;

class Database
{
    public PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsa'];
        $username = $config['user'];
        $password = $config['password'];

        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];

        $files = scandir(Application::$ROOT_DIR . '/Migrations');

        $migrationsToApply = array_diff($files, $appliedMigrations);

        foreach ($migrationsToApply as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            require Application::$ROOT_DIR . '/Migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            (new $className())->up();
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveNewMigrations($newMigrations);
        } else {
            echo "all migrations applied";
        }
    }

    public  function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    migration VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB");
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function custom_autoloader($class)
    {
        include Application::$ROOT_DIR . '/Migrations/M0001_initial_migration.php';
    }

    private function saveNewMigrations(array $migrations)
    {
        $str = implode(",", array_map(fn ($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations(migration) Values $str");
        $statement->execute();
    }

    public function prepare($sql){
        return $this->pdo->prepare($sql);
    }
}
