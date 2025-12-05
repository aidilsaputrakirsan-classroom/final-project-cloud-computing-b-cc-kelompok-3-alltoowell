# SI KOST – Sistem Informasi Kost

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=flat&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-3.5-4E56A6?style=flat&logo=livewire&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg)

Sistem Informasi Kost (SI Kost) adalah aplikasi web berbasis Laravel yang digunakan untuk mengelola proses pemesanan dan pengelolaan kamar kost. Aplikasi ini menyediakan fitur untuk pendaftaran pengguna, pemesanan kost, pengecekan status, hingga manajemen data kamar oleh admin. Sistem ini dirancang untuk memberikan pengalaman pemesanan kost yang mudah, cepat, transparan, dan terstruktur.

---

## Daftar Isi

- [SI KOST – Sistem Informasi Kost](#si-kost--sistem-informasi-kost)
  - [Daftar Isi](#daftar-isi)
  - [Fitur Utama](#fitur-utama)
    - [Manajemen Kamar Kost](#manajemen-kamar-kost)
    - [Manajemen Admin](#manajemen-admin)
    - [Fitur Sistem](#fitur-sistem)
  - [Tech Stack](#tech-stack)
    - [Backend](#backend)
    - [Frontend](#frontend)
    - [Libraries](#libraries)
  - [Persyaratan Sistem](#persyaratan-sistem)
    - [Ekstensi PHP](#ekstensi-php)
  - [Instalasi](#instalasi)
    - [1. Clone Repository](#1-clone-repository)
    - [2. Install Dependencies](#2-install-dependencies)
    - [3. Setup Environment](#3-setup-environment)
    - [4. Konfigurasi Database](#4-konfigurasi-database)
    - [5. Migrasi Database](#5-migrasi-database)
    - [6. Setup Storage](#6-setup-storage)
    - [7. Build Asset](#7-build-asset)
    - [8. Jalankan Aplikasi](#8-jalankan-aplikasi)
  - [Konfigurasi](#konfigurasi)
    - [Email Configuration](#email-configuration)
    - [File Storage (Opsional)](#file-storage-opsional)
  - [Role \& Permissions](#role--permissions)
  - [Fitur Berdasarkan Role](#fitur-berdasarkan-role)
    - [User](#user)
    - [Admin](#admin)
  - [Generate PDF](#generate-pdf)
  - [Import Data](#import-data)
  - [Screenshot](#screenshot)
    - [**1. Halaman Beranda (Hero Section)**](#1-halaman-beranda-hero-section)
    - [**2. Fitur Booking**](#2-fitur-booking)
    - [**3. Testimonial**](#3-testimonial)
    - [**4. Tentang KOST-SI**](#4-tentang-kost-si)
    - [**5. Halaman Kontak**](#5-halaman-kontak)
    - [**6. Halaman Register**](#6-halaman-register)
    - [**7. Halaman Login**](#7-halaman-login)
    - [**8. Daftar Kamar Kos**](#8-daftar-kamar-kos)
    - [**9. Detail Kamar**](#9-detail-kamar)
    - [**10. Booking Kamar**](#10-booking-kamar)
    - [**11. Halaman Beranda (User Login)**](#11-halaman-beranda-user-login)
    - [**12. Halaman Pesanan Saya**](#12-halaman-pesanan-saya)
    - [**13. Dashboard Admin**](#13-dashboard-admin)
    - [**14. Dashboard Admin – Booking Terbaru**](#14-dashboard-admin--booking-terbaru)
    - [**15. Kelola Pemesanan**](#15-kelola-pemesanan)
    - [**16. Kelola Kamar**](#16-kelola-kamar)
    - [**17. Tambah Kamar – Form Bagian 1**](#17-tambah-kamar--form-bagian-1)
    - [**18. Tambah Kamar – Form Bagian 2**](#18-tambah-kamar--form-bagian-2)
    - [**19. Activity Log**](#19-activity-log)
    - [**20. Detail Aktivitas**](#20-detail-aktivitas)
  - [Struktur Database](#struktur-database)
    - [Tabel Utama](#tabel-utama)
    - [Relasi](#relasi)
  - [Penggunaan](#penggunaan)
  - [Deployment](#deployment)
  - [Kontribusi](#kontribusi)
  - [Lisensi](#lisensi)

---

## Fitur Utama

### Manajemen Kamar Kost  
- ✅ **List Kamar Kost** – Pengguna dapat melihat daftar kamar kost lengkap dengan detail dan statusnya  
- ✅ **Detail Kamar** – Informasi lengkap kamar (foto, fasilitas, harga, lokasi, status)  
- ✅ **Pemesanan Kamar (Booking)** – Pengguna dapat melakukan booking langsung dari website  
- ✅ **Status Pemesanan** – Pengguna dapat melihat apakah pemesanan mereka *pending*, *diterima*, atau *ditolak*  

### Manajemen Admin  
- ✅ **CRUD Kamar Kost** – Admin dapat menambah, memperbarui, dan menghapus kamar  
- ✅ **Upload Foto Kamar** – Admin dapat mengelola gambar kamar  
- ✅ **Dashboard Admin** – Menampilkan statistik kamar dan pemesanan  
- ✅ **Validasi Pemesanan** – Admin dapat menerima atau menolak booking pengguna  
- ✅ **Activity Log** – Melacak aktivitas pengguna dan admin dalam sistem  

### Fitur Sistem  
- ✅ **Authentication** – Login & registrasi untuk user dan admin  
- ❌ **Generate PDF** – *Belum tersedia, direncanakan pada versi berikutnya*  
- ❌ **Import Data Excel** – *Belum tersedia, rencana pengembangan ke depan*  

---

## Tech Stack

### Backend  
- Laravel 12.0  
- Livewire 3.5  
- Spatie Laravel Permission 6.7  
- MySQL  

### Frontend  
- Bootstrap 5  
- Sass  
- Material Design Icons  
- Font Awesome  
- jQuery  
- Alpine.js  

### Libraries  
- Barryvdh DomPDF 3.0 *(belum digunakan)*  
- Maatwebsite Excel 3.1 *(belum digunakan)*  
- Laravel Mix 6  
- Laravel Sanctum  
- Guzzle HTTP  
- Spatie Ignition  
- PHPUnit 11  

---

## Persyaratan Sistem

- PHP ≥ 8.2  
- MySQL ≥ 5.7  
- Composer  
- Node.js & NPM  
- Apache/Nginx  

### Ekstensi PHP  
- OpenSSL  
- PDO  
- Mbstring  
- Tokenizer  
- XML  
- JSON  
- BCMath  
- GD / Imagick  

---

## Instalasi

### 1. Clone Repository  
```bash
git clone https://github.com/yourusername/si-kost.git
cd si-kost
```

### 2. Install Dependencies  
```bash
composer install
npm install
```

### 3. Setup Environment  
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database  
```env
DB_DATABASE=si_kost
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi Database  
```bash
php artisan migrate --seed
```

### 6. Setup Storage  
```bash
php artisan storage:link
```

### 7. Build Asset  
```bash
npm run dev
```

### 8. Jalankan Aplikasi  
```bash
php artisan serve
```

---

## Konfigurasi

### Email Configuration  
```env
MAIL_MAILER=log
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### File Storage (Opsional)  
```env
AWS_ACCESS_KEY_ID=your-access-key
AWS_SECRET_ACCESS_KEY=your-secret-key
AWS_BUCKET=your-bucket
```

---

## Role & Permissions

| Role | Deskripsi |
|------|-----------|
| **User** | Melakukan pemesanan kamar kost |
| **Admin** | Mengelola data kamar & booking |

---

## Fitur Berdasarkan Role

### User  
- 📝 Registrasi & Login  
- 🏠 Home setelah login  
- 🏘 Melihat daftar kamar kost  
- 🔍 Melihat detail kamar  
- 🛏 Melakukan booking kamar  
- 📋 Melihat status pemesanan  

### Admin  
- 🔑 Login Admin  
- 📊 Dashboard Admin  
- ➕ Tambah kamar baru  
- ✏ Edit kamar  
- ❌ Hapus kamar  
- 🖼 Upload foto kamar  
- 🔄 Ubah status kamar (Available / Booked)  
- 📄 Memproses booking pengguna  
- 📜 Activity log  

---

## Generate PDF  
Fitur pembuatan PDF **belum tersedia** dalam aplikasi SI Kost.  

---

## Import Data  
Fitur import data Excel **belum tersedia**.  

---

## Screenshot  

### **1. Halaman Beranda (Hero Section)**

![Halaman Beranda](public/readme/1.png)
Halaman ini merupakan tampilan utama ketika pengguna pertama kali mengakses website KOST-SI. Bagian hero didesain untuk memberikan kesan profesional dan informatif melalui slogan besar yang menjelaskan fungsi utama platform. Pengguna langsung disuguhkan tombol *Call to Action* untuk melihat daftar kamar, serta rangkuman statistik seperti jumlah kamar tersedia, total pengguna mahasiswa, rating platform, dan layanan pendukung lainnya. Tujuan halaman ini adalah memastikan pengguna memahami manfaat platform sejak pertama kali berkunjung.

---

### **2. Fitur Booking**

![Fitur Booking](public/readme/2.png)
Halaman ini menjelaskan fitur unggulan KOST-SI yang menjadi alasan utama platform ini dibuat untuk mahasiswa ITK. Tiga fitur inti yang ditampilkan meliputi kemudahan proses booking melalui antarmuka yang sederhana, keamanan data pengguna yang dijaga ketat, serta harga transparan tanpa biaya tersembunyi. Bagian ini dirancang untuk memberikan pemahaman menyeluruh tentang keunggulan aplikasi dan menumbuhkan rasa percaya calon pengguna sebelum mereka melanjutkan ke proses berikutnya.

---

### **3. Testimonial**

![Testimonial](public/readme/3.png)
Bagian testimonial menampilkan pengalaman nyata mahasiswa ITK yang telah menggunakan layanan KOST-SI. Setiap testimonial memuat nama mahasiswa, asal jurusan, komentar mengenai kualitas platform, serta rating yang diberikan. Struktur slider memudahkan pengguna melihat beberapa ulasan secara teratur tanpa memenuhi seluruh halaman. Tujuannya adalah memperkuat citra positif platform dan memberikan bukti sosial bahwa aplikasi ini memang membantu mahasiswa menemukan kamar kos dengan lebih mudah.

---

### **4. Tentang KOST-SI**

![Tentang KOST-SI](public/readme/4.png)
Halaman ini menjelaskan latar belakang dan motivasi dibuatnya platform KOST-SI sebagai solusi digital untuk pencarian kamar kos khusus mahasiswa ITK. Pada bagian ini, pengguna dapat membaca penjelasan singkat mengenai misi platform, kemudahan yang ditawarkan, serta manfaat yang dapat diperoleh mahasiswa. Dilengkapi dengan slider foto kamar berkualitas untuk memberikan gambaran visual nyata mengenai jenis kamar yang dapat ditemukan melalui platform.

---

### **5. Halaman Kontak**

![Kontak](public/readme/5.png)
Halaman kontak memberikan informasi kepada pengguna mengenai cara menghubungi tim admin atau pengelola platform. Informasi yang ditampilkan terdiri dari nomor telepon, alamat email, serta lokasi kampus ITK Balikpapan sebagai pusat layanan akademik dan perumahan mahasiswa. Bagian ini berfungsi memastikan pengguna dapat memperoleh bantuan ketika menghadapi kendala atau membutuhkan informasi tambahan terkait pemesanan kamar atau penggunaan platform.

---

### **6. Halaman Register**

![Register](public/readme/6.png)
Form registrasi pengguna baru ditampilkan dengan desain sederhana dan modern untuk memastikan pengalaman pendaftaran yang nyaman dan mudah dipahami. Pengguna diminta mengisi data penting seperti nama lengkap, email aktif, nomor telepon, password, dan konfirmasi password. Layout halaman dibuat dua kolom agar proses pengisian terasa lebih profesional dan efisien. Halaman ini menjadi pintu awal bagi pengguna untuk dapat mengakses seluruh fitur yang tersedia dalam platform.

---

### **7. Halaman Login**

![Login](public/readme/7.png)
Halaman login merupakan titik autentikasi bagi pengguna yang ingin mengakses akunnya. Pada halaman ini pengguna memasukkan email dan password yang telah terdaftar. Desainnya dibuat minimalis agar pengguna dapat fokus pada proses login. Terdapat pula tautan menuju halaman pendaftaran bagi pengguna baru yang belum memiliki akun.

---

### **8. Daftar Kamar Kos**

![Daftar Kamar](public/readme/8.png)
Halaman ini menampilkan seluruh kamar kos yang tersedia maupun yang telah terisi. Pengguna dapat melakukan pencarian kamar berdasarkan filter seperti harga dan status ketersediaan. Setiap kartu kamar berisi foto kamar, alamat, harga, status tersedia atau tidak, serta tombol untuk melihat detail kamar lebih lanjut. Tujuan halaman ini adalah mempermudah pengguna menelusuri pilihan kamar secara cepat dan efisien.

---

### **9. Detail Kamar**

![Detail Kamar](public/readme/9.png)
Halaman detail kamar menampilkan informasi lengkap mengenai sebuah kamar kos, termasuk foto besar kamar, nama kamar, harga per bulan, fasilitas, lokasi, dan peta area sekitar. Bagian ini menawarkan gambaran menyeluruh kepada pengguna sebelum melakukan pemesanan, serta menyediakan tombol *Pesan Sekarang* jika pengguna tertarik untuk melanjutkan ke proses booking. Detail yang lengkap sangat membantu pengguna membuat keputusan dengan lebih yakin.

---

### **10. Booking Kamar**

![Booking Kamar](public/readme/10.png)
Halaman ini menyediakan form lengkap bagi pengguna untuk melakukan pemesanan kamar. Pengguna diminta mengisi data seperti nama, kontak, tanggal mulai sewa, durasi sewa, dan metode pembayaran. Di sisi kanan halaman terdapat ringkasan pemesanan yang mencakup total biaya, informasi verifikasi admin, serta syarat dan ketentuan pemesanan. Halaman ini dirancang untuk memastikan seluruh informasi pemesanan disampaikan dengan jelas sebelum pengguna melakukan konfirmasi akhir.

---

### **11. Halaman Beranda (User Login)**

![Beranda Login](public/readme/11.png)
Setelah pengguna berhasil login, tampilan beranda berubah menyesuaikan status pengguna. Navigasi bar kini menampilkan menu khusus seperti *Pesanan Saya* dan tombol logout, menandakan bahwa pengguna telah terautentikasi. Meskipun tampilannya mirip dengan halaman beranda utama, bagian ini telah menyesuaikan kebutuhan pengguna terdaftar agar mereka dapat mengakses fitur dengan lebih cepat dan personal.

---

### **12. Halaman Pesanan Saya**

![Pesanan Saya](public/readme/12.png)
Halaman ini berfungsi sebagai pusat informasi bagi pengguna untuk memantau seluruh pemesanan yang pernah dilakukan. Setiap kartu pesanan menampilkan detail seperti nama kamar, tanggal mulai sewa, durasi, total pembayaran, serta status pemesanan. Status ini dapat berupa *Pending*, *Confirmed*, atau *Rejected*. Halaman ini memberikan kejelasan kepada pengguna mengenai perkembangan setiap pemesanan mereka.

---

### **13. Dashboard Admin**

![Dashboard Admin](public/readme/13.png)
Dashboard admin memberikan ringkasan komprehensif mengenai performa platform. Admin dapat melihat data seperti total pemesanan bulan ini, total pendapatan, pemesanan yang menunggu konfirmasi, jumlah kamar tersedia, serta grafik pemesanan dan pendapatan bulanan. Halaman ini dirancang agar admin dapat memonitor data secara real time dan mengambil keputusan operasional dengan lebih efektif.

---

### **14. Dashboard Admin – Booking Terbaru**

![Booking Terbaru](public/readme/14.png)
Bagian ini menampilkan daftar pemesanan terbaru yang masuk ke sistem. Setiap baris pemesanan menunjukkan nama pengguna, nama kamar, tanggal pemesanan, total pembayaran, dan status pemesanan. Tampilan ini membantu admin memahami aktivitas terbaru pengguna tanpa harus membuka halaman pemesanan secara penuh.

---

### **15. Kelola Pemesanan**

![Kelola Pemesanan](public/readme/15.png)
Pada halaman ini admin dapat mengelola seluruh pemesanan pengguna secara terpusat. Data ditampilkan dalam bentuk tabel yang memuat detail penyewa, kamar, total harga, serta status pemesanan. Admin memiliki kontrol penuh untuk menerima atau menolak pemesanan secara langsung. Halaman ini merupakan inti dari pengelolaan operasional pemesanan platform.

---

### **16. Kelola Kamar**

![Kelola Kamar](public/readme/16.png)
Halaman ini menampilkan seluruh kamar yang terdaftar dalam sistem beserta informasi seperti foto kamar, nama, harga, kapasitas, dan status ketersediaan. Admin dapat melakukan aksi seperti mengedit atau menghapus kamar jika diperlukan. Bagian ini merupakan pusat manajemen data kamar kos yang ada di platform.

---

### **17. Tambah Kamar – Form Bagian 1**

![Tambah Kamar 1](public/readme/17.png)
Form bagian pertama ini digunakan admin untuk menambahkan kamar kos baru ke dalam sistem. Data yang harus diisi meliputi nama kamar, harga, kapasitas, status tersedia atau tidak, serta fasilitas lengkap. Struktur form dibuat rapi agar admin dapat memasukkan data dengan akurat tanpa risiko kesalahan.

---

### **18. Tambah Kamar – Form Bagian 2**

![Tambah Kamar 2](public/readme/18.png)
Pada bagian kedua form, admin dapat mengunggah gambar kamar serta melihat preview sebelum gambar disimpan. Selain itu, terdapat input tambahan seperti deskripsi kamar atau lokasi. Halaman ini memastikan bahwa kamar yang ditambahkan memiliki informasi lengkap baik secara visual maupun teks.

---

### **19. Activity Log**

![Activity Log](public/readme/19.png)
Activity Log berfungsi untuk mencatat seluruh aktivitas penting yang dilakukan oleh pengguna maupun admin, seperti login, logout, penambahan data, atau perubahan status pemesanan. Setiap aktivitas dicatat lengkap dengan user ID, waktu kejadian, dan deskripsi tindakan. Fitur ini penting untuk keperluan audit dan keamanan sistem.

---

### **20. Detail Aktivitas**

![Detail Aktivitas](public/readme/20.png)
Halaman ini memberikan penjelasan detail terhadap satu aktivitas tertentu dari Activity Log. Informasi yang ditampilkan meliputi nama pengguna, aksi yang dilakukan, waktu aktivitas, serta deskripsi lengkap tindakan tersebut. Halaman ini memudahkan admin melacak dan memahami setiap aktivitas dengan lebih akurat.

---

## Struktur Database

### Tabel Utama  
- users  
- rooms  
- bookings  
- activity_logs  

### Relasi  
```
users (1) ─── (n) bookings  
rooms (1) ─── (n) bookings  
users (1) ─── (n) activity_logs  
```

---

## Penggunaan

1. User melakukan registrasi  
2. User login  
3. User memilih kamar kost  
4. User melakukan booking  
5. Admin memverifikasi booking  
6. User memantau status pemesanan  
7. Admin mengelola kamar & aktivitas  

---

## Deployment

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

---

## Kontribusi  
1. Fork repository  
2. Buat branch fitur  
3. Commit perubahan  
4. Push ke branch  
5. Pull Request  

---

## Lisensi  
Project ini menggunakan **MIT License**.
