<?php

namespace Josh\BookList\Model;
use PDO;
use PDOException;

class Database {
    private string $host = '127.0.0.1'; // Use '127.0.0.1' to connect via TCP/IP
    private string $db   = 'php';
    private string $user = 'root';
    private string $pass = 'password';
    private string $charset = 'utf8mb4';
    private PDO $pdo;
    private string $error;

    public function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exceptions for errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Set default fetch mode to associative array
            PDO::ATTR_EMULATE_PREPARES   => false,                  // Disable emulation of prepared statements
        ];
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
            echo "DEBUG: Connected to the database successfully.\n";
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            die("Database connection failed: " . $this->error);
        }
    }
    public function getConnection(): PDO {
        return $this->pdo;
    }
}
