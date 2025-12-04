<?php 
// Variabel $errorMessage di-extract dari renderView
?>
<h1 style="color: #dc3545;">Terjadi Kesalahan!</h1>
<p>Aplikasi mengalami masalah:</p>
<pre style="border: 1px solid #ccc; padding: 10px; background: #eee;">
    <?php echo htmlspecialchars($errorMessage ?? 'Error tidak diketahui.'); ?>
</pre>
<a href="/index.php" class="btn btn-primary">Kembali ke Beranda (Games)</a>