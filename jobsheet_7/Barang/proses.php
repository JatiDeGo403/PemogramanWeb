<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input dari form
    $kode = trim($_POST['kode_barang'] ?? '');
    $nama = trim($_POST['nama_barang'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $stok = trim($_POST['stok'] ?? '');

    // 1. Validasi Server-Side
    if (empty($kode) || empty($nama) || empty($harga) || empty($stok)) {
        $_SESSION['flash_error'] = 'Gagal menyimpan: Semua field wajib diisi!';
        header('Location: tambah.php');
        exit;
    }

    if (!is_numeric($harga) || $harga < 0 || !is_numeric($stok) || $stok < 0) {
        $_SESSION['flash_error'] = 'Gagal menyimpan: Harga dan Stok harus berupa angka valid dan tidak negatif!';
        header('Location: tambah.php');
        exit;
    }

    // 2. Simpan ke Session Array
    if (!isset($_SESSION['barang'])) {
        $_SESSION['barang'] = [];
    }

    $_SESSION['barang'][] = [
        'kode' => $kode,
        'nama' => $nama,
        'kategori' => $kategori,
        'harga' => $harga,
        'stok' => $stok
    ];

    // 3. Set Flash Message Sukses & Redirect
    $_SESSION['flash'] = 'Berhasil! Data barang baru telah disimpan.';
    header('Location: list.php');
    exit;
} else {
    // Jika file diakses langsung tanpa lewat form
    header('Location: tambah.php');
    exit;
}