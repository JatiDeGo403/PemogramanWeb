// ===== 1. Hamburger menu (JS-driven, menggantikan checkbox hack) =====
function initNavToggle() {
    // Pastikan Anda mengubah <input type="checkbox"> menjadi <button id="nav-toggle-btn"> di HTML
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector(".navbar"); // Mengambil class navbar yang kita buat
    
    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

// ===== 2. Konfirmasi hapus (front-end only) =====
function initHapusConfirm() {
    // Mencari semua tombol dengan class 'btn-hapus'
    document.querySelectorAll(".btn-hapus").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const row = btn.closest("tr");
            
            // Mengambil nama barang/karyawan dari kolom ke-3 (index 2) pada tabel
            const namaElement = row ? row.querySelectorAll("td")[2] : null;
            const nama = namaElement ? namaElement.textContent.trim() : "data ini";
            
            const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
            if (yakin && row) {
                row.remove();
            }
        });
    });
}

// ===== 3. Filter/pencarian tabel real-time =====
function initTableFilter() {
    // Pastikan Anda menambahkan <input type="text" id="search-input"> di atas tabel HTML Anda
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        
        rows.forEach(function (row) {
            // Mencari kecocokan teks di seluruh baris
            const teks = row.textContent.toLowerCase();
            row.style.display = teks.includes(keyword) ? "" : "none";
        });
    });
}

// ===== 4. Validasi form (client-side) dengan manipulasi DOM =====
function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    // Inline styling untuk error agar langsung terlihat tanpa mengubah CSS tambahan
    span.style.color = "#d9534f"; 
    span.style.fontSize = "0.85rem";
    span.style.display = "block";
    span.style.marginTop = "0.25rem";
    span.textContent = pesan;
    
    input.insertAdjacentElement("afterend", span);
    input.style.borderColor = "#d9534f"; // Mengubah warna border input menjadi merah
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
    input.style.borderColor = ""; // Mengembalikan warna border ke setelan CSS default
}

function initValidasiForm() {
    // Mengambil form di halaman (baik form barang maupun karyawan)
    const form = document.querySelector("form");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        // A. Validasi Kolom Wajib (berlaku untuk Barang dan Karyawan)
        const fieldWajib = form.querySelectorAll("[name='kode_barang'], [name='nama_barang'], [name='id_karyawan'], [name='nama_lengkap']");
        fieldWajib.forEach(function(input) {
            if (input.value.trim() === "") {
                tampilkanError(input, "Field ini wajib diisi.");
                valid = false;
            } else {
                hapusError(input);
            }
        });

        // B. Validasi Harga (Khusus Form Tambah Barang)
        const harga = form.querySelector("[name='harga']");
        if (harga) {
            const nilaiHarga = parseInt(harga.value, 10);
            if (isNaN(nilaiHarga) || nilaiHarga < 0) {
                tampilkanError(harga, "Harga tidak boleh bernilai negatif.");
                valid = false;
            } else {
                hapusError(harga);
            }
        }

        // C. Validasi Stok (Khusus Form Tambah Barang)
        const stok = form.querySelector("[name='stok']");
        if (stok) {
            const nilaiStok = parseInt(stok.value, 10);
            if (isNaN(nilaiStok) || nilaiStok < 0) {
                tampilkanError(stok, "Stok tidak boleh bernilai negatif.");
                valid = false;
            } else {
                hapusError(stok);
            }
        }

        // Cegah halaman berpindah/refresh jika ada error
        if (!valid) {
            e.preventDefault();
        }
    });
}

// ===== Inisialisasi Semua Fungsi Saat Halaman Dimuat =====
document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});