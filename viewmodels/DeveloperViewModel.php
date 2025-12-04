<?php
// File: viewmodels/DeveloperViewModel.php

require_once('config/Database.php');
require_once('models/Developer.php');
require_once('models/User.php'); // Diperlukan untuk dropdown Pemilik_ID

class DeveloperViewModel {
    private $db;
    private $developer_model;
    private $user_model;
    
    // Properti data binding
    public $ID;
    public $Nama;
    public $Pemilik_ID;
    public $Pemilik_Nama;
    public $Error = "";

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->developer_model = new Developer($this->db);
        $this->user_model = new User($this->db); // Inisialisasi User Model
    }

    // Mengambil semua data developer
    public function getDevelopers() {
        return $this->developer_model->readAll();
    }
    
    // Mengambil daftar User untuk dropdown
    public function getOwnersList() {
        return $this->user_model->readAll();
    }

    // Mengambil satu data developer
    public function getOneDeveloper($id) {
        $this->developer_model->ID = $id;
        
        if ($this->developer_model->readOne()) {
            // Data Binding dari Model ke ViewModel
            $this->ID = $this->developer_model->ID;
            $this->Nama = $this->developer_model->Nama;
            $this->Pemilik_ID = $this->developer_model->Pemilik_ID;
            $this->Pemilik_Nama = $this->developer_model->Pemilik_Nama;
            return true;
        }
        $this->Error = "Developer tidak ditemukan.";
        return false;
    }

    // Menangani operasi Create dan Update
    public function saveDeveloper($data) {
        // Data Binding dari View Input ke ViewModel
        $this->Nama = $data['nama'] ?? '';
        $this->Pemilik_ID = $data['pemilik_id'] ?? null;
        $this->ID = $data['id'] ?? null;

        // Validasi
        if (empty($this->Nama) || empty($this->Pemilik_ID)) {
            $this->Error = "Nama Developer dan Pemilik tidak boleh kosong.";
            return false;
        }

        // Data Binding dari ViewModel ke Model
        $this->developer_model->Nama = $this->Nama;
        $this->developer_model->Pemilik_ID = $this->Pemilik_ID;

        if ($this->ID) {
            // Update
            $this->developer_model->ID = $this->ID;
            if ($this->developer_model->update()) {
                return true;
            }
            $this->Error = "Gagal memperbarui Developer.";
            return false;
        } else {
            // Create
            if ($this->developer_model->create()) {
                return true;
            }
            $this->Error = "Gagal membuat Developer baru.";
            return false;
        }
    }

    // Menangani operasi Delete
    public function deleteDeveloper($id) {
        $this->developer_model->ID = $id;
        
        if ($this->developer_model->delete()) {
            return true;
        }
        $this->Error = "Gagal menghapus Developer. Mungkin terkait dengan data Games.";
        return false;
    }
}
?>