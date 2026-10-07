<?php
// Fungsi e() untuk membungkus output HTML agar script jahat menjadi teks biasa
function e($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}
?>