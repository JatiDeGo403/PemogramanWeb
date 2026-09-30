<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id_karyawan'] ?? '');
    $nama = trim($_POST['nama_lengkap'] ?? '');
    $posisi = trim($_POST['posisi'] ?? '');
    $no_wa = trim($_POST['no_wa'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');

    // Validasi
    if (empty($id) || empty($nama)) {
        $_SESSION['flash_error'] = 'Gagal: ID Karyawan dan Nama Lengkap wajib diisi!';
        header('Location: tambah.php');
        exit;
    }

    if (!isset($_SESSION['karyawan'])) {
        $_SESSION['karyawan'] = [];
    }

    $_SESSION['karyawan'][] = [
        'id' => $id,
        'nama' => $nama,
        'posisi' => $posisi,
        'no_wa' => $no_wa,
        'alamat' => $alamat
    ];

    $_SESSION['flash'] = 'Berhasil! Data karyawan telah ditambahkan.';
    header('Location: list.php');
    exit;
} else {
    header('Location: tambah.php');
    exit;
}