// ===== 1. Hamburger menu =====
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector(".navbar"); 
    if (!toggleBtn || !nav) return;
    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

// ===== 2. Konfirmasi Hapus (Event Delegation) =====
function initHapusConfirm() {
    // Karena baris dirender belakangan, kita pasang event listener di 'document' (Event Delegation)[cite: 14]
    document.addEventListener("click", function (e) {
        if (e.target && e.target.classList.contains("btn-hapus")) {
            const row = e.target.closest("tr");
            const namaElement = row ? row.querySelectorAll("td")[2] : null; // Ambil kolom NAMA (index ke-2)
            const nama = namaElement ? namaElement.textContent.trim() : "data ini";
            
            const yakin = confirm(`Yakin ingin menghapus "${nama}"?`);
            if (yakin && row) {
                row.remove();
            }
        }
    });
}

// ===== 3. Filter/pencarian tabel real-time =====
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            const teks = row.textContent.toLowerCase();
            row.style.display = teks.includes(keyword) ? "" : "none";
        });
    });
}

// ===== 4. Validasi form =====
function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.style.color = "#d9534f"; 
    span.style.fontSize = "0.85rem";
    span.style.display = "block";
    span.style.marginTop = "0.25rem";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
    input.style.borderColor = "#d9534f"; 
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
    input.style.borderColor = ""; 
}

function initValidasiForm() {
    const form = document.querySelector("form");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        let valid = true;
        const fieldWajib = form.querySelectorAll("[name='kode_barang'], [name='nama_barang'], [name='id_karyawan'], [name='nama_lengkap']");
        
        fieldWajib.forEach(function(input) {
            if (input.value.trim() === "") {
                tampilkanError(input, "Field ini wajib diisi.");
                valid = false;
            } else {
                hapusError(input);
            }
        });

        const harga = form.querySelector("[name='harga']");
        if (harga && (isNaN(parseInt(harga.value, 10)) || parseInt(harga.value, 10) < 0)) {
            tampilkanError(harga, "Harga tidak boleh bernilai negatif.");
            valid = false;
        } else if (harga) hapusError(harga);

        const stok = form.querySelector("[name='stok']");
        if (stok && (isNaN(parseInt(stok.value, 10)) || parseInt(stok.value, 10) < 0)) {
            tampilkanError(stok, "Stok tidak boleh bernilai negatif.");
            valid = false;
        } else if (stok) hapusError(stok);

        if (!valid) e.preventDefault();
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});