<?php
$base = '../';
require_once 'includes/auth.php'; // GUARD AUTH
require_once 'includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;
    $kode = trim($_POST['kode_barang'] ?? '');
    $nama = trim($_POST['nama_barang'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $stok = trim($_POST['stok'] ?? '');

    if (empty($kode) || empty($nama)) {
        $_SESSION['flash_error'] = 'Semua field wajib diisi!';
        header("Location: edit.php?id=$id");
        exit;
    }

    try {
        $sql = "UPDATE barang SET kode=:kode, nama=:nama, kategori=:kategori, harga=:harga, stok=:stok WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':kode'=>$kode, ':nama'=>$nama, ':kategori'=>$kategori, ':harga'=>$harga, ':stok'=>$stok, ':id'=>$id]);
        $_SESSION['flash'] = 'Berhasil diperbarui.';
    } catch (PDOException $e) {
        $_SESSION['flash_error'] = 'DB Error: ' . $e->getMessage();
        header("Location: edit.php?id=$id");
        exit;
    }
}
header('Location: list.php');
exit;