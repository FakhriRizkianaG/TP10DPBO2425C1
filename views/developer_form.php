<?php 
// File: views/developer_form.php

// $viewModel sudah di-inject dengan data (jika Edit) atau kosong (jika Create)
$is_edit = $viewModel->ID !== null;
$page_title = $is_edit ? "Edit Developer: " . htmlspecialchars($viewModel->Nama) : "Tambah Developer Baru";
include_once 'views/template/header.php';

// Ambil data untuk dropdown Pemilik dari ViewModel
$owners_stmt = $viewModel->getOwnersList();
?>

<?php if (!empty($viewModel->Error)): ?>
    <div class="alert alert-danger"><?php echo $viewModel->Error; ?></div>
<?php endif; ?>

<form action="index.php?page=developers&action=save" method="POST">
    
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($viewModel->ID ?? ''); ?>">

    <div class="form-group">
        <label for="nama">Nama Developer</label>
        <input type="text" class="form-control" id="nama" name="nama" 
               value="<?php echo htmlspecialchars($viewModel->Nama ?? ''); ?>" required>
    </div>

    <div class="form-group">
        <label for="pemilik_id">Pemilik (User)</label>
        <select class="form-control" id="pemilik_id" name="pemilik_id" required>
            <option value="">Pilih Pemilik User</option>
            <?php while ($row = $owners_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $row['ID']; ?>" 
                    <?php echo ($row['ID'] == ($viewModel->Pemilik_ID ?? null)) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['Nama']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan Data</button>
    <a href="index.php?page=developers" class="btn btn-secondary">Batal</a>
</form>

<?php include_once 'views/template/footer.php'; ?>