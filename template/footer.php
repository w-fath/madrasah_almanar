<!-- Notifikasi -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if (!$_SESSION['notif_shown']): ?>
            Swal.fire({
                title: 'Selamat datang, <?php echo $fullname; ?>',
                text: 'Tetap semangat dalam belajar yaa!',
                icon: 'info',
                confirmButtonText: 'OK'
            }).then(function() {
                <?php $_SESSION['notif_shown'] = true; ?>
            });
        <?php endif; ?>
        // Konfirmasi Logout
        document.getElementById('logoutLink').addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../../logout.php';
                }
            });
        });
    });
</script>
<!-- Footer -->
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.1.0
    </div>
    <strong>Copyright &copy; 2024 <a href="">Team IT Alumni Al-Manar</a>.</strong> All rights reserved.
</footer>