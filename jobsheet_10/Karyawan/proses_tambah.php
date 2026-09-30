<?php
$base = '../';
require_once '../includes/auth.php'; // GUARD: Harus login
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_karyawan = trim($_POST['id_karyawan'] ?? '');
    $nama = trim($_POST['nama_lengkap'] ?? '');
    $posisi = trim($_POST['posisi'] ?? '');
    $no_wa = trim($_POST['no_wa'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');

    // Validasi
    if (empty($id_karyawan) || empty($nama)) {
        $_SESSION['flash_error'] = 'Gagal: ID Karyawan dan Nama Lengkap wajib diisi!';
        header('Location: tambah.php');
        exit;
    }

    try {
        $sql = "INSERT INTO karyawan (id_karyawan, nama, posisi, no_wa, alamat) 
                VALUES (:id_karyawan, :nama, :posisi, :no_wa, :alamat) RETURNING id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_karyawan' => $id_karyawan,
            ':nama' => $nama,
            ':posisi' => $posisi,
            ':no_wa' => $no_wa,
            ':alamat' => $alamat
        ]);

        $_SESSION['flash'] = 'Berhasil! Data karyawan telah ditambahkan.';
    } catch (PDOException $e) {
        $_SESSION['flash_error'] = 'Database error: ' . $e->getMessage();
        header('Location: tambah.php');
        exit;
    }
    
    header('Location: list.php');
    exit;
} else {
    header('Location: tambah.php');
    exit;
}