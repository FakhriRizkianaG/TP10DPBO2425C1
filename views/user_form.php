<?php 
// File: views/user_form.php

// $viewModel sudah diisi (jika Edit) atau kosong (jika Create) dari index.php
$is_edit = $viewModel->ID !== null;
$page_title = $is_edit ? "Edit User: " . htmlspecialchars($viewModel->Nama) : "Tambah User Baru";
include_once 'views/template/header.php';
?>

<?php if (!empty($viewModel->Error)): ?>
    <div class="alert alert-danger"><?php echo $viewModel->Error; ?></div>
<?php endif; ?>

<form action="index.php?page=users&action=save" method="POST">
    
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($viewModel->ID ?? ''); ?>">

    <div class="form-group">
        <label for="nama">Nama User</label>
        <input type="text" class="form-control" id="nama" name="nama" 
               value="<?php echo htmlspecialchars($viewModel->Nama ?? ''); ?>" required>
    </div>

    <div class="form-group">
        <label for="join_date">Tanggal Gabung (Join Date)</label>
        <input type="date" class="form-control" id="join_date" name="join_date" 
               value="<?php echo htmlspecialchars($viewModel->Join_Date ?? date('Y-m-d')); ?>" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan Data</button>
    <a href="index.php?page=users" class="btn btn-secondary">Batal</a>
</form>

<?php include_once 'views/template/footer.php'; ?>