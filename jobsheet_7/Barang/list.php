<?php
$base = '../'; // Karena masuk 1 folder
$title = 'Sistem Penjualan | Data Barang';
include '../includes/header.php';

// Inisialisasi array session jika kosong
if (!isset($_SESSION['barang'])) {
    $_SESSION['barang'] = [];
}
?>

<div class="card">
    <div class="card-title">Daftar Barang Tersedia</div>
    
    <!-- Tampilkan Flash Message Jika Ada -->
    <?php if(isset($_SESSION['flash'])): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 1rem; border-radius: 4px; border: 1px solid #c3e6cb;">
            <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
        </div>
    <?php endif; ?>

    <div class="form-group" style="margin-bottom: 1.5rem;">
        <label for="search-input">Cari Nama Barang</label>
        <input type="text" id="search-input" placeholder="Ketik nama barang..." style="max-width: 300px;">
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>KODE BARANG</th>
                    <th>NAMA BARANG</th>
                    <th>KATEGORI</th>
                    <th>HARGA (Rp)</th>
                    <th>STOK</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($_SESSION['barang'])): ?>
                    <tr><td colspan="7" style="text-align: center;">Belum ada data barang.</td></tr>
                <?php else: ?>
                    <?php foreach ($_SESSION['barang'] as $index => $brg): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($brg['kode']) ?></td>
                        <td><?= htmlspecialchars($brg['nama']) ?></td>
                        <td><?= htmlspecialchars($brg['kategori']) ?></td>
                        <td><?= htmlspecialchars($brg['harga']) ?></td>
                        <td><?= htmlspecialchars($brg['stok']) ?></td>
                        <td>
                            <button type="button" class="btn btn-hapus" style="background-color: #d9534f;">Hapus</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>