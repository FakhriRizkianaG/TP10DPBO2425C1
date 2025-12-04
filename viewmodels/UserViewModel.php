<?php
// File: viewmodels/UserViewModel.php

require_once('config/Database.php');
require_once('models/User.php');

class UserViewModel {
    private $db;
    private $user_model;
    
    // Properti data binding untuk View
    public $ID;
    public $Nama;
    public $Join_Date;
    public $Error = "";

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user_model = new User($this->db);
    }

    // Mengambil semua data user
    public function getUsers() {
        return $this->user_model->readAll();
    }

    // Mengambil satu data user berdasarkan ID dan melakukan data binding
    public function getOneUser($id) {
        $this->user_model->ID = $id;
        
        if ($this->user_model->readOne()) {
            // Data Binding dari Model ke ViewModel
            $this->ID = $this->user_model->ID;
            $this->Nama = $this->user_model->Nama;
            $this->Join_Date = $this->user_model->Join_Date;
            return true;
        }
        $this->Error = "User tidak ditemukan.";
        return false;
    }

    // Menangani operasi Create dan Update
    public function saveUser($data) {
        // Data Binding dari View Input ke ViewModel
        $this->Nama = $data['nama'] ?? '';
        $this->Join_Date = $data['join_date'] ?? date('Y-m-d');
        $this->ID = $data['id'] ?? null;

        // Validasi Sederhana
        if (empty($this->Nama)) {
            $this->Error = "Nama tidak boleh kosong.";
            return false;
        }

        // Data Binding dari ViewModel ke Model
        $this->user_model->Nama = $this->Nama;
        $this->user_model->Join_Date = $this->Join_Date;

        if ($this->ID) {
            // Update
            $this->user_model->ID = $this->ID;
            if ($this->user_model->update()) {
                return true;
            }
            $this->Error = "Gagal memperbarui User.";
            return false;
        } else {
            // Create
            if ($this->user_model->create()) {
                return true;
            }
            $this->Error = "Gagal membuat User baru.";
            return false;
        }
    }

    // Menangani operasi Delete
    public function deleteUser($id) {
        $this->user_model->ID = $id;
        
        if ($this->user_model->delete()) {
            return true;
        }
        $this->Error = "Gagal menghapus User. Mungkin terkait dengan data lain (mis. Developers).";
        return false;
    }
}
?>