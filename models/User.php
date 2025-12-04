<?php
// File: models/User.php

class User {
    // Koneksi database dan nama tabel
    private $conn;
    private $table_name = "Users";

    // Properti objek
    public $ID;
    public $Nama;
    public $Join_Date;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Metode CRUD
    
    // Read: Membaca semua user
    public function readAll() {
        $query = "SELECT ID, Nama, Join_Date FROM " . $this->table_name . " ORDER BY ID DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create: Membuat user baru
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET Nama=:nama, Join_Date=:join_date";

        $stmt = $this->conn->prepare($query);

        // Membersihkan data
        $this->Nama = htmlspecialchars(strip_tags($this->Nama));
        $this->Join_Date = htmlspecialchars(strip_tags($this->Join_Date));

        // Mengikat nilai
        $stmt->bindParam(":nama", $this->Nama);
        $stmt->bindParam(":join_date", $this->Join_Date);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read One: Mendapatkan satu user berdasarkan ID
    public function readOne() {
        $query = "SELECT ID, Nama, Join_Date FROM " . $this->table_name . " WHERE ID = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Mengatur nilai properti
            $this->Nama = $row['Nama'];
            $this->Join_Date = $row['Join_Date'];
            return true;
        }
        return false;
    }

    // Update: Memperbarui user
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET Nama = :nama, Join_Date = :join_date WHERE ID = :id";

        $stmt = $this->conn->prepare($query);

        // Membersihkan dan mengikat nilai
        $this->Nama = htmlspecialchars(strip_tags($this->Nama));
        $this->Join_Date = htmlspecialchars(strip_tags($this->Join_Date));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        $stmt->bindParam(':nama', $this->Nama);
        $stmt->bindParam(':join_date', $this->Join_Date);
        $stmt->bindParam(':id', $this->ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete: Menghapus user
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID = ?";

        $stmt = $this->conn->prepare($query);

        // Membersihkan ID
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        // Mengikat ID
        $stmt->bindParam(1, $this->ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>