<?php
$base = ''; // Variabel path disetel kosong karena file ini berada di luar (root folder)
$title = 'Sistem Penjualan | Beranda';
include 'includes/header.php';
require_once 'includes/koneksi.php'; 

// Menghitung total data langsung dari PostgreSQL
$stmtBarang = $pdo->query("SELECT COUNT(*) FROM barang");
$totalBarang = $stmtBarang->fetchColumn();

$stmtKaryawan = $pdo->query("SELECT COUNT(*) FROM karyawan");
$totalKaryawan = $stmtKaryawan->fetchColumn();
?>

<div class="card">
    <div class="card-title">Dashboard</div>
    <div class="dashboard-welcome">
        Selamat Datang di Web Pengelola Data Sistem Informasi Penjualan.
        <br><br>
        <span style="color: #666; font-size: 0.95rem;">
            *Halaman Beranda dan Daftar Barang dapat diakses oleh publik. 
            Silakan <b>Login</b> untuk dapat mengakses menu Karyawan serta fitur penambahan, pengubahan, dan penghapusan data.
        </span>
    </div>

    <div class="card-title">Statistik Penjualan</div>
    <div class="stats-grid">
        <article class="stat-card">
            <h3>Total Barang</h3>
            <p><?= $totalBarang ?></p>
        </article>
        <article class="stat-card">
            <h3>Total Karyawan</h3>
            <p><?= $totalKaryawan ?></p>
        </article>
        <article class="stat-card">
            <h3>Transaksi Hari Ini</h3>
            <p>0</p>
        </article>
    </div>
</div>

<?php include 'includes/footer.php'; ?>