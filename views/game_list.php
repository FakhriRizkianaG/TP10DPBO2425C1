<?php 
// File: views/game_list.php
$page_title = "Daftar Games";
include_once 'views/template/header.php';

// Pesan sukses/error
if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['msg_type']; ?>"><?php echo $_SESSION['message']; unset($_SESSION['message']); unset($_SESSION['msg_type']); ?></div>
<?php endif; 

$stmt = $viewModel->getGames();
$num = $stmt->rowCount();
?>

<a href="index.php?page=games&action=create" class="btn btn-primary mb-3">Tambah Game Baru</a>

<?php if ($num > 0): ?>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Game</th>
            <th>Genre</th>
            <th>Developer</th>
            <th>Engine</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo htmlspecialchars($row['Nama']); ?></td>
            <td><?php echo htmlspecialchars($row['Genre']); ?></td>
            <td><?php echo htmlspecialchars($row['Developer_Nama']); ?></td>
            <td><?php echo htmlspecialchars($row['Engine_Nama']); ?></td>
            <td>
                <a href="index.php?page=games&action=edit&id=<?php echo $row['ID']; ?>" class="btn btn-sm btn-info">Edit</a>
                <a href="index.php?page=games&action=delete&id=<?php echo $row['ID']; ?>" class="btn btn-sm btn-danger delete-btn">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php else: ?>
    <div class="alert alert-warning">Tidak ada data Games.</div>
<?php endif; ?>

<?php include_once 'views/template/footer.php'; ?>