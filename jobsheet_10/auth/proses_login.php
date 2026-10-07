<?php
session_start();
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Ambil data user berdasarkan username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifikasi kecocokan password hash
    if ($user && password_verify($password, $user['password'])) {
        // Jika cocok, simpan data ke dalam sesi
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nama'] = $user['nama'];
        $_SESSION['user_role'] = $user['role'];
        
        // Arahkan ke halaman utama (Dashboard)
        header('Location: ../index.php');
        exit;
    } else {
        // Jika gagal, kembalikan ke halaman login dengan pesan error
        $_SESSION['flash_error'] = 'Username atau Password salah!';
        header('Location: login.php');
        exit;
    }
}

header('Location: login.php');
exit;