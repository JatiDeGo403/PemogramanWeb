<?php
$base = '../';
$title = 'Sistem Penjualan | Tambah Barang';
include '../includes/header.php';
?>

<div class="card">
    <div class="card-title">Tambah Data Barang Baru</div>
    
    <!-- Tampilkan Error Validasi Server Jika Ada -->
    <?php if(isset($_SESSION['flash_error'])): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 1rem; border-radius: 4px; border: 1px solid #f5c6cb;">
            <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
        </div>
    <?php endif; ?>

    <!-- Method diubah ke POST, action ke proses_tambah.php -->
    <form action="proses_tambah.php" method="POST" novalidate>
        <div class="form-group">
            <label for="kode_barang">Kode Barang</label>
            <input type="text" id="kode_barang" name="kode_barang" placeholder="Contoh: BRG-004" required>
        </div>
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" id="nama_barang" name="nama_barang" required>
        </div>
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori">
                <option value="Elektronik">Elektronik</option>
                <option value="Aksesoris">Aksesoris</option>
                <option value="ATK">Alat Tulis Kantor (ATK)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="harga">Harga (Rp)</label>
            <input type="number" id="harga" name="harga" min="0" placeholder="Contoh: 150000" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok Awal</label>
            <input type="number" id="stok" name="stok" min="0" value="0" required>
        </div>
        
        <div class="button-group">
            <button type="submit" class="btn btn-primary">Simpan Barang</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='list.php'">Batal</button>
        </div>
    </form>
</div>

<?php include '../includes/footer.php'; ?>