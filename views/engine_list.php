<?php 
// File: views/engine_list.php
$page_title = "Daftar Engines";
include_once 'views/template/header.php';

// Menampilkan pesan error atau sukses
if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['msg_type']; ?> alert-dismissible fade show" role="alert">
        <?php 
        echo $_SESSION['message']; 
        unset($_SESSION['message']);
        unset($_SESSION['msg_type']);
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; 

// $viewModel adalah instance dari EngineViewModel
$stmt = $viewModel->getEngines();
$num = $stmt->rowCount();
?>

<a href="index.php?page=engines&action=create" class="btn btn-primary mb-3">Tambah Engine Baru</a>

<?php if ($num > 0): ?>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Engine</th>
            <th>Bahasa Utama</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo htmlspecialchars($row['Nama']); ?></td>
            <td><?php echo htmlspecialchars($row['Bahasa_Utama']); ?></td>
            <td>
                <a href="index.php?page=engines&action=edit&id=<?php echo $row['ID']; ?>" class="btn btn-sm btn-info">Edit</a>
                <a href="index.php?page=engines&action=delete&id=<?php echo $row['ID']; ?>" class="btn btn-sm btn-danger delete-btn">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php else: ?>
    <div class="alert alert-warning">Tidak ada data Engines.</div>
<?php endif; ?>

<?php include_once 'views/template/footer.php'; ?>