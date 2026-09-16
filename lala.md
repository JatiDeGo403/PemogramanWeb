┌─────────────────────────────────────────────────────────────┐
│ CompHub     Beranda       Lomba      Bookmark     Profil    │
├─────────────────────────────────────────────────────────────┤ 
│                                                             │
│ Cari Lomba                                                  │
│ [.................................................] [Cari]  │
│                                                             │
│ Filter Kategori                                             │
│ [Semua] [Teknologi] [Bisnis] [Desain] [Lainnya]             │
│                                                             │
│ ┌─────────────────────────────────────────────────────────┐ │
│ │ National Coding Competition                             │ │
│ │ Teknologi | Deadline: 30 Oktober 2026                   │ │
│ │ [Lihat Detail]                                          │ │
│ └─────────────────────────────────────────────────────────┘ │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│ ← Kembali                                                   │
├─────────────────────────────────────────────────────────────┤
│  NATIONAL CODING COMPETITION                                │
│ ✓ Telah diverifikasi Admin                                  │
│ Penyelenggara : ABC Technology                              │
│ Kategori : Teknologi                                        │
│ Deadline : 25 September 2026                                │
│ Hadiah : Rp10.000.000                                       │
│                                                             │
│ Deskripsi                                                   │
│ ..........................................................  │
│ Persyaratan                                                 │
│ ..........................................................  │
│ [ DAFTAR SEKARANG ]                                         │
└─────────────────────────────────────────────────────────────┘ 

Betul. Pada versi sebelumnya, **peran Admin sebagai filter/verifikator dan pihak yang menentukan apakah lomba dipublikasikan belum ditonjolkan secara eksplisit di bagian 6**. Padahal ini penting karena konsep produk Anda memang memiliki alur **penyedia → pengajuan → admin melakukan filter/verifikasi → publish → mahasiswa**.

Menurut format proposal, bagian 6.1 harus konsisten dengan fitur pada 5.3, dan bagian 6.2 harus menunjukkan view utama produk.  

Bagian 6 sebaiknya diperbaiki seperti ini.

# 6. Rencana Teknis Awal

## 6.1 Rancangan Basis Data Awal

Rancangan basis data awal CompHub terdiri atas beberapa entitas yang mendukung proses penyimpanan, pengajuan, verifikasi, dan publikasi informasi perlombaan. Dalam rancangan ini, **Admin berperan sebagai pihak yang melakukan proses penyaringan dan verifikasi terhadap pengajuan lomba sebelum informasi tersebut dapat dipublikasikan kepada mahasiswa**.

### Entitas utama

| Entitas             | Fungsi utama                                                                               | Relasi                                  |
| ------------------- | ------------------------------------------------------------------------------------------ | --------------------------------------- |
| **Pengguna**        | Menyimpan data akun mahasiswa, admin, dan penyedia lomba                                   | 1-N dengan Pengajuan Lomba dan Bookmark |
| **Kategori**        | Menyimpan kategori atau bidang lomba                                                       | 1-N dengan Lomba                        |
| **Pengajuan Lomba** | Menyimpan informasi lomba yang diajukan oleh penyedia dan menunggu proses verifikasi Admin | N-1 dengan Pengguna                     |
| **Lomba**           | Menyimpan informasi lomba yang telah disetujui dan dipublikasikan                          | N-1 dengan Kategori                     |
| **Bookmark**        | Menyimpan lomba yang dipilih mahasiswa                                                     | N-1 dengan Pengguna dan Lomba           |

### Relasi dan proses verifikasi

Relasi utama pada rancangan awal adalah sebagai berikut:

1. **Pengguna – Pengajuan Lomba (1-N)**
   Satu penyedia dapat mengajukan beberapa informasi lomba. Setiap pengajuan dicatat sebagai data yang berstatus **menunggu verifikasi**.

2. **Admin – Pengajuan Lomba (1-N)**
   Satu Admin dapat memeriksa banyak pengajuan lomba. Admin melakukan penyaringan berdasarkan kelengkapan informasi, kesesuaian kategori, duplikasi, dan validitas informasi yang diberikan.

3. **Pengajuan Lomba – Lomba (0-1)**
   Satu pengajuan dapat **tidak menghasilkan data lomba** apabila ditolak atau ditandai sebagai tidak layak. Sebaliknya, pengajuan yang disetujui Admin akan diterbitkan menjadi data Lomba yang dapat dilihat mahasiswa.

4. **Kategori – Lomba (1-N)**
   Satu kategori dapat memiliki banyak lomba dan satu lomba memiliki kategori tertentu.

5. **Pengguna – Lomba melalui Bookmark (N-N)**
   Satu mahasiswa dapat menyimpan banyak lomba dan satu lomba dapat disimpan oleh banyak mahasiswa. Relasi N-N tersebut direalisasikan melalui entitas Bookmark.

### Status Pengajuan Lomba

Untuk memperjelas fungsi Admin sebagai filter, entitas **Pengajuan Lomba** memiliki status:

```text
PENDING
   │
   ├── APPROVED ──────► DIPUBLIKASIKAN
   │
   ├── REJECTED ──────► TIDAK DIPUBLIKASIKAN
   │
   ├── DUPLICATE ─────► TIDAK DIPUBLIKASIKAN
   │
   └── SPAM ──────────► TIDAK DIPUBLIKASIKAN
```

Dengan mekanisme tersebut, **data yang dimasukkan oleh penyedia tidak langsung tampil kepada mahasiswa**. Data terlebih dahulu berada pada tabel pengajuan dan hanya dapat dipindahkan menjadi data lomba yang dipublikasikan setelah Admin menyetujui pengajuan tersebut.

### Sketsa ERD awal

```text
                         ┌──────────────────┐
                         │     PENGGUNA     │
                         │──────────────────│
                         │ PK id_pengguna   │
                         │ NIM / email      │
                         │ nama             │
                         │ password         │
                         │ role             │
                         └────────┬─────────┘
                                  │
                         1        │        N
                                  │
                    ┌─────────────▼─────────────┐
                    │     PENGAJUAN_LOMBA       │
                    │────────────────────────────│
                    │ PK id_pengajuan            │
                    │ FK id_pengguna             │
                    │ judul                      │
                    │ deskripsi                  │
                    │ penyelenggara              │
                    │ link_pendaftaran           │
                    │ bukti_penyelenggara       │
                    │ status_verifikasi          │
                    │ alasan_penolakan           │
                    │ reviewed_by                │
                    │ reviewed_at                │
                    └─────────────┬──────────────┘
                                  │
                         0..1     │     1
                                  │
                                  ▼
                         ┌──────────────────┐
                         │      LOMBA       │
                         │──────────────────│
                         │ PK id_lomba      │
                         │ FK id_kategori   │
                         │ FK id_pengajuan   │
                         │ judul            │
                         │ penyelenggara    │
                         │ deadline         │
                         │ link_pendaftaran │
                         │ status_publish   │
                         └────────┬─────────┘
                                  │
                               N  │  1
                                  │
                                  ▼
                         ┌──────────────────┐
                         │     KATEGORI     │
                         │──────────────────│
                         │ PK id_kategori   │
                         │ nama_kategori    │
                         └──────────────────┘


        ADMIN
          │
          │ review / filter
          ▼
   PENGAJUAN_LOMBA
          │
     ┌────┴─────┐
     ▼          ▼
 APPROVED    REJECTED / SPAM
     │
     ▼
    LOMBA
     │
     ▼
  PUBLISHED
     │
     ▼
 MAHASISWA
```

Dalam sketsa tersebut, **Admin tidak harus menjadi tabel tersendiri**, tetapi Admin direpresentasikan sebagai salah satu `role` pada entitas Pengguna. Atribut `reviewed_by`, `reviewed_at`, dan `status_verifikasi` pada Pengajuan Lomba digunakan untuk mencatat proses verifikasi dan keputusan Admin.

---

## 6.2 Rancangan Antarmuka Awal

Selain halaman mahasiswa, rancangan antarmuka harus menunjukkan secara jelas halaman yang digunakan Admin untuk melakukan penyaringan dan menentukan informasi lomba yang dapat dipublikasikan.

### 6.2.1 Dashboard Mahasiswa

```text
┌─────────────────────────────────────────────────────────────┐
│ CompHub     Beranda   Lomba   Bookmark   Profil             │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│ Cari Lomba                                                  │
│ [.................................................] [Cari]  │
│                                                             │
│ Filter Kategori                                             │
│ [Semua] [Teknologi] [Bisnis] [Desain] [Lainnya]             │
│                                                             │
│ ┌─────────────────────────────────────────────────────────┐ │
│ │ National Coding Competition                             │ │
│ │ Teknologi | Deadline: 30 Oktober 2026                   │ │
│ │                                         [Lihat Detail]  │ │
│ └─────────────────────────────────────────────────────────┘ │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

Halaman ini digunakan mahasiswa untuk mencari dan menyaring lomba berdasarkan kategori dan minat.

---

### 6.2.2 Halaman Detail Lomba

```text
┌─────────────────────────────────────────────────────────────┐
│ ← Kembali                                                   │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│ NATIONAL CODING COMPETITION                         ☆      │
│                                                             │
│ ✓ Telah diverifikasi Admin                                 │
│                                                             │
│ Penyelenggara : ABC Technology                              │
│ Kategori      : Teknologi                                   │
│ Deadline      : 25 September 2026                          │
│ Hadiah        : Rp10.000.000                                │
│                                                             │
│ Deskripsi                                                  │
│ ..........................................................  │
│                                                             │
│ Persyaratan                                               │
│ ..........................................................  │
│                                                             │

│                                                             │
└─────────────────────────────────────────────────────────────┘
```

Label **“Telah diverifikasi Admin”** menunjukkan bahwa data yang tampil kepada mahasiswa sudah melewati proses penyaringan.

---

### 6.2.3 Dashboard Admin – Pengajuan Lomba

Halaman ini merupakan bagian utama untuk menjalankan fungsi Admin sebagai **filter dan penentu publikasi lomba**.

```text
┌─────────────────────────────────────────────────────────────┐
│ CompHub Admin   Dashboard   Pengajuan   Lomba   Pengguna    │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│ PENGAJUAN LOMBA                                             │
│                                                             │
│ Filter: [PENDING ▼] [Semua Kategori ▼]                      │
│                                                             │
│ ┌─────────────────────────────────────────────────────────┐ │
│ │ National Coding Competition                             │ │
│ │ Penyedia   : ABC Technology                             │ │
│ │ Kategori   : Teknologi                                  │ │
│ │ Status     : PENDING                                    │ │
│ │                                                         │ │
│ │ [Review] [Terima & Publish] [Tolak] [Tandai Spam]       │ │
│ └─────────────────────────────────────────────────────────┘ │
│                                                             │
│ ┌─────────────────────────────────────────────────────────┐ │
│ │ UI/UX Design Competition                                │ │
│ │ Penyedia   : XYZ Indonesia                              │ │
│ │ Status     : PENDING                                    │ │
│ │                                                         │ │
│ │ [Review] [Terima & Publish] [Tolak] [Tandai Spam]       │ │
│ └─────────────────────────────────────────────────────────┘ │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

Pada halaman ini Admin dapat:

* memeriksa pengajuan yang masuk;
* memfilter pengajuan berdasarkan status atau kategori;
* memeriksa informasi penyelenggara;
* memeriksa link pendaftaran;
* mendeteksi data yang duplikat;
* menolak pengajuan yang tidak memenuhi kriteria;
* menandai pengajuan sebagai spam; dan
* **menyetujui pengajuan sehingga informasi lomba dapat dipublikasikan.**

---

### 6.2.4 Halaman Review Pengajuan Admin

Setelah menekan **Review**, Admin melihat informasi lengkap sebelum mengambil keputusan.

```text
┌─────────────────────────────────────────────────────────────┐
│ REVIEW PENGAJUAN LOMBA                                      │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│ Nama Lomba       : National Coding Competition              │
│ Penyelenggara    : ABC Technology                           │
│ Kategori         : Teknologi                                │
│ Deadline         : 25 September 2026                        │
│ Link Pendaftaran : https://...............................  │
│ Website Resmi    : https://...............................  │
│                                                             │
│ Bukti Penyelenggara                                         │
│ [ Lihat Bukti ]                                             │
│                                                             │
│ Hasil Pemeriksaan                                           │
│ [✓] Informasi lengkap                                       │
│ [✓] Link tersedia                                           │
│ [✓] Tidak ditemukan duplikasi                               │
│ [✓] Penyelenggara dapat diverifikasi                        │
│                                                             │
│ Catatan Admin                                               │
│ [.........................................................] │
│                                                             │
│       [ TOLAK ]    [ TANDAI SPAM ]    [ APPROVE & PUBLISH ] │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### Alur keputusan Admin

```text
           PENGAJUAN DARI PENYEDIA
                    │
                    ▼
             STATUS: PENDING
                    │
                    ▼
             ┌──────────────┐
             │ ADMIN REVIEW │
             └──────┬───────┘
                    │
        ┌───────────┼───────────┐
        │           │           │
        ▼           ▼           ▼
    APPROVE       REJECT       SPAM
        │
        ▼
   CREATE/PUBLISH
      LOMBA
        │
        ▼
  TAMPIL DI WEBSITE
        │
        ▼
     MAHASISWA
```

Dengan demikian, **Admin menjadi titik kontrol utama antara penyedia informasi dan mahasiswa**. Penyedia hanya dapat mengajukan informasi, sedangkan keputusan akhir mengenai apakah suatu lomba layak ditampilkan berada pada Admin.

Rancangan ini juga memperjelas fungsi pengelolaan yang sebelumnya belum terlihat pada Bagian 5.3. Karena template proposal meminta fitur pada Bagian 5.3 dapat ditelusuri ke entitas pada 6.1, maka fitur **“Pengajuan Lomba”** dan **“Verifikasi/Publikasi oleh Admin”** sebaiknya juga dicantumkan pada Bagian 5.3 agar konsisten dengan rancangan teknis.
