<?php
$base = '../';
$title = 'Sistem Penjualan | Register';
include 'includes/header.php';
?>

<div class="card" style="max-width: 500px; margin: 2rem auto;">
    <div class="card-title" style="text-align: center;">Daftar Akun Baru</div>
    
    <?php if(isset($_SESSION['flash_error'])): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 1rem; border-radius: 4px; border: 1px solid #f5c6cb;">
            <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
        </div>
    <?php endif; ?>

    <form action="proses_register.php" method="POST">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="button-group" style="justify-content: center; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">Daftar</button>
        </div>
        <p style="text-align: center; margin-top: 1rem; font-size: 0.9rem;">
            Sudah punya akun? <a href="login.php" style="color: #FF8C00; font-weight: bold;">Login di sini</a>
        </p>
    </form>
</div>

<?php include 'includes/footer.php'; ?>