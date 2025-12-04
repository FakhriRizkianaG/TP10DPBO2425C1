<?php
// File: index.php

session_start();

// Autoloading Models dan ViewModels
require_once('viewmodels/UserViewModel.php');
require_once('viewmodels/DeveloperViewModel.php');
require_once('viewmodels/EngineViewModel.php');
require_once('viewmodels/GameViewModel.php');

// Mendapatkan parameter URL
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'read';
$id = $_GET['id'] ?? null;

// Routing Logic
switch ($page) {
    case 'users':
        $viewModel = new UserViewModel();
        $view_dir = 'user';
        break;
    case 'developers':
        $viewModel = new DeveloperViewModel();
        $view_dir = 'developer';
        break;
    case 'engines':
        $viewModel = new EngineViewModel();
        $view_dir = 'engine';
        break;
    case 'games':
        $viewModel = new GameViewModel();
        $view_dir = 'game';
        break;
    default:
        // Halaman Home
        $page_title = "Selamat Datang";
        include_once('views/template/header.php');
        echo '<p>Gunakan menu navigasi di atas untuk mengakses data CRUD.</p>';
        include_once('views/template/footer.php');
        exit;
}

// Action Logic (CRUD)
switch ($action) {
    case 'read':
        // Menampilkan daftar
        include_once("views/{$view_dir}_list.php");
        break;

    case 'create':
        // Tampilkan form kosong (Data Binding ke form akan menghasilkan nilai kosong/default)
        $viewModel->ID = null; // Pastikan ID kosong untuk Create
        include_once("views/{$view_dir}_form.php");
        break;
        
    case 'edit':
        // 1. Tentukan nama metode yang tepat secara dinamis
        // Misalnya: untuk $view_dir='user', metode yang dicari adalah 'getOneUser'.
        // Jika $view_dir='developer', metode yang dicari adalah 'getOneDeveloper'.
        $get_method = "getOne" . ucfirst(rtrim($view_dir, 's'));

        // 2. Cek apakah ID ada DAN ViewModel memiliki metode tersebut
        // DAN pemanggilan metode tersebut berhasil (mengambil data dan melakukan data binding)
        if ($id && method_exists($viewModel, $get_method) && $viewModel->$get_method($id)) {
            // Data berhasil di-load ke ViewModel, tampilkan form
            include_once("views/{$view_dir}_form.php");
        } else {
            // Gagal, karena ID tidak ada, metode tidak ada, atau data tidak ditemukan
            $_SESSION['message'] = "Data tidak ditemukan atau error loading data!";
            $_SESSION['msg_type'] = "danger";
            header("Location: index.php?page={$page}");
            exit; // Penting: hentikan eksekusi setelah header
        }
        break;

    case 'save':
        // Memproses data dari form (Data Binding dari View Input ke ViewModel)
        $data = $_POST;
        
        // Catatan: saveUser bisa digunakan untuk semua ViewModel karena polanya sama
        if (method_exists($viewModel, "save{$view_dir}")) {
            $save_method = "save{$view_dir}";
        } else {
            // Jika nama method berbeda (misal: UserViewModel::saveUser)
            $save_method = "save" . ucfirst(rtrim($view_dir, 's')); 
        }

        if ($viewModel->$save_method($data)) {
            $_SESSION['message'] = "Data berhasil disimpan!";
            $_SESSION['msg_type'] = "success";
            header("Location: index.php?page={$page}");
            exit;
        } else {
            // Jika gagal, tampilkan form kembali dengan error message dari ViewModel
            $viewModel->Error = $viewModel->Error; // Pastikan error ter-propagate
            include_once("views/{$view_dir}_form.php");
        }
        break;

    case 'delete':
        // Menghapus data
        if (method_exists($viewModel, "delete{$view_dir}")) {
            $delete_method = "delete{$view_dir}";
        } else {
            $delete_method = "delete" . ucfirst(rtrim($view_dir, 's'));
        }

        if ($id && $viewModel->$delete_method($id)) {
            $_SESSION['message'] = "Data berhasil dihapus.";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = $viewModel->Error ?: "Gagal menghapus data.";
            $_SESSION['msg_type'] = "danger";
        }
        header("Location: index.php?page={$page}");
        exit;
        
    default:
        $_SESSION['message'] = "Aksi tidak valid.";
        $_SESSION['msg_type'] = "warning";
        header("Location: index.php?page={$page}");
        exit;
}
?>