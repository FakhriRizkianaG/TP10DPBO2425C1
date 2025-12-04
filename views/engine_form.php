<?php 
// File: views/engine_form.php

// $viewModel sudah di-inject dengan data (jika Edit) atau kosong (jika Create)
$is_edit = $viewModel->ID !== null;
$page_title = $is_edit ? "Edit Engine: " . htmlspecialchars($viewModel->Nama) : "Tambah Engine Baru";
include_once 'views/template/header.php';
?>

<?php if (!empty($viewModel->Error)): ?>
    <div class="alert alert-danger"><?php echo $viewModel->Error; ?></div>
<?php endif; ?>

<form action="index.php?page=engines&action=save" method="POST">
    
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($viewModel->ID ?? ''); ?>">

    <div class="form-group">
        <label for="nama">Nama Engine</label>
        <input type="text" class="form-control" id="nama" name="nama" 
               value="<?php echo htmlspecialchars($viewModel->Nama ?? ''); ?>" required>
    </div>

    <div class="form-group">
        <label for="bahasa_utama">Bahasa Utama</label>
        <input type="text" class="form-control" id="bahasa_utama" name="bahasa_utama" 
               value="<?php echo htmlspecialchars($viewModel->Bahasa_Utama ?? ''); ?>">
    </div>

    <button type="submit" class="btn btn-success">Simpan Data</button>
    <a href="index.php?page=engines" class="btn btn-secondary">Batal</a>
</form>

<?php include_once 'views/template/footer.php'; ?>