<?php
$base = '../'; 
require_once '../includes/auth.php'; // GUARD AUTH
$title = 'Sistem Penjualan | Data Karyawan';
include '../includes/header.php';
require_once '../includes/koneksi.php';

$limit = 5; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$q = isset($_GET['q']) ? trim($_GET['q']) : '';

$sqlCount = "SELECT COUNT(*) FROM karyawan";
if ($q !== '') {
    $sqlCount .= " WHERE nama ILIKE :kw OR id_karyawan ILIKE :kw";
    $stmtCount = $pdo->prepare($sqlCount);
    $stmtCount->execute([':kw' => "%$q%"]);
} else {
    $stmtCount = $pdo->query($sqlCount);
}
$totalPages = ceil($stmtCount->fetchColumn() / $limit);

$sqlData = "SELECT * FROM karyawan" . ($q !== '' ? " WHERE nama ILIKE :kw OR id_karyawan ILIKE :kw" : "") . " ORDER BY id DESC LIMIT :limit OFFSET :offset";
$stmtData = $pdo->prepare($sqlData);
if ($q !== '') $stmtData->bindValue(':kw', "%$q%");
$stmtData->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmtData->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmtData->execute();
$data_karyawan = $stmtData->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-title">Daftar Karyawan Bertugas</div>
    <?php if(isset($_SESSION['flash'])): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 1rem; border-radius: 4px;"><?= $_SESSION['flash']; unset($_SESSION['flash']); ?></div>
    <?php endif; ?>

    <form method="GET" action="list.php" style="display: flex; gap: 10px; margin-bottom: 1.5rem;">
        <input type="text" name="q" value="<?= $_GET['q'] ?? '' ?>" placeholder="Cari karyawan..." style="flex: 1; padding: 0.5rem; border: 1px solid #f8b46a; border-radius: 4px;">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <div class="table-responsive">
        <table>
            <thead><tr><th>NO</th><th>ID</th><th>NAMA</th><th>POSISI</th><th>NO WA</th><th>ALAMAT</th><th>AKSI</th></tr></thead>
            <tbody>
                <?php if (empty($data_karyawan)): ?>
                    <tr><td colspan="7" style="text-align: center;">Tidak ada data.</td></tr>
                <?php else: $no = $offset + 1; foreach ($data_karyawan as $kry): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($kry['id_karyawan']) ?></td>
                        <td><?= htmlspecialchars($kry['nama']) ?></td>
                        <td><?= htmlspecialchars($kry['posisi']) ?></td>
                        <td><?= htmlspecialchars($kry['no_wa']) ?></td>
                        <td><?= htmlspecialchars($kry['alamat']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $kry['id'] ?>" class="btn btn-secondary" style="background-color:#f0ad4e; padding:0.35rem 0.7rem; display:inline-block;">Edit</a>
                            <form class="form-hapus" method="POST" action="hapus.php" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?= $kry['id'] ?>">
                                <button type="submit" class="btn btn-hapus" style="background-color:#d9534f; padding:0.35rem 0.7rem;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include '../PemogramanWeb/jobsheet_10/includes/footer.php'; ?>