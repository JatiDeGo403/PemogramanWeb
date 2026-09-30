<?php
session_start();
session_unset();    // Mengosongkan variabel sesi
session_destroy();  // Menghancurkan sesi secara penuh
header("Location: ../index.php"); // Melempar kembali ke Beranda
exit;