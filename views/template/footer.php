<?php 
// File: views/template/footer.php 
?>
</div> <footer class="footer fixed-bottom">
    <div class="container text-center text-muted">
        <small>&copy; 2025 GameStore MVVM App</small>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
// Skrip Data Binding Sederhana (Optional: Untuk interaktivitas klien)
$(document).ready(function(){
    // Contoh konfirmasi delete
    $('.delete-btn').on('click', function(e){
        if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            e.preventDefault();
        }
    });
});
</script>

</body>
</html>