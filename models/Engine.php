<?php
// File: models/Engine.php

class Engine {
    private $conn;
    private $table_name = "Engines";

    public $ID;
    public $Nama;
    public $Bahasa_Utama;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read: Membaca semua engine (seperti User)
    public function readAll() {
        $query = "SELECT ID, Nama, Bahasa_Utama FROM " . $this->table_name . " ORDER BY ID DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create: Membuat engine
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET Nama=:nama, Bahasa_Utama=:bahasa_utama";
        $stmt = $this->conn->prepare($query);

        $this->Nama = htmlspecialchars(strip_tags($this->Nama));
        $this->Bahasa_Utama = htmlspecialchars(strip_tags($this->Bahasa_Utama));

        $stmt->bindParam(":nama", $this->Nama);
        $stmt->bindParam(":bahasa_utama", $this->Bahasa_Utama);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read One: Mendapatkan satu engine
    public function readOne() {
        $query = "SELECT ID, Nama, Bahasa_Utama FROM " . $this->table_name . " WHERE ID = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->Nama = $row['Nama'];
            $this->Bahasa_Utama = $row['Bahasa_Utama'];
            return true;
        }
        return false;
    }

    // Update: Memperbarui engine
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET Nama = :nama, Bahasa_Utama = :bahasa_utama WHERE ID = :id";
        $stmt = $this->conn->prepare($query);

        $this->Nama = htmlspecialchars(strip_tags($this->Nama));
        $this->Bahasa_Utama = htmlspecialchars(strip_tags($this->Bahasa_Utama));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        $stmt->bindParam(':nama', $this->Nama);
        $stmt->bindParam(':bahasa_utama', $this->Bahasa_Utama);
        $stmt->bindParam(':id', $this->ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete: Menghapus engine
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID = ?";
        $stmt = $this->conn->prepare($query);
        $this->ID = htmlspecialchars(strip_tags($this->ID));
        $stmt->bindParam(1, $this->ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>