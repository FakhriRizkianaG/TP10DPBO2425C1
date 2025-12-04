<?php
// File: config/Database.php

class Database {
    private $host = "localhost";
    private $db_name = "gamestore_db";
    private $username = "root"; // Ganti dengan username Anda
    private $password = "";     // Ganti dengan password Anda
    public $conn;

    /**
     * Mendapatkan koneksi ke database.
     * @return PDO|null Objek koneksi PDO atau null jika gagal.
     */
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>