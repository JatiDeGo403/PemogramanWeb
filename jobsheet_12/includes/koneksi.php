<?php
// Mengambil data dari environment variables Railway, atau fallback ke localhost jika di CachyOS
$host     = getenv('DB_HOST') ?: 'localhost';
$dbname   = getenv('DB_NAME') ?: 'sistem_penjualan';
$user     = getenv('DB_USER') ?: 'postgres';
$password = getenv('DB_PASSWORD') ?: 'password_lokal_anda';
$port     = '5432';

try {
    // Jika berjalan di cloud (Railway/Neon), tambahkan parameter sslmode=require
    $ssl = getenv('DB_HOST') ? ";sslmode=require" : "";
    
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname$ssl";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>