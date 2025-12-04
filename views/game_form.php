<?php 
// File: views/game_form.php

// $viewModel sudah diisi dari index.php
$is_edit = $viewModel->ID !== null;
$page_title = $is_edit ? "Edit Game: " . htmlspecialchars($viewModel->Nama) : "Tambah Game Baru";
include_once 'views/template/header.php';

// Ambil data untuk dropdown
$devs_stmt = $viewModel->getDevelopersList();
$engines_stmt = $viewModel->getEnginesList();
?>

<?php if (!empty($viewModel->Error)): ?>
    <div class="alert alert-danger"><?php echo $viewModel->Error; ?></div>
<?php endif; ?>

<form action="index.php?page=games&action=save" method="POST">
    
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($viewModel->ID ?? ''); ?>">

    <div class="form-group">
        <label for="nama">Nama Game</label>
        <input type="text" class="form-control" id="nama" name="nama" 
               value="<?php echo htmlspecialchars($viewModel->Nama ?? ''); ?>" required>
    </div>

    <div class="form-group">
        <label for="genre">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" 
               value="<?php echo htmlspecialchars($viewModel->Genre ?? ''); ?>">
    </div>

    <div class="form-group">
        <label for="developer_id">Developer</label>
        <select class="form-control" id="developer_id" name="developer_id" required>
            <option value="">Pilih Developer</option>
            <?php while ($row = $devs_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $row['ID']; ?>" 
                    <?php echo ($row['ID'] == ($viewModel->Developer_ID ?? null)) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['Nama']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="engine_id">Engine</label>
        <select class="form-control" id="engine_id" name="engine_id" required>
            <option value="">Pilih Engine</option>
            <?php while ($row = $engines_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $row['ID']; ?>" 
                    <?php echo ($row['ID'] == ($viewModel->Engine_ID ?? null)) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['Nama']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan Data</button>
    <a href="index.php?page=games" class="btn btn-secondary">Batal</a>
</form>

<?php include_once 'views/template/footer.php'; ?>