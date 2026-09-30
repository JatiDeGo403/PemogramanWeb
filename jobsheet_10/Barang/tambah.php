<?php
$base = '../';
require_once 'includes/auth.php'; // GUARD AUTH
$title = 'Sistem Penjualan | Tambah Barang';
include 'includes/header.php';
?>
<!-- Isi form sama dengan file Barang/tambah.php di tahap sebelumnya, pastikan <form id="form-data" action="proses_tambah.php" method="POST" novalidate> -->
<div class="card">
    <div class="card-title">Tambah Data Barang Baru</div>
    <?php if(isset($_SESSION['flash_error'])): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 1rem; border-radius: 4px;"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?></div>
    <?php endif; ?>

    <form id="form-data" action="proses_tambah.php" method="POST" novalidate>
        <div class="form-group"><label>Kode Barang</label><input type="text" name="kode_barang" required></div>
        <div class="form-group"><label>Nama Barang</label><input type="text" name="nama_barang" required></div>
        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori">
                <option value="Elektronik">Elektronik</option>
                <option value="Aksesoris">Aksesoris</option>
                <option value="ATK">Alat Tulis Kantor (ATK)</option>
            </select>
        </div>
        <div class="form-group"><label>Harga (Rp)</label><input type="number" name="harga" min="0" required></div>
        <div class="form-group"><label>Stok</label><input type="number" name="stok" min="0" required></div>
        
        <div class="button-group">
            <button type="submit" class="btn btn-primary">Simpan Barang</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='list.php'">Batal</button>
        </div>
    </form>
</div>
<?php include 'includes/footer.php'; ?>