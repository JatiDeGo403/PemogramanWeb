<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// $base diatur dari file yang memanggil agar path CSS/Link tidak error
$base = isset($base) ? $base : '';
$title = isset($title) ? $title : 'Sistem Penjualan';
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
        <a href="<?= $base ?>Barang/tambah.php">Tambah Barang</a>
        <a href="<?= $base ?>karyawan/list.php">Data Karyawan</a>
        <a href="<?= $base ?>karyawan/tambah.php">Tambah Karyawan</a>
    </nav>
    <main></main>