# Fraglogue - Luxury Olfactory Scent Archive

Fraglogue adalah aplikasi berbasis web dinamis bertema Bright Luxury / High-End French Boutique yang dirancang untuk mengarsipkan, mengelola, dan mengeksplorasi mahakarya parfum global. Proyek ini dikembangkan menggunakan PHP Native dan Database MySQL guna memenuhi tugas besar praktikum implementasi basis data dunia nyata.

Aplikasi ini mengimplementasikan konsep keamanan otentikasi berbasis peran (Role-Based Access Control), pencarian data multidimensi, sistem transaksi belanja (shopping cart workflow), agregasi statistik, serta algoritma rekomendasi produk berbasis kesamaan struktur aroma notes.

---

## Fitur Utama Aplikasi

### 1. Autentikasi dan Kontrol Akses (RBAC)
- **Moderator/Presentation Mode:** Halaman registrasi adaptif yang memungkinkan penguji memilih privilege akun secara instan (Admin atau Standard User).
- **Session Protection:** Enkripsi password menggunakan algoritma mutakhir `password_hash()` (BCRYPT) untuk menjamin privasi kredensial pengguna.

### 2. Manajemen Data dan Pencarian (CRUD dan Filter)
- **Full CRUD Engine:** Hak eksklusif bagi Admin untuk melakukan operasi Create, Read, Update, dan Delete data spesifikasi parfum langsung dari dashboard.
- **Multidimensional Filtering:** Penyaringan produk berlapis yang menggabungkan pencarian klausa teks (Brand, Nama, Notes) dengan filter klasifikasi kategori produk.

### 3. Olfactory Insights dan Community Metrics
- **Sensory Feedback:** Pengguna dapat mendokumentasikan ulasan (Connoisseur Reviews) disertai dengan pemberian skala bintang ulasan.
- **Community Analytics Bar:** Visualisasi data interaktif Longevity (ketahanan) dan Sillage (jejak aroma) menggunakan komponen Glassmorphism Progress Bar yang responsif.
- **Smart Recommendation Engine:** PHP akan memecah (string explosion) komponen aroma utama parfum yang sedang dibuka untuk memunculkan 3 rekomendasi parfum lain dengan karakteristik sejenis.

### 4. E-Commerce Shopping Workflow
- **Dinamis Cart (Keranjang):** Fitur penambahan item otomatis dengan kalkulasi subtotal real-time serta pencegahan duplikasi data melalui kueri `ON DUPLICATE KEY UPDATE`.
- **Secure Checkout Process:** Simulasi transaksi database yang memindahkan data keranjang ke dalam tabel pesanan historis secara runtut, lalu mengosongkan kembali keranjang belanja secara otomatis.

### 5. Executive Dashboard (Admin Only)
- **SQL Data Aggregation:** Memamerkan penggunaan fungsi agregat SQL (`COUNT` dan `AVG`) untuk menampilkan total parfum, akun terdaftar, ulasan tertulis, hingga rata-rata nilai retail produk di pasar.
- **User Credential Audit Table:** Tabel log transparan untuk memonitor seluruh ID, nama, tingkat hak akses, dan waktu pembuatan akun pengguna di dalam sistem.

---

## Arsitektur Relasi Database

Database `db_fraglogue` dirancang secara normalisasi dengan menggunakan **5 Tabel Utama** dan **3 Tabel Transaksi** yang saling terikat oleh konstrain Foreign Key (`ON DELETE CASCADE / SET NULL`):

| Tabel | Deskripsi |
|---|---|
| `users` | Menyimpan data kredensial akun, password terenkripsi, dan tingkat role. |
| `categories` | Klasifikasi rumpun aroma parfum (seperti Warm & Sweet, Woody, Citrus). |
| `perfumes` | Menyimpan data spesifikasi produk, harga, notes, dan tautan visual gambar. |
| `favorites` | Junction table penampung relasi parfum favorit pilihan user. |
| `reviews` | Menampung catatan evaluasi ulasan, komentar, dan skor rating pengguna. |
| `cart` | Menyimpan antrean item belanja milik user yang belum di-checkout. |
| `orders` | Nota induk pembungkusan total pengeluaran dan waktu transaksi belanja. |
| `order_items` | Rincian detail kuantitas dan harga kloning produk saat masa pembelian. |

---

## Struktur Direktori Proyek

```text
xampp/
└── htdocs/
    └── fraglogue/
        ├── assets/
        │   └── css/
        │       └── style.css
        ├── koneksi.php
        ├── login.php
        ├── logout.php
        ├── register.php
        ├── index.php
        ├── detail.php
        ├── favorit.php
        ├── tambah.php
        ├── edit.php
        ├── hapus.php
        ├── keranjang.php
        ├── pesanan.php
        ├── dashboard_admin.php
        └── README.md
```

---

## Langkah-Langkah Instalasi dan Setup

### 1. Kloning Direktori Project

Pindahkan atau salin seluruh berkas program ke dalam direktori server lokal XAMPP pada lokasi berikut:

```text
C:\xampp\htdocs\fraglogue\
```

### 2. Import Struktur Database

1. Jalankan control panel XAMPP, kemudian aktifkan modul **Apache** dan **MySQL**.
2. Buka web browser dan akses halaman panel kontrol database pada alamat:
   ```
   http://localhost/phpmyadmin/
   ```
3. Buat database baru dengan nama `db_fraglogue`.
4. Klik tab **SQL**, kemudian buka berkas rancangan database yang berisi kueri DDL dan DML, salin seluruh instruksi tersebut, lalu klik tombol **Go** atau **Kirim**.

### 3. Konfigurasi Koneksi PHP

Buka berkas `koneksi.php` menggunakan teks editor dan pastikan konfigurasi autentikasi basis data lokal sudah sesuai dengan pengaturan berikut:

```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_fraglogue";
```

### 4. Eksekusi Aplikasi

Buka web browser, lalu akses halaman utama autentikasi aplikasi melalui tautan URL berikut:

```text
http://localhost/fraglogue/login.php
```

## Screenshot
### XAMPP Integration
<img width="1919" height="924" alt="image" src="https://github.com/user-attachments/assets/5943b8cf-bb39-4165-a569-9512d2eae1c3" />

### Login
<img width="1913" height="1078" alt="image" src="https://github.com/user-attachments/assets/73df2af3-d775-4a34-adb1-fc833d455210" />

### Register
<img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/656e8044-517e-4205-aaff-59942337c2f4" />

### "My Favorites"
<img width="1919" height="1079" alt="Screenshot 2026-05-23 011848" src="https://github.com/user-attachments/assets/d8b71bfc-cb18-4505-be51-22ca94523414" />

### Admin/User - Detail
<img width="1920" height="2187" alt="screencapture-localhost-fraglogue-detail-php-2026-05-23-01_24_32" src="https://github.com/user-attachments/assets/8826becf-58a8-4183-998a-35c917f81125" />

### Checkout
<img width="1913" height="1079" alt="image" src="https://github.com/user-attachments/assets/2e1108e0-bbf3-4baf-9464-f06efe756b73" />

### Purchase History
<img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/2aa36c94-8eda-442a-918d-05d1e89a3e47" />

### Admin - Archive
<img width="1918" height="1079" alt="image" src="https://github.com/user-attachments/assets/ac9ae62c-fe2f-4e7a-9025-3e3f24709bd1" />

### Admin - CRUD
<img width="1919" height="1073" alt="image" src="https://github.com/user-attachments/assets/d988db01-3aa0-4067-a45a-f5aa2e797389" />

### Admin - Dashboard
<img width="1917" height="1079" alt="image" src="https://github.com/user-attachments/assets/50d08346-3723-45a3-a1d9-85a21b80952e" />

### User - Archive
<img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/970ef294-2462-41a7-85b6-ee1794e56a14" />
