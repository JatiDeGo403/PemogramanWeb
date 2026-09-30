<?php
$base = ''; 
$title = 'Sistem Penjualan | Beranda';
include 'includes/header.php';
?>

<div class="card">
    <div class="card-title">Dashboard</div>
    <div class="dashboard-welcome">
        Selamat Datang di Web Pengelola Data Sistem Informasi Penjualan (Versi PHP)
    </div>

    <div class="card-title">Statistik Penjualan</div>
    <div class="stats-grid">
        <article class="stat-card">
            <h3>Total Barang</h3>
            <!-- Data ini sementara statis, nanti bisa dihitung dari count($_SESSION['barang']) -->
            <p><?= isset($_SESSION['barang']) ? count($_SESSION['barang']) : 0 ?></p>
        </article>
        <article class="stat-card">
            <h3>Total Karyawan</h3>
            <p><?= isset($_SESSION['karyawan']) ? count($_SESSION['karyawan']) : 0 ?></p>
        </article>
        <article class="stat-card">
            <h3>Transaksi Hari Ini</h3>
            <p>0</p>
        </article>
    </div>
</div>

<?php
include 'includes/footer.php';
?>