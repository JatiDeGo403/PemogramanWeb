<?php
$base = '../';
$title = 'Sistem Penjualan | Edit Barang';
include '../includes/header.php';
require_once '../includes/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM barang WHERE id = :id");
$stmt->execute([':id' => $id]);
$brg = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$brg) {
    $_SESSION['flash'] = 'Data barang tidak ditemukan!';
    header('Location: list.php');
    exit;
}
?>

<div class="card">
    <div class="card-title">Edit Data Barang</div>
    
    <?php if(isset($_SESSION['flash_error'])): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 1rem; border-radius: 4px; border: 1px solid #f5c6cb;">
            <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
        </div>
    <?php endif; ?>

    <form id="form-data" action="proses_edit.php" method="POST" novalidate>
        <input type="hidden" name="id" value="<?= $brg['id'] ?>">
        
        <div class="form-group">
            <label for="kode_barang">Kode Barang</label>
            <input type="text" id="kode_barang" name="kode_barang" value="<?= htmlspecialchars($brg['kode']) ?>" required>
        </div>
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" id="nama_barang" name="nama_barang" value="<?= htmlspecialchars($brg['nama']) ?>" required>
        </div>
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori">
                <option value="Elektronik" <?= $brg['kategori'] == 'Elektronik' ? 'selected' : '' ?>>Elektronik</option>
                <option value="Aksesoris" <?= $brg['kategori'] == 'Aksesoris' ? 'selected' : '' ?>>Aksesoris</option>
                <option value="ATK" <?= $brg['kategori'] == 'ATK' ? 'selected' : '' ?>>Alat Tulis Kantor (ATK)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="harga">Harga (Rp)</label>
            <input type="number" id="harga" name="harga" min="0" value="<?= htmlspecialchars($brg['harga']) ?>" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" id="stok" name="stok" min="0" value="<?= htmlspecialchars($brg['stok']) ?>" required>
        </div>
        
        <div class="button-group">
            <button type="submit" class="btn btn-primary">Update Data</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='list.php'">Batal</button>
        </div>
    </form>
</div>

<?php include '../includes/footer.php'; ?>