<?php

namespace App\Utilities\Persistence;

class DB
{
    private \PDO $pdo;

    private static mixed $instance = null;

    private function __construct()
    {
        $dsn = $_ENV['DB_DSN'];
        $user = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        $this->pdo = new \PDO($dsn, $user, $password);
    }

    public static function getInstance(): self
    {
        if (null === self::$instance) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    public function select($sql): array
    {
        $sth = $this->pdo->query($sql);

        return $sth->fetchAll();
    }

    public function exec($sql): int
    {
        return $this->pdo->exec($sql);
    }

    public function lastInsertId(): string|false
    {
        return $this->pdo->lastInsertId();
    }
}