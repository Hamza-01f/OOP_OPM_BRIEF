<?php
 namespace ORM;

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

    public function create($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($stmt->execute()) {
            return $this->connection->lastInsertId();  
        }
        
        return false;  
    }

    public function read($table, $where = "") {
        $query = "SELECT * FROM $table" . ($where ? " WHERE $where" : "");
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($table, $data, $where) {
        $setPart = "";
        foreach ($data as $column => $value) {
            $setPart .= "$column = :$column, ";
        }
        $setPart = rtrim($setPart, ", ");

        $query = "UPDATE $table SET $setPart WHERE $where";
        $stmt = $this->connection->prepare($query);

        foreach ($data as $column => $value) {
            $stmt->bindValue(":$column", $value);
        }

        return $stmt->execute();
    }

    public function delete($table, $where) {
        $query = "DELETE FROM $table WHERE $where";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute();
    }
}





