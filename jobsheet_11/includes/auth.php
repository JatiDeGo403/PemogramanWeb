<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Jika belum login, lempar ke halaman login
if (!isset($_SESSION['user_id'])) {
    $base_path = isset($base) ? $base : '';
    header("Location: " . $base_path . "../auth/login.php");
    exit;
}
?>