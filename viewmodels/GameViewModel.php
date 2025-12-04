<?php
// File: viewmodels/GameViewModel.php

require_once('config/Database.php');
require_once('models/Game.php');
require_once('models/Developer.php'); // Diperlukan untuk dropdown Developer
require_once('models/Engine.php');    // Diperlukan untuk dropdown Engine

class GameViewModel {
    private $db;
    private $game_model;
    private $developer_model;
    private $engine_model;
    
    // Properti data binding
    public $ID;
    public $Nama;
    public $Genre;
    public $Developer_ID;
    public $Engine_ID;
    public $Developer_Nama;
    public $Engine_Nama;
    public $Error = "";

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->game_model = new Game($this->db);
        $this->developer_model = new Developer($this->db);
        $this->engine_model = new Engine($this->db);
    }

    // Mengambil semua data game
    public function getGames() {
        return $this->game_model->readAll();
    }
    
    // Mengambil daftar Developer untuk dropdown
    public function getDevelopersList() {
        return $this->developer_model->readAll();
    }

    // Mengambil daftar Engine untuk dropdown
    public function getEnginesList() {
        return $this->engine_model->readAll();
    }

    // Mengambil satu data game
    public function getOneGame($id) {
        $this->game_model->ID = $id;
        
        if ($this->game_model->readOne()) {
            // Data Binding
            $this->ID = $this->game_model->ID;
            $this->Nama = $this->game_model->Nama;
            $this->Genre = $this->game_model->Genre;
            $this->Developer_ID = $this->game_model->Developer_ID;
            $this->Engine_ID = $this->game_model->Engine_ID;
            $this->Developer_Nama = $this->game_model->Developer_Nama;
            $this->Engine_Nama = $this->game_model->Engine_Nama;
            return true;
        }
        $this->Error = "Game tidak ditemukan.";
        return false;
    }

    // Menangani operasi Create dan Update
    public function saveGame($data) {
        // Data Binding dari View Input ke ViewModel
        $this->Nama = $data['nama'] ?? '';
        $this->Genre = $data['genre'] ?? '';
        $this->Developer_ID = $data['developer_id'] ?? null;
        $this->Engine_ID = $data['engine_id'] ?? null;
        $this->ID = $data['id'] ?? null;

        // Validasi
        if (empty($this->Nama) || empty($this->Developer_ID) || empty($this->Engine_ID)) {
            $this->Error = "Nama Game, Developer, dan Engine harus diisi.";
            return false;
        }

        // Data Binding dari ViewModel ke Model
        $this->game_model->Nama = $this->Nama;
        $this->game_model->Genre = $this->Genre;
        $this->game_model->Developer_ID = $this->Developer_ID;
        $this->game_model->Engine_ID = $this->Engine_ID;

        if ($this->ID) {
            // Update
            $this->game_model->ID = $this->ID;
            if ($this->game_model->update()) {
                return true;
            }
            $this->Error = "Gagal memperbarui Game.";
            return false;
        } else {
            // Create
            if ($this->game_model->create()) {
                return true;
            }
            $this->Error = "Gagal membuat Game baru.";
            return false;
        }
    }

    // Menangani operasi Delete
    public function deleteGame($id) {
        $this->game_model->ID = $id;
        
        if ($this->game_model->delete()) {
            return true;
        }
        $this->Error = "Gagal menghapus Game.";
        return false;
    }
}
?>