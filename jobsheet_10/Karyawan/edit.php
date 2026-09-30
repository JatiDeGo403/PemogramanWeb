<?php
$base = '../';
require_once '../includes/auth.php'; // GUARD: Harus login
$title = 'Sistem Penjualan | Edit Karyawan';
include '../includes/header.php';
require_once '../includes/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM karyawan WHERE id = :id");
$stmt->execute([':id' => $id]);
$kry = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$kry) {
    $_SESSION['flash'] = 'Data karyawan tidak ditemukan!';
    header('Location: list.php');
    exit;
}
?>

<div class="card">
    <div class="card-title">Edit Data Karyawan</div>
    
    <?php if(isset($_SESSION['flash_error'])): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 1rem; border-radius: 4px; border: 1px solid #f5c6cb;">
            <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
        </div>
    <?php endif; ?>

    <form id="form-data" action="proses_edit.php" method="POST" novalidate>
        <input type="hidden" name="id" value="<?= $kry['id'] ?>">
        
        <div class="form-group">
            <label for="id_karyawan">ID Karyawan</label>
            <input type="text" id="id_karyawan" name="id_karyawan" value="<?= htmlspecialchars($kry['id_karyawan']) ?>" required>
        </div>
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= htmlspecialchars($kry['nama']) ?>" required>
        </div>
        <div class="form-group">
            <label for="posisi">Posisi / Jabatan</label>
            <input type="text" id="posisi" name="posisi" value="<?= htmlspecialchars($kry['posisi']) ?>">
        </div>
        <div class="form-group">
            <label for="no_wa">No. Telepon / WhatsApp</label>
            <input type="text" id="no_wa" name="no_wa" value="<?= htmlspecialchars($kry['no_wa']) ?>">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat Lengkap</label>
            <textarea id="alamat" name="alamat"><?= htmlspecialchars($kry['alamat']) ?></textarea>
        </div>
        
        <div class="button-group">
            <button type="submit" class="btn btn-primary">Update Data</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='list.php'">Batal</button>
        </div>
    </form>
</div>

<?php include '../PemogramanWeb/jobsheet_10/includes/footer.php'; ?>