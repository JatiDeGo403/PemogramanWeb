<?php
session_start();
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;
    $id_karyawan = trim($_POST['id_karyawan'] ?? '');
    $nama = trim($_POST['nama_lengkap'] ?? '');
    $posisi = trim($_POST['posisi'] ?? '');
    $no_wa = trim($_POST['no_wa'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');

    if (empty($id_karyawan) || empty($nama)) {
        $_SESSION['flash_error'] = 'Gagal update: ID Karyawan dan Nama wajib diisi!';
        header("Location: edit.php?id=$id");
        exit;
    }

    try {
        $sql = "UPDATE karyawan SET id_karyawan = :id_karyawan, nama = :nama, posisi = :posisi, no_wa = :no_wa, alamat = :alamat WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_karyawan' => $id_karyawan,
            ':nama' => $nama,
            ':posisi' => $posisi,
            ':no_wa' => $no_wa,
            ':alamat' => $alamat,
            ':id' => $id
        ]);
        
        $_SESSION['flash'] = 'Berhasil! Data karyawan telah diperbarui.';
    } catch (PDOException $e) {
        $_SESSION['flash_error'] = 'Database error: ' . $e->getMessage();
        header("Location: edit.php?id=$id");
        exit;
    }
    
    header('Location: list.php');
    exit;
} else {
    header('Location: list.php');
    exit;
}