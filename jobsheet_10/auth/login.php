<?php
$base = '../';
$title = 'Sistem Penjualan | Login';
include 'includes/header.php';
?>

<div class="card" style="max-width: 500px; margin: 2rem auto;">
    <div class="card-title" style="text-align: center;">Login Sistem</div>
    
    <!-- Notifikasi Error -->
    <?php if(isset($_SESSION['flash_error'])): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 1rem; border-radius: 4px; border: 1px solid #f5c6cb;">
            <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
        </div>
    <?php endif; ?>

    <!-- Notifikasi Sukses (misal habis register) -->
    <?php if(isset($_SESSION['flash'])): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 1rem; border-radius: 4px; border: 1px solid #c3e6cb;">
            <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
        </div>
    <?php endif; ?>

    <form action="proses_login.php" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="button-group" style="justify-content: center; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">Masuk</button>
        </div>
        <p style="text-align: center; margin-top: 1rem; font-size: 0.9rem;">
            Belum punya akun? <a href="register.php" style="color: #FF8C00; font-weight: bold;">Daftar di sini</a>
        </p>
    </form>
</div>

<?php include 'includes/footer.php'; ?>