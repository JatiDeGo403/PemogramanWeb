<?php
$base = '../';

// PERBAIKAN PATH: Tambahkan awalan ../
require_once '../includes/auth.php'; // GUARD AUTH JALAN LEBIH DULU
require_once '../includes/koneksi.php';
require_once '../includes/csrf.php'; // PANGGIL FUNGSI CSRF

// PENGAMANAN CSRF: Tolak jika token palsu/kosong
csrf_verify(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = trim($_POST['kode_barang'] ?? '');
    $nama = trim($_POST['nama_barang'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $stok = trim($_POST['stok'] ?? '');

    if (empty($kode) || empty($nama) || empty($harga) || empty($stok)) {
        $_SESSION['flash_error'] = 'Semua field wajib diisi!';
        header('Location: tambah.php');
        exit;
    }

    try {
        // PENGAMANAN SQL INJECTION: Tetap gunakan PDO Prepared Statements
        $sql = "INSERT INTO barang (kode, nama, kategori, harga, stok) VALUES (:kode, :nama, :kategori, :harga, :stok)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':kode'=>$kode, ':nama'=>$nama, ':kategori'=>$kategori, ':harga'=>$harga, ':stok'=>$stok]);
        $_SESSION['flash'] = 'Berhasil menyimpan data barang.';
    } catch (PDOException $e) {
        $_SESSION['flash_error'] = 'DB Error: ' . $e->getMessage();
        header('Location: tambah.php');
        exit;
    }
    header('Location: list.php');
    exit;
}
header('Location: list.php');
exit;