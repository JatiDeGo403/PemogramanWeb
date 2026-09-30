<?php
$base = '../'; 
$title = 'Sistem Penjualan | Data Karyawan';
include '../includes/header.php';
require_once '../includes/koneksi.php';

$stmt = $pdo->query("SELECT * FROM karyawan ORDER BY id DESC");
$data_karyawan = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-title">Daftar Karyawan Bertugas</div>
    
    <?php if(isset($_SESSION['flash'])): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 1rem; border-radius: 4px; border: 1px solid #c3e6cb;">
            <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
        </div>
    <?php endif; ?>

    <div class="form-group" style="margin-bottom: 1.5rem;">
        <label for="search-input">Cari Nama Karyawan</label>
        <input type="text" id="search-input" placeholder="Ketik nama karyawan..." style="max-width: 300px;">
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ID KARYAWAN</th>
                    <th>NAMA LENGKAP</th>
                    <th>POSISI</th>
                    <th>NO WHATSAPP</th>
                    <th>ALAMAT</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data_karyawan)): ?>
                    <tr><td colspan="7" style="text-align: center;">Belum ada data karyawan di database.</td></tr>
                <?php else: ?>
                    <?php foreach ($data_karyawan as $index => $kry): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($kry['id_karyawan']) ?></td>
                        <td><?= htmlspecialchars($kry['nama']) ?></td>
                        <td><?= htmlspecialchars($kry['posisi']) ?></td>
                        <td><?= htmlspecialchars($kry['no_wa']) ?></td>
                        <td><?= htmlspecialchars($kry['alamat']) ?></td>
                        <td>
                            <button type="button" class="btn btn-hapus" data-id="<?= $kry['id'] ?>" style="background-color: #d9534f;">Hapus</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>