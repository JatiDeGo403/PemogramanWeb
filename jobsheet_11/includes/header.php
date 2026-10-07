<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Wajib di-load pertama kali agar fungsi e() dan csrf() bisa dipakai di semua halaman
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/csrf.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= $base ?>asset/css/style.css">
</head>
<body>
    <header class="top-header">
        <h1>Sistem Informasi Penjualan</h1>
        <p>Manajemen Data Barang & Karyawan</p>
    </header>

    <nav class="navbar">
        <a href="<?= $base ?>index.php">Beranda</a>
        <a href="<?= $base ?>Barang/list.php">Data Barang</a>
        
        <?php if(isset($_SESSION['user_id'])): ?>
            <!-- Muncul jika sudah login -->
            <a href="<?= $base ?>../">Tambah Barang</a>
            <a href="<?= $base ?>karyawan/list.php">Data Karyawan</a>
            <a href="<?= $base ?>karyawan/tambah.php">Tambah Karyawan</a>
            <a href="<?= $base ?>auth/logout.php" style="background-color: #d35400; color: #fff; padding: 2px 10px; border-radius: 4px;">Logout (<?= htmlspecialchars($_SESSION['user_nama']) ?>)</a>
        <?php else: ?>
            <!-- Muncul jika tamu / belum login -->
            <a href="<?= $base ?>auth/login.php" style="background-color: #fff; color: #FF8C00; padding: 2px 10px; border-radius: 4px;">Login</a>
        <?php endif; ?>
    </nav>
    <main>