<?php
$base = '../';
require_once '../includes/auth.php'; // GUARD: Harus login
$title = 'Sistem Penjualan | Tambah Karyawan';
include '../includes/header.php';
?>

<div class="card">
    <div class="card-title">Formulir Tambah Karyawan</div>
    
    <?php if(isset($_SESSION['flash_error'])): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 1rem; border-radius: 4px; border: 1px solid #f5c6cb;">
            <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
        </div>
    <?php endif; ?>

    <form id="form-data" action="proses_tambah.php" method="POST" novalidate>
        <div class="form-group">
            <label for="id_karyawan">ID Karyawan</label>
            <input type="text" id="id_karyawan" name="id_karyawan" placeholder="Contoh: KRY-003" required>
        </div>
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Contoh: Budi Santoso" required>
        </div>
        <div class="form-group">
            <label for="posisi">Posisi / Jabatan</label>
            <input type="text" id="posisi" name="posisi" placeholder="Contoh: Supervisor">
        </div>
        <div class="form-group">
            <label for="no_wa">No. Telepon / WhatsApp</label>
            <input type="text" id="no_wa" name="no_wa" placeholder="Contoh: 08123456789">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat Lengkap</label>
            <textarea id="alamat" name="alamat" placeholder="Masukkan alamat karyawan"></textarea>
        </div>
        
        <div class="button-group">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='list.php'">Batal</button>
        </div>
    </form>
</div>

<?php include '../PemogramanWeb/jobsheet_10/includes/footer.php'; ?>