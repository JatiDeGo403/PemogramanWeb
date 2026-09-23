// Mengambil & menampilkan Daftar Karyawan asinkron[cite: 14]
async function muatDaftarKaryawan() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = ""; 

    try {
        await new Promise(resolve => setTimeout(resolve, 600)); // Simulasi delay[cite: 14]
        const res = await fetch("../data/karyawan.json");
        
        if (!res.ok) throw new Error("Gagal mengambil data (status " + res.status + ")");
        
        const daftarKaryawan = await res.json();
        let html = "";
        
        daftarKaryawan.forEach(function (kry, index) {
            html += `<tr>
                        <td>${index + 1}</td>
                        <td>${kry.id}</td>
                        <td>${kry.nama}</td>
                        <td>${kry.posisi}</td>
                        <td>${kry.no_wa}</td>
                        <td>${kry.alamat}</td>
                        <td>
                            <button type="button" class="btn btn-hapus" style="background-color: #d9534f;">Hapus</button>
                        </td>
                     </tr>`;
        });
        tbody.innerHTML = html;

    } catch (err) {
        tbody.innerHTML = `<tr><td colspan="7" style="color:red; text-align:center;">Gagal memuat data: ${err.message}</td></tr>`;
    } finally {
        loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", muatDaftarKaryawan);