<?php
$base = '../';
require_once 'includes/auth.php'; // GUARD AUTH
require_once 'includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM barang WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $_SESSION['flash'] = 'Data berhasil dihapus.';
    }
}
header('Location: list.php');
exit;