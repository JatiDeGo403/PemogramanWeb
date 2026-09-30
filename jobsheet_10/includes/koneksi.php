<?php
$host = '127.0.0.1';
$port = '5432';
$dbname = 'sistem_penjualan';
$user = 'postgres';
$pass = '1234'; // Ganti dengan password pgAdmin Anda

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>