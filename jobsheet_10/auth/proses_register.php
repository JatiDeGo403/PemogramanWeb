<?php
session_start();
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validasi input kosong
    if (empty($nama) || empty($username) || empty($password)) {
        $_SESSION['flash_error'] = 'Semua field wajib diisi!';
        header('Location: register.php');
        exit;
    }

    // Pengecekan agar tidak ada username yang kembar
    $stmtCek = $pdo->prepare("SELECT id FROM users WHERE username = :username");
    $stmtCek->execute([':username' => $username]);
    if ($stmtCek->fetch()) {
        $_SESSION['flash_error'] = 'Username sudah digunakan, silakan pilih yang lain!';
        header('Location: register.php');
        exit;
    }

    try {
        // Enkripsi password sebelum disimpan ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (nama, username, password) VALUES (:nama, :username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nama' => $nama,
            ':username' => $username,
            ':password' => $hashed_password
        ]);

        $_SESSION['flash'] = 'Registrasi berhasil! Silakan login menggunakan akun tersebut.';
        header('Location: login.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['flash_error'] = 'Database error: ' . $e->getMessage();
        header('Location: register.php');
        exit;
    }
}

header('Location: register.php');
exit;