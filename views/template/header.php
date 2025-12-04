<?php 
// File: views/template/header.php 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore MVVM - <?php echo $page_title ?? "Aplikasi CRUD"; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { padding-top: 56px; }
        .footer { padding: 10px 0; background-color: #f8f9fa; border-top: 1px solid #e9ecef; }
        .container { margin-bottom: 50px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="index.php?page=home">🎮 GameStore MVVM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=users">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=developers">Developers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=engines">Engines</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=games">Games</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="mb-4"><?php echo $page_title ?? "Halaman Utama"; ?></h2>