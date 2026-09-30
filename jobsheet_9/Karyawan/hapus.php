<?php
session_start();
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash'] = 'Metode tidak diizinkan!';
    header('Location: list.php');
    exit;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM karyawan WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $_SESSION['flash'] = 'Berhasil! Data karyawan telah dihapus.';
    } catch (PDOException $e) {
        $_SESSION['flash'] = 'Gagal menghapus data: ' . $e->getMessage();
    }
}

header('Location: list.php');
exit;