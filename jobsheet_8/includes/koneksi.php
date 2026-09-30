<?php
$host = '127.0.0.1';
$port = '5432';
$dbname = 'sistem_penjualan'; // Nama database yang baru dibuat
$user = 'postgres';           // Sesuaikan dengan username postgres Anda
$pass = 'password_anda';      // Sesuaikan dengan password postgres Anda

try {
    // Membuat koneksi PDO
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    // Mengatur mode error menjadi exception agar mudah di-debug
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>