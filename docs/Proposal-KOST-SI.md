# FINAL PROJECT CLOUD COMPUTING
## Progress I → Branch [Fitur x]

### Identitas
- Kelompok : 3 (AllToWell)
- Kelas    : B  
- Nama     : 
  - Tri Wahyuni (10221032) 
  - Elifas Lolo Padang (10221024)
  - Faradila Zakiah Nur Hafitsa (120221066)
  - Nadya Alivia Raaph (10221086)


--- 
# ✅ DELIVERABLES

Document Proposal (PDF/Markdown) berisi:

## Deskripsi aplikasi

Aplikasi web berbasis Laravel yang dirancang untuk mempermudah proses reservasi dan pemesanan kamar kos secara online bagi mahasiswa. Sistem ini menyediakan platform digital yang memungkinkan pengguna untuk melihat daftar kamar kos, melihat detail fasilitas, serta melakukan pemesanan dengan cepat tanpa perlu datang langsung ke lokasi.
Aplikasi ini memiliki dua jenis peran pengguna, yaitu Admin memiliki hak akses untuk mengelola seluruh data kamar kos, mengonfirmasi pemesanan, serta memantau aktivitas pengguna melalui dashboard. Admin juga dapat memperbarui status pemesanan menjadi Pending, Diterima, atau Ditolak. Dan User (mahasiswa) dapat melakukan registrasi dan login ke sistem untuk melihat daftar kamar, membaca detail kamar, mengisi form pemesanan, serta memantau status pemesanan mereka. Dengan fitur-fitur yang sederhana namun fungsional, KOST-SI diharapkan dapat membantu mahasiswa terutama mahasiswa baru dan aktif di sekitar Institut Teknologi Kalimantan (ITK) untuk menemukan dan memesan kamar kos dengan cara yang lebih mudah, cepat, dan transparan. Sistem ini juga membantu pemilik kos (melalui admin) dalam mengelola data kamar serta memantau pemesanan secara efisien melalui antarmuka berbasis web.

---

## Target user
Adapun target sistem yang akan dibangun yaitu : 
### 1. Mahasiswa aktif
  
  Mahasiswa aktif adalah pengguna yang sudah berkuliah dan sedang menempuh studi di ITK, yaitu:
  - Mungkin ingin pindah kos karena alasan kenyamanan, biaya, atau lokasi yang lebih dekat ke kampus.
  - Membutuhkan akses cepat dan fleksibel untuk mencari informasi kamar kos tanpa harus survey langsung.
  - Dapat menggunakan aplikasi untuk melihat ketersediaan kamar, membandingkan harga dan fasilitas, serta melakukan pemesanan langsung secara online.
  - Dengan adanya fitur riwayat pemesanan, mereka bisa melacak status pemesanan dan histori kos sebelumnya dengan mudah.
  
### 2. Mahasiswa baru yang berdomisili luar balikpapan
  
  Mahasiswa baru (maba) yang berasal dari luar daerah merupakan kelompok utama yang paling diuntungkan dari sistem ini, yaitu:
  - Umumnya belum mengenal wilayah Balikpapan terutama daerah sekitar ITK, sehingga kesulitan mencari kos secara langsung.
  - Dapat memanfaatkan sistem untuk melihat daftar kos lengkap dengan foto, harga, dan fasilitas, bahkan sebelum tiba di Balikpapan.
  - Dengan fitur form pemesanan online, mereka bisa memesan kamar lebih awal untuk memastikan tempat tinggal tersedia sebelum masa perkuliahan dimulai.
  - Proses pemesanan dan konfirmasi yang dilakukan secara digital dan transparan membantu mereka menghindari penipuan atau kesalahan informasi dari pihak ketiga.

### 3. Masyarakat umum
  
  Selain mahasiswa, sistem ini juga relevan bagi masyarakat umum yang mencari tempat tinggal sementara di Balikpapan/daerah sekitar ITK seperti pekerja, pegawai proyek, atau perantau.
  - Mencari kos yang strategis dan sesuai kebutuhan jangka pendek/panjang.
  - Menginginkan proses pemesanan yang fleksibel dan cepat tanpa kontak langsung dengan pemilik kos.
  - Butuh informasi yang terpercaya dan diperbarui secara berkala mengenai ketersediaan kamar.

---

## Fitur-Fitur Utama (minimal 4 fitur)

### 1. CRUD Data Kamar Kos
Fitur ini memungkinkan pemilik kos atau admin untuk mengelola seluruh data kamar kost secara dinamis. Melalui fitur ini, pemilik dapat menambahkan kamar baru dengan informasi lengkap seperti nama kamar, harga sewa, fasilitas, kapasitas, dan foto pendukung. Selain itu, pemilik juga dapat melihat daftar kamar yang telah terdaftar, memperbarui informasi kamar jika ada perubahan (misalnya harga atau status ketersediaan), dan menghapus kamar jika sudah tidak tersedia. 

### 2. Tampilan Daftar Kamar
Fitur ini menampilkan daftar seluruh kamar kos yang tersedia dalam bentuk tampilan yang rapi dan mudah dipahami oleh pengguna. Setiap kamar ditampilkan dalam bentuk kartu atau daftar yang berisi foto, nama kamar, harga, fasilitas utama, serta status ketersediaan. Pengguna juga dapat melakukan pencarian dan penyaringan (filter) berdasarkan harga, fasilitas, atau lokasi sehingga proses menemukan kamar sesuai kebutuhan menjadi lebih cepat dan efisien. Tampilan daftar kamar ini berfungsi sebagai halaman utama bagi mahasiswa untuk melakukan eksplorasi kos yang cocok sebelum melanjutkan ke proses pemesanan.

### 3. Form Pemesanan Kamar
Fitur form pemesanan kamar digunakan oleh user untuk melakukan proses pemesanan kamar kos secara online. Setelah memilih kamar yang diinginkan, pengguna akan diarahkan ke halaman formulir yang berisi data diri, tanggal mulai sewa, lama kontrak, serta metode pembayaran. Pengguna juga dapat mengunggah bukti pembayaran jika diperlukan. Informasi yang dikirim melalui form ini akan tersimpan di sistem dan diteruskan ke pemilik kos untuk proses verifikasi. Dengan fitur ini, mahasiswa tidak perlu datang langsung ke lokasi untuk melakukan reservasi, sehingga proses menjadi lebih praktis dan cepat.

### 4. Status Pemesanan 
Fitur status pemesanan memungkinkan pengguna untuk melacak perkembangan pesanan kamar mereka secara real-time. Setiap pemesanan akan memiliki status tertentu, seperti pending (menunggu konfirmasi), confirmed (dikonfirmasi), rejected (ditolak), cancelled (dibatalkan), atau completed (selesai). Pengguna dapat melihat status ini melalui dashboard akun mereka dan mendapatkan notifikasi apabila ada perubahan status. Dengan adanya fitur ini, proses komunikasi antara pemilik kos dan penyewa menjadi lebih transparan, dan pengguna dapat merasa lebih aman serta terjamin dalam melakukan pemesanan kamar kos.

## User Flow Diagram

Admin Flow dan User Flow 
```mermaid
%%{init: {'theme':'base', 'themeVariables': { 'fontSize':'17px', 'lineColor':'#ffffff'}}}%%
flowchart LR
    subgraph USER[USER FLOW]
        direction TB
        A1([Mulai])
        A1 --> B1[Buka Website<br/>Lihat Daftar Kamar]
        B1 --> C1{Ingin Lihat<br/>Detail Kamar?}
        C1 -->|Tidak| B1
        C1 -->|Ya| D1[Halaman<br/>Login/Register]
        D1 --> E1[Login atau<br/>Daftar Akun]
        E1 --> F1[Lihat Detail Kamar<br/>Lengkap]
        F1 --> G1{Ingin Pesan<br/>Kamar?}
        G1 -->|Tidak| B1
        G1 -->|Ya| H1[Isi Form Pemesanan<br/>Nama, Tanggal,<br/>Durasi, Kontak]
        H1 --> I1[Submit Pemesanan<br/>Status: Pending]
        I1 --> J1[Lihat Status di<br/>Riwayat Pemesanan]
        J1 --> K1([Selesai])
    end

    subgraph ADMIN[ADMIN FLOW]
        direction TB
        A2([Mulai])
        A2 --> B2[Login ke<br/>Dashboard Admin]
        B2 --> C2{Menu<br/>Admin}
        C2 -->|Kelola Pemesanan| D2[Lihat Daftar<br/>Pemesanan Masuk]
        D2 --> E2{Keputusan<br/>Pemesanan?}
        E2 -->|Terima| F2[Update Status:<br/>Diterima]
        E2 -->|Tolak| G2[Update Status:<br/>Ditolak]
        F2 --> H2[Simpan ke Database]
        G2 --> H2
        C2 -->|Kelola Kamar| I2[Lihat Daftar Kamar]
        I2 --> J2{Aksi Kamar?}
        J2 -->|Tambah| K2[Tambah Data<br/>Kamar Baru]
        J2 -->|Edit| L2[Edit Data<br/>Kamar]
        J2 -->|Hapus| M2[Hapus Data<br/>Kamar]
        K2 --> H2
        L2 --> H2
        M2 --> H2
        H2 --> O2([Selesai])
    end

    classDef start fill:#4F46E5,stroke:#312E81,stroke-width:4px,color:#fff,font-weight:bold
    classDef finish fill:#10B981,stroke:#065F46,stroke-width:4px,color:#fff,font-weight:bold
    classDef process fill:#DBEAFE,stroke:#1E40AF,stroke-width:3px,color:#1E3A8A,font-weight:600
    classDef decision fill:#FEF3C7,stroke:#D97706,stroke-width:3px,color:#78350F,font-weight:600
    classDef action fill:#FB923C,stroke:#C2410C,stroke-width:3px,color:#fff,font-weight:600
    classDef success fill:#D1FAE5,stroke:#059669,stroke-width:3px,color:#065F46,font-weight:600
    classDef reject fill:#FEE2E2,stroke:#DC2626,stroke-width:3px,color:#991B1B,font-weight:600

    class A1,K1 start
    class B1,E1,F1,H1,I1,J1 process
    class C1,G1 decision
    class D1 action

    class A2,O2 start
    class B2,D2,I2,H2 process
    class C2,E2,J2 decision
    class F2 success
    class G2 reject
    class K2,L2,M2 action

    style USER fill:#1E293B,stroke:#3B82F6,stroke-width:4px,color:#fff
    style ADMIN fill:#1E293B,stroke:#F59E0B,stroke-width:4px,color:#fff
```

Penjelasan :
#### 1. Admin Flow (Alur Admin)

Admin Flow menggambarkan aktivitas yang dilakukan oleh pihak pengelola (admin) dalam sistem KOST-SI.

Admin berperan penting dalam memverifikasi pesanan pengguna serta mengelola data kamar kos yang tersedia.

Penjelasan Alur:

1. Mulai
   
   Admin mengakses sistem dengan membuka halaman dashboard admin.

2. Login ke Dashboard
   
   Admin melakukan login menggunakan akun yang memiliki hak akses untuk mengelola sistem.

3. Menu Admin
   
   Setelah berhasil login, admin memiliki dua menu utama:
   
   a. Kelola Pemesanan
   
   Admin dapat melihat daftar pemesanan baru yang masuk dari pengguna.
   Pada tahap ini, admin mengambil keputusan terhadap pemesanan, apakah diterima atau ditolak.
   - Jika diterima, maka status pesanan berubah menjadi “Diterima”.
   - Jika ditolak, maka status pesanan berubah menjadi “Ditolak”.
    
    Semua perubahan ini kemudian disimpan ke dalam database.

   b. Kelola Kamar
   
   Selain pemesanan, admin juga dapat mengelola data kamar kos, termasuk menambah, mengedit, atau menghapus data kamar sesuai kebutuhan.

4. Simpan ke Database
   
   Setiap perubahan baik pada data pemesanan maupun data kamar akan disimpan ke database sistem.

5. Selesai
   
   Setelah semua data tersimpan, proses kerja admin dianggap selesai.

#### 2. User Flow (Alur Pengguna)

User Flow menjelaskan alur aktivitas yang dilakukan oleh pengguna umum (penyewa kos) ketika menggunakan sistem KOST-SI (Sistem Pemesanan Kamar Kos Online).

Alur ini menunjukkan langkah-langkah mulai dari pengguna membuka website hingga proses pemesanan kamar selesai.

Penjelasan Alur:

1. Mulai
   
   Pengguna memulai dengan membuka website KOST-SI.

2. Melihat Daftar Kamar Kos
   
   Setelah masuk ke halaman utama, pengguna dapat melihat daftar kamar kos yang tersedia beserta informasi singkat seperti harga, lokasi, dan fasilitas utama.

3. Melihat Detail Kamar
   
   Pengguna memiliki opsi untuk melihat detail kamar secara lebih lengkap. Jika tidak ingin melihat, pengguna tetap berada di halaman daftar kamar. Jika iya, maka sistem akan mengarahkan pengguna ke halaman login atau registrasi.

4. Login atau Registrasi Akun
   
   Pengguna harus login terlebih dahulu. Jika belum memiliki akun, maka perlu melakukan pendaftaran untuk dapat melanjutkan ke tahap pemesanan.

5. Melihat Detail Kamar Lengkap
   
   Setelah login, pengguna bisa melihat informasi kamar secara rinci seperti fasilitas, foto, harga, dan deskripsi.

6. Melakukan Pemesanan Kamar
   
   Jika pengguna tertarik, maka dapat mengisi formulir pemesanan yang berisi nama, tanggal mulai sewa, durasi, serta kontak.

7. Submit Pemesanan
   
   Setelah formulir dikirim, sistem akan menyimpan data pemesanan tersebut dengan status awal “Pending” (menunggu verifikasi admin).

8. Melihat Status Pemesanan
   
   Pengguna dapat memantau status pesanan melalui halaman riwayat pemesanan.

9. Selesai
    
    Proses pemesanan dianggap selesai setelah data berhasil disimpan dan pengguna menunggu verifikasi dari pihak admin.

---
## Wireframe/Mockup (low-fidelity)

Minimal 4 Page utama 
Bisa menggunakan: Figma, Draw.io, atau sketsa manual (difoto) 

#### Gambar Mockup Login dan Register
Screenshot:
![deliverable-1](screenshots/login.jpeg)
![deliverable-1](screenshots/regis.jpeg)

#### Gambar Mockup Halaman Beranda
Screenshot:
![deliverable-1](screenshots/beranda.jpeg)

#### Gambar Mockup Halaman Daftar Kamar
Screenshot:
![deliverable-1](screenshots/daftarkamar.jpeg)

#### Gambar Mockup Halaman Detail Kamar
Screenshot:
![deliverable-1](screenshots/detailkamar.jpeg)

#### Gambar Mockup Halaman Form Pemesanan
Screenshot:
![deliverable-1](screenshots/formpemesanan.jpeg)

---

## Database Schema Design

### 1. Daftar Tabel yang Dibutuhkan

| No | Nama Tabel    | Deskripsi                                                      |
| -- | ------------- | -------------------------------------------------------------- |
| 1  | **users**     | Menyimpan data akun pengguna (admin dan user).                 |
| 2  | **kosts**     | Menyimpan data informasi kos yang dikelola oleh admin/pemilik. |
| 3  | **kamar**     | Menyimpan detail setiap kamar kos, termasuk harga dan status.  |
| 4  | **pemesanan** | Menyimpan data pemesanan kamar oleh pengguna.                  |

---

## **2. Relasi Antar Tabel**

* **users → pemesanan** : *1–N* → Satu pengguna dapat melakukan banyak pemesanan.
* **kosts → kamar** : *1–N* → Satu kos memiliki banyak kamar.
* **kamar → pemesanan** : *1–N* → Satu kamar bisa dipesan beberapa kali (di waktu berbeda).
* **users (admin) → kosts** : *1–N* → Satu admin/pemilik dapat memiliki beberapa kos.

---

## **3. Struktur dan Field Tabel**

### **Tabel: users**

| Field      | Tipe Data            | Keterangan             |
| ---------- | -------------------- | ---------------------- |
| id         | int (PK)             | ID unik pengguna       |
| name       | string               | Nama pengguna          |
| email      | string               | Email unik             |
| password   | string               | Kata sandi terenkripsi |
| role       | enum('admin','user') | Peran pengguna         |
| created_at | timestamp            | Tanggal dibuat         |
| updated_at | timestamp            | Tanggal diperbarui     |

---

### **Tabel: kosts**

| Field      | Tipe Data           | Keterangan         |
| ---------- | ------------------- | ------------------ |
| id         | int (PK)            | ID unik kos        |
| user_id    | int (FK → users.id) | Pemilik kos        |
| nama_kost  | string              | Nama kos           |
| alamat     | string              | Alamat lengkap kos |
| deskripsi  | text                | Deskripsi kos      |
| created_at | timestamp           | Tanggal dibuat     |
| updated_at | timestamp           | Tanggal diperbarui |

---

### **Tabel: kamar**

| Field      | Tipe Data                  | Keterangan                |
| ---------- | -------------------------- | ------------------------- |
| id         | int (PK)                   | ID unik kamar             |
| kost_id    | int (FK → kosts.id)        | Kos tempat kamar berada   |
| nama_kamar | string                     | Nama atau nomor kamar     |
| harga      | decimal                    | Harga sewa per bulan      |
| status     | enum('tersedia','dipesan') | Status ketersediaan kamar |
| created_at | timestamp                  | Tanggal dibuat            |
| updated_at | timestamp                  | Tanggal diperbarui        |

---

### **Tabel: pemesanan**

| Field         | Tipe Data                                   | Keterangan              |
| ------------- | ------------------------------------------- | ----------------------- |
| id            | int (PK)                                    | ID unik pemesanan       |
| user_id       | int (FK → users.id)                         | Pengguna yang memesan   |
| kamar_id      | int (FK → kamar.id)                         | Kamar yang dipesan      |
| tanggal_mulai | date                                        | Tanggal mulai sewa      |
| durasi        | int                                         | Lama sewa (dalam bulan) |
| status        | enum('pending','dibayar','selesai','batal') | Status pemesanan        |
| created_at    | timestamp                                   | Tanggal dibuat          |
| updated_at    | timestamp                                   | Tanggal diperbarui      |

---

## **4. Diagram Relasi Antar Tabel (ERD)**

```mermaid
erDiagram
    USERS {
        int id PK
        string name
        string email
        string password
        enum role
        timestamp created_at
        timestamp updated_at
    }

    KOSTS {
        int id PK
        int user_id FK
        string nama_kost
        string alamat
        text deskripsi
        timestamp created_at
        timestamp updated_at
    }

    KAMAR {
        int id PK
        int kost_id FK
        string nama_kamar
        decimal harga
        enum status
        timestamp created_at
        timestamp updated_at
    }

    PEMESANAN {
        int id PK
        int user_id FK
        int kamar_id FK
        date tanggal_mulai
        int durasi
        enum status
        timestamp created_at
        timestamp updated_at
    }

    %% Relasi antar tabel
    USERS ||--o{ KOSTS : "memiliki"
    KOSTS ||--o{ KAMAR : "berisi"
    USERS ||--o{ PEMESANAN : "melakukan"
    KAMAR ||--o{ PEMESANAN : "dipesan"
```

---

## **5. Penjelasan Singkat**

Desain database ini disusun agar sistem **KOST-SI** dapat:

* Mengelola akun admin dan user secara terpisah.
* Memungkinkan satu admin memiliki banyak kos dan kamar.
* Menyimpan riwayat pemesanan oleh user dengan status yang jelas (pending, dibayar, selesai, atau batal).
* Memastikan integritas data melalui relasi antar tabel (Foreign Key).

