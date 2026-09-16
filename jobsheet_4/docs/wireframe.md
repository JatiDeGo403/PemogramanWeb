# Wireframe & Struktur Proyek: Sistem Informasi Penjualan

Dokumen ini berisi pemetaan struktur direktori dan rancangan antarmuka (UI/UX) dasar dari aplikasi Sistem Informasi Penjualan.

---

## 1. Struktur Direktori

jobsheet_3/
├── asset/
│   └── css/
│       └── style.css       # File gaya utama (Tema: Oranye & Kuning)
├── Barang/
│   ├── list.html           # Halaman tabel daftar barang
│   └── tambah.html         # Halaman form input barang baru
├── karyawan/
│   ├── list.html           # Halaman tabel daftar karyawan
│   └── tambah.html         # Halaman form input karyawan baru
└── index.html              # Halaman utama / Dashboard

## Beranda / Dashboard
------------------------------------------------------------------------
| [Card Title] Dashboard                                               |
| (Garis Bawah: Oranye)                                                |
|                                                                      |
| Selamat Datang di Web Pengelola Data Sistem Informasi Penjualan      |
|                                                                      |
| [Card Title] Statistik Penjualan                                     |
|                                                                      |
|  +--------------------+  +--------------------+  +--------------------+
|  | TOTAL BARANG       |  | TOTAL KARYAWAN     |  | TRANSAKSI HARI INI |
|  |                    |  |                    |  |                    |
|  | 12                 |  | 8                  |  | 3                  |
|  +--------------------+  +--------------------+  +--------------------+
|  *(Garis kiri pada card statistik berwarna oranye tebal)*            |
------------------------------------------------------------------------

## Halaman Data / Tabel
------------------------------------------------------------------------
| [Card Title] Daftar (Barang/Karyawan) Tersedia                       |
| (Garis Bawah: Oranye)                                                |
|                                                                      |
| +----+-------------+------------------+-------------+--------------+ |
| | NO | KODE/ID     | NAMA             | ATRIBUT 1   | ATRIBUT 2    | | <- Header Tabel (Bg: Oranye)
| +----+-------------+------------------+-------------+--------------+ |
| | 1  | BRG/KRY-001 | Data Nama 1      | Data Info   | Data Info    | |
| +----+-------------+------------------+-------------+--------------+ |
| | 2  | BRG/KRY-002 | Data Nama 2      | Data Info   | Data Info    | |
| +----+-------------+------------------+-------------+--------------+ |
------------------------------------------------------------------------

## Halaman Form Input
------------------------------------------------------------------------
| [Card Title] Formulir Tambah Data (Barang/Karyawan)                  |
| (Garis Bawah: Oranye)                                                |
|                                                                      |
| Label Input 1:                                                       |
| [_______________________________________________________________]    |
|                                                                      |
| Label Input 2:                                                       |
| [_______________________________________________________________]    |
|                                                                      |
| Label Input 3 (Dropdown/Textarea):                                   |
| [_______________________________________________________________]    |
|                                                                      |
| Label Input 4:                                                       |
| [_______________________________________________________________]    |
|                                                                      |
| [ SIMPAN DATA (Bg: Oranye) ]   [ BATAL (Bg: Abu-abu) ]               |
------------------------------------------------------------------------