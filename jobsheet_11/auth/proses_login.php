<?php
session_start();
// 1. TAMBAHAN: Perbaiki path koneksi dan panggil file csrf.php
require_once '../includes/koneksi.php';
require_once '../includes/csrf.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 2. TAMBAHAN: Verifikasi token CSRF sebelum memproses apapun
    csrf_verify();

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Ambil data user berdasarkan username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifikasi kecocokan password hash
    if ($user && password_verify($password, $user['password'])) {
        
        // 3. TAMBAHAN: Mencegah Session Fixation
        // Wajib dipanggil tepat setelah password benar, sebelum mengisi data sesi
        session_regenerate_id(true);

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