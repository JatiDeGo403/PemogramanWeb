<?php
$base = '../'; 
$title = 'Sistem Penjualan | Data Barang';
include '../includes/header.php';
require_once '../includes/koneksi.php';

// Konfigurasi Paginasi & Pencarian
$limit = 5; // 5 baris per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

// Hitung total baris (untuk paginasi)
$sqlCount = "SELECT COUNT(*) FROM barang";
if ($q !== '') {
    $sqlCount .= " WHERE nama ILIKE :kw OR kode ILIKE :kw";
    $stmtCount = $pdo->prepare($sqlCount);
    $stmtCount->execute([':kw' => "%$q%"]);
} else {
    $stmtCount = $pdo->query($sqlCount);
}
$totalRows = $stmtCount->fetchColumn();
$totalPages = ceil($totalRows / $limit);

// Ambil data dengan LIMIT dan OFFSET
$sqlData = "SELECT * FROM barang";
if ($q !== '') {
    $sqlData .= " WHERE nama ILIKE :kw OR kode ILIKE :kw";
}
$sqlData .= " ORDER BY id DESC LIMIT :limit OFFSET :offset";

$stmtData = $pdo->prepare($sqlData);
if ($q !== '') {
    $stmtData->bindValue(':kw', "%$q%");
}
$stmtData->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmtData->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmtData->execute();
$data_barang = $stmtData->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-title">Daftar Barang Tersedia</div>
    
    <?php if(isset($_SESSION['flash'])): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 1rem; border-radius: 4px; border: 1px solid #c3e6cb;">
            <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
        </div>
    <?php endif; ?>

    <!-- Form Pencarian Server-Side (GET) -->
    <!-- XSS sengaja dibiarkan pada value pencarian sesuai jobsheet 9 -->
    <form method="GET" action="list.php" style="display: flex; gap: 10px; margin-bottom: 1.5rem;">
        <input type="text" id="search-input" name="q" value="<?= $_GET['q'] ?? '' ?>" placeholder="Cari nama/kode barang..." style="max-width: 300px; flex: 1; padding: 0.5rem; border: 1px solid #f8b46a; border-radius: 4px;">
        <button type="submit" class="btn btn-primary">Cari</button>
        <?php if($q !== ''): ?>
            <a href="list.php" class="btn btn-secondary" style="display:flex; align-items:center; text-decoration:none;">Reset</a>
        <?php endif; ?>
    </form>

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
                <?php if (empty($data_barang)): ?>
                    <tr><td colspan="7" style="text-align: center;">Tidak ada data barang.</td></tr>
                <?php else: ?>
                    <?php 
                    $no = $offset + 1;
                    foreach ($data_barang as $brg): 
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($brg['kode']) ?></td>
                        <td><?= htmlspecialchars($brg['nama']) ?></td>
                        <td><?= htmlspecialchars($brg['kategori']) ?></td>
                        <td><?= htmlspecialchars($brg['harga']) ?></td>
                        <td><?= htmlspecialchars($brg['stok']) ?></td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="edit.php?id=<?= $brg['id'] ?>" class="btn btn-secondary" style="background-color: #f0ad4e; padding: 0.35rem 0.7rem; font-size: 0.85rem; display:inline-block; margin-right: 5px;">Edit</a>
                            
                            <!-- Form Hapus (POST) -->
                            <form class="form-hapus" method="POST" action="hapus.php" style="display: inline-block;">
                                <input type="hidden" name="id" value="<?= $brg['id'] ?>">
                                <button type="submit" class="btn btn-hapus" style="background-color: #d9534f; padding: 0.35rem 0.7rem; font-size: 0.85rem;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginasi -->
    <?php if($totalPages > 1): ?>
    <div style="margin-top: 1.5rem; text-align: center; gap: 5px; display: flex; justify-content: center;">
        <?php for($i=1; $i<=$totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&q=<?= $_GET['q'] ?? '' ?>" class="btn <?= $i == $page ? 'btn-primary' : 'btn-secondary' ?>" style="padding: 0.4rem 0.8rem; text-decoration: none;">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>