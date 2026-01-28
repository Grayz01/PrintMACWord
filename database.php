<?php
class Database {
    private $host = "localhost";
    private $db_name = "Contract";
    private $username = "root";
    private $password = "";
    private $conn;
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    public function connect() {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password, $this->options);
        } catch(PDOException $e) {
            die("✗ Lỗi kết nối: " . $e->getMessage());
        }

        return $this->conn;
    }

    public function getConnection() {
        return $this->conn;
    }
}