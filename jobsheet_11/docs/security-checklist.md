# Dokumen Audit Keamanan (Jobsheet 11)

## 1. Cross-Site Scripting (XSS)
- [x] **Status:** Terselesaikan.
- **Implementasi:** Membuat fungsi `e()` di `includes/helpers.php` yang menjalankan `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`.
- **Bukti:** Input barang bernama `<script>alert(1)</script>` saat dirender di `list.php` tampil sebagai teks biasa (di-*escape* menjadi `&lt;script&gt;alert(1)&lt;/script&gt;`).

## 2. Cross-Site Request Forgery (CSRF)
- [x] **Status:** Terselesaikan.
- **Implementasi:** Token unik dibangkitkan via `bin2hex(random_bytes(32))` dan disimpan di sesi. Disisipkan via `csrf_field()` di semua form POST.
- **Bukti:** Eksekusi `curl -X POST http://localhost:8000/barang/proses_tambah.php -d "nama_barang=Uji"` tanpa token mengembalikan respon HTTP 403 Access Denied.

## 3. Session Fixation
- [x] **Status:** Terselesaikan.
- **Implementasi:** Penambahan `session_regenerate_id(true)` di `auth/proses_login.php` tepat setelah password dinyatakan valid dan sebelum data kredensial ditambahkan ke dalam superglobal `$_SESSION`.
- **Bukti:** ID cookie sesi `PHPSESSID` berubah seketika setelah perpindahan *state* dari *guest* menjadi *authenticated user*.

## 4. SQL Injection
- [x] **Status:** Diamankan.
- **Implementasi:** Audit menyeluruh mengonfirmasi tidak ada penyambungan string (concat) pada SQL. Seluruh query menggunakan *PDO Prepared Statements* dengan placeholder `?` atau `:named`.

## 5. Middleware / Guard Order
- [x] **Status:** Validasi Urutan Benar.
- **Implementasi:** File `includes/auth.php` di-*require* sebelum `csrf_verify()`. Jika tamu memaksa POST tanpa login, sistem menolak dan melempar ke `login.php` sebelum memvalidasi token CSRF.