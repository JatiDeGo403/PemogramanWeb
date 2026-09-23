// Mengambil & menampilkan Daftar Barang asinkron
async function muatDaftarBarang() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = ""; // Kosongkan tabel

    try {
        // Simulasi delay jaringan 600ms
        await new Promise(resolve => setTimeout(resolve, 600)); 
        const res = await fetch("../data/barang.json");
        
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")"); // Pesan error[cite: 14]
        }
        
        const daftarBarang = await res.json();
        let html = "";
        
        daftarBarang.forEach(function (barang, index) {
            html += `<tr>
                        <td>${index + 1}</td>
                        <td>${barang.kode}</td>
                        <td>${barang.nama}</td>
                        <td>${barang.kategori}</td>
                        <td>${barang.harga}</td>
                        <td>${barang.stok}</td>
                        <td>
                            <button type="button" class="btn btn-hapus" style="background-color: #d9534f;">Hapus</button>
                        </td>
                     </tr>`;
        });
        tbody.innerHTML = html;

    } catch (err) {
        tbody.innerHTML = `<tr><td colspan="7" style="color:red; text-align:center;">Gagal memuat data: ${err.message}</td></tr>`; // Pesan error dalam tabel[cite: 14]
    } finally {
        loading.style.display = "none"; // Sembunyikan loading[cite: 14]
    }
}

document.addEventListener("DOMContentLoaded", muatDaftarBarang);