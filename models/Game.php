<?php
// File: models/Game.php

class Game {
    private $conn;
    private $table_name = "Games";

    public $ID;
    public $Nama;
    public $Genre;
    public $Developer_ID; // Foreign Key
    public $Engine_ID;    // Foreign Key
    // Untuk tampilan
    public $Developer_Nama; 
    public $Engine_Nama;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read: Membaca semua game dengan nama developer dan engine
    public function readAll() {
        $query = "SELECT 
                    g.ID, g.Nama, g.Genre, g.Developer_ID, g.Engine_ID, 
                    d.Nama as Developer_Nama, e.Nama as Engine_Nama
                  FROM 
                    " . $this->table_name . " g 
                  LEFT JOIN 
                    Developers d ON g.Developer_ID = d.ID
                  LEFT JOIN 
                    Engines e ON g.Engine_ID = e.ID
                  ORDER BY 
                    g.ID DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create: Membuat game baru
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET Nama=:nama, Genre=:genre, Developer_ID=:developer_id, Engine_ID=:engine_id";
        $stmt = $this->conn->prepare($query);

        $this->Nama = htmlspecialchars(strip_tags($this->Nama));
        $this->Genre = htmlspecialchars(strip_tags($this->Genre));
        $this->Developer_ID = htmlspecialchars(strip_tags($this->Developer_ID));
        $this->Engine_ID = htmlspecialchars(strip_tags($this->Engine_ID));

        $stmt->bindParam(":nama", $this->Nama);
        $stmt->bindParam(":genre", $this->Genre);
        $stmt->bindParam(":developer_id", $this->Developer_ID);
        $stmt->bindParam(":engine_id", $this->Engine_ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Read One: Mendapatkan satu game
    public function readOne() {
        $query = "SELECT 
                    g.ID, g.Nama, g.Genre, g.Developer_ID, g.Engine_ID, 
                    d.Nama as Developer_Nama, e.Nama as Engine_Nama
                  FROM 
                    " . $this->table_name . " g 
                  LEFT JOIN 
                    Developers d ON g.Developer_ID = d.ID
                  LEFT JOIN 
                    Engines e ON g.Engine_ID = e.ID
                  WHERE g.ID = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->Nama = $row['Nama'];
            $this->Genre = $row['Genre'];
            $this->Developer_ID = $row['Developer_ID'];
            $this->Engine_ID = $row['Engine_ID'];
            $this->Developer_Nama = $row['Developer_Nama'];
            $this->Engine_Nama = $row['Engine_Nama'];
            return true;
        }
        return false;
    }

    // Update: Memperbarui game
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET Nama = :nama, Genre = :genre, Developer_ID = :developer_id, Engine_ID = :engine_id WHERE ID = :id";
        $stmt = $this->conn->prepare($query);

        $this->Nama = htmlspecialchars(strip_tags($this->Nama));
        $this->Genre = htmlspecialchars(strip_tags($this->Genre));
        $this->Developer_ID = htmlspecialchars(strip_tags($this->Developer_ID));
        $this->Engine_ID = htmlspecialchars(strip_tags($this->Engine_ID));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        $stmt->bindParam(':nama', $this->Nama);
        $stmt->bindParam(':genre', $this->Genre);
        $stmt->bindParam(':developer_id', $this->Developer_ID);
        $stmt->bindParam(':engine_id', $this->Engine_ID);
        $stmt->bindParam(':id', $this->ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete: Menghapus game
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