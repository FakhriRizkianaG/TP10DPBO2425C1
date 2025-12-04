<?php
// File: models/Developer.php

class Developer {
    private $conn;
    private $table_name = "Developers";

    public $ID;
    public $Nama;
    public $Pemilik_ID; // Foreign Key ke Users.ID
    public $Pemilik_Nama; // Untuk menampilkan nama pemilik

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read: Membaca semua developer dengan nama pemilik
    public function readAll() {
        $query = "SELECT 
                    d.ID, d.Nama, d.Pemilik_ID, u.Nama as Pemilik_Nama
                  FROM 
                    " . $this->table_name . " d 
                  LEFT JOIN 
                    Users u ON d.Pemilik_ID = u.ID
                  ORDER BY 
                    d.ID DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create: Membuat developer baru
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET Nama=:nama, Pemilik_ID=:pemilik_id";
        $stmt = $this->conn->prepare($query);

        $this->Nama = htmlspecialchars(strip_tags($this->Nama));
        $this->Pemilik_ID = htmlspecialchars(strip_tags($this->Pemilik_ID));

        $stmt->bindParam(":nama", $this->Nama);
        $stmt->bindParam(":pemilik_id", $this->Pemilik_ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Read One: Mendapatkan satu developer
    public function readOne() {
        $query = "SELECT 
                    d.ID, d.Nama, d.Pemilik_ID, u.Nama as Pemilik_Nama
                  FROM 
                    " . $this->table_name . " d 
                  LEFT JOIN 
                    Users u ON d.Pemilik_ID = u.ID
                  WHERE d.ID = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->Nama = $row['Nama'];
            $this->Pemilik_ID = $row['Pemilik_ID'];
            $this->Pemilik_Nama = $row['Pemilik_Nama'];
            return true;
        }
        return false;
    }

    // Update: Memperbarui developer
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET Nama = :nama, Pemilik_ID = :pemilik_id WHERE ID = :id";

        $stmt = $this->conn->prepare($query);

        $this->Nama = htmlspecialchars(strip_tags($this->Nama));
        $this->Pemilik_ID = htmlspecialchars(strip_tags($this->Pemilik_ID));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        $stmt->bindParam(':nama', $this->Nama);
        $stmt->bindParam(':pemilik_id', $this->Pemilik_ID);
        $stmt->bindParam(':id', $this->ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete: Menghapus developer
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