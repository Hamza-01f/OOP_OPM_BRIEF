<?php

namespace App\ORM;

class Database {
    private $connection;
    private $host = 'host.docker.internal';
    private $db = 'FakeFootChampion';
    private $user = 'root';
    private $pass = 'root_password';
    private $port = 3307;

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->db;port=$this->port";
            $this->connection = new \PDO($dsn, $this->user, $this->pass);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function closeConnection() {
        $this->connection = null;
    }

    // public function findPlayerById($id) {
    //     $stmt = $this->connection->prepare("SELECT * FROM FakeFootChampion WHERE id = :id");
    //     $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
    //     $stmt->execute();
    //     return $stmt->fetch(\PDO::FETCH_ASSOC);
    // }
}






