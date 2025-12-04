<?php
// File: viewmodels/EngineViewModel.php

require_once('config/Database.php');
require_once('models/Engine.php');

class EngineViewModel {
    private $db;
    private $engine_model;
    
    // Properti data binding
    public $ID;
    public $Nama;
    public $Bahasa_Utama;
    public $Error = "";

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->engine_model = new Engine($this->db);
    }

    // Mengambil semua data engine
    public function getEngines() {
        return $this->engine_model->readAll();
    }

    // Mengambil satu data engine
    public function getOneEngine($id) {
        $this->engine_model->ID = $id;
        
        if ($this->engine_model->readOne()) {
            // Data Binding
            $this->ID = $this->engine_model->ID;
            $this->Nama = $this->engine_model->Nama;
            $this->Bahasa_Utama = $this->engine_model->Bahasa_Utama;
            return true;
        }
        $this->Error = "Engine tidak ditemukan.";
        return false;
    }

    // Menangani operasi Create dan Update
    public function saveEngine($data) {
        // Data Binding dari View Input ke ViewModel
        $this->Nama = $data['nama'] ?? '';
        $this->Bahasa_Utama = $data['bahasa_utama'] ?? '';
        $this->ID = $data['id'] ?? null;

        // Validasi
        if (empty($this->Nama)) {
            $this->Error = "Nama Engine tidak boleh kosong.";
            return false;
        }

        // Data Binding dari ViewModel ke Model
        $this->engine_model->Nama = $this->Nama;
        $this->engine_model->Bahasa_Utama = $this->Bahasa_Utama;

        if ($this->ID) {
            // Update
            $this->engine_model->ID = $this->ID;
            if ($this->engine_model->update()) {
                return true;
            }
            $this->Error = "Gagal memperbarui Engine.";
            return false;
        } else {
            // Create
            if ($this->engine_model->create()) {
                return true;
            }
            $this->Error = "Gagal membuat Engine baru.";
            return false;
        }
    }

    // Menangani operasi Delete
    public function deleteEngine($id) {
        $this->engine_model->ID = $id;
        
        if ($this->engine_model->delete()) {
            return true;
        }
        $this->Error = "Gagal menghapus Engine. Mungkin terkait dengan data Games.";
        return false;
    }
}
?>