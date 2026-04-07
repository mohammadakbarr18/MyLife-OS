<p align="center">
  <img src="public/assets/login-illustration.svg" width="200" alt="MyLife OS Logo">
</p>

<h1 align="center">🧠 MyLife OS</h1>

<p align="center">
  <em>Organize Your Life, Effortlessly.</em>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS 4">
  <img src="https://img.shields.io/badge/Alpine.js-3-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js 3">
  <img src="https://img.shields.io/badge/Vite-7-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite 7">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/license-MIT-green?style=flat-square" alt="License">
  <img src="https://img.shields.io/badge/status-Active-brightgreen?style=flat-square" alt="Status">
</p>

---

## 📖 Tentang Project

**MyLife OS** adalah aplikasi web manajemen kehidupan pribadi yang dirancang sebagai *personal operating system* untuk membantu kamu mengatur keuangan, mengelola tugas harian, merencanakan jadwal, dan mencapai tujuan hidup — semua dalam satu dashboard yang bersih dan modern.

Dibangun dengan **Laravel 12**, **Tailwind CSS v4**, dan **Alpine.js**, aplikasi ini menggabungkan performa tinggi di sisi server dengan antarmuka pengguna yang responsif dan interaktif tanpa memerlukan framework JavaScript yang berat.

### ✨ Mengapa MyLife OS?

| | Fitur | Deskripsi |
|---|---|---|
| 📊 | **Dashboard Terpusat** | Lihat ringkasan keuangan, tugas, dan jadwal hari ini dalam satu halaman |
| 💰 | **Manajemen Keuangan** | Catat pemasukan & pengeluaran dengan kategori kustom |
| ✅ | **To-Do List** | Kelola tugas harian dengan prioritas dan deadline |
| 📅 | **Smart Daily Planner** | Rencanakan hari dengan time-blocking, navigasi tanggal, dan dukungan jadwal melewati tengah malam |
| ⚙️ | **Pengaturan Fleksibel** | Kustomisasi kategori transaksi dengan emoji icon |
| 📱 | **Fully Responsive** | Tampilan sempurna di desktop, tablet, dan mobile |

---

## 📸 Screenshots / Demo

Berikut adalah tampilan dari setiap halaman yang ada di MyLife OS:

### 🏠 Landing Page
Halaman utama yang menyambut pengguna dengan desain warm minimalist dan CTA untuk memulai.

<p align="center">
  <img src="public/assets/screenshots/welcome.png" width="100%" alt="Landing Page" style="border-radius: 12px;">
</p>

---

### 🔑 Login & Register

<table>
  <tr>
    <td width="50%">
      <p align="center"><strong>Halaman Login</strong></p>
      <img src="public/assets/screenshots/login.png" width="100%" alt="Login Page">
    </td>
    <td width="50%">
      <p align="center"><strong>Halaman Register</strong></p>
      <img src="public/assets/screenshots/register.png" width="100%" alt="Register Page">
    </td>
  </tr>
</table>

---

### 📊 Dashboard
Dashboard utama menampilkan ringkasan keuangan bulanan, widget tugas hari ini, dan jadwal harian dalam satu tampilan.

<p align="center">
  <img src="public/assets/screenshots/dashboard.png" width="100%" alt="Dashboard Page" style="border-radius: 12px;">
</p>

---

### 💰 Transactions
Halaman pencatatan transaksi pemasukan dan pengeluaran beserta tombol aksi cepat.

<p align="center">
  <img src="public/assets/screenshots/transactions.png" width="100%" alt="Transactions Page" style="border-radius: 12px;">
</p>

---

### 📈 Transaction Summary
Laporan ringkasan keuangan bulanan & tahunan yang dikelompokkan otomatis.

<p align="center">
  <img src="public/assets/screenshots/transactions-summary.png" width="100%" alt="Transactions Summary Page" style="border-radius: 12px;">
</p>

---

### ✅ To-Do List
Kelola tugas harian dengan status, prioritas, dan progress tracking.

<p align="center">
  <img src="public/assets/screenshots/todo.png" width="100%" alt="To-Do List Page" style="border-radius: 12px;">
</p>

---

### 📅 Daily Planner / Timeline
Smart Daily Planner dengan timeline visual, navigasi antar tanggal, indikator "now" real-time, dan dukungan jadwal overnight.

<p align="center">
  <img src="public/assets/screenshots/schedule.png" width="100%" alt="Daily Planner Page" style="border-radius: 12px;">
</p>

---

### ⚙️ Settings
Kelola informasi profil, update password, kategori keuangan, dan prioritas To-Do List dari satu halaman pengaturan.

<p align="center">
  <img src="public/assets/screenshots/settings.png" width="100%" alt="Settings Page" style="border-radius: 12px;">
</p>

---

## 🚀 Fitur Utama

### 🔐 Autentikasi
- Registrasi akun baru dengan validasi lengkap
- Login dengan opsi "Remember Me"
- Logout aman dengan session invalidation
- Setiap user baru otomatis mendapat kategori default (Salary, Freelance, Food, Transport, dll.)
- Setiap user baru otomatis mendapat prioritas default (`High`, `Medium`, `Low`)

### 📊 Dashboard
- **Ringkasan Keuangan Bulanan** — Total pemasukan dan pengeluaran bulan ini
- **Format Rupiah Cerdas** — Otomatis disingkat menjadi format seperti `6,92 Juta` atau `1,5 Miliar`
- **Transaksi Terakhir** — 5 transaksi terbaru beserta ikon kategori
- **Daftar Todo** — Semua tugas yang perlu diselesaikan dengan toggle real-time
- **Jadwal Hari Ini** — Widget mini-timeline yang menampilkan jadwal harian dengan link ke full planner

### 💰 Manajemen Transaksi
- Tambah transaksi pemasukan (income) atau pengeluaran (expense)
- Setiap transaksi terhubung ke kategori dengan ikon emoji
- Pencatatan jumlah, tanggal, kategori, dan deskripsi opsional
- **Laporan Ringkasan** — Rangkuman bulanan & tahunan yang dikelompokkan otomatis
- Pengurutan otomatis berdasarkan tanggal terbaru

### ✅ To-Do List
- Buat tugas baru dengan judul, prioritas, dan deadline
- Prioritas tugas diambil dari daftar prioritas milik user yang dikelola lewat Settings
- Setiap tugas menampilkan badge prioritas berwarna agar level urgensi lebih mudah dibaca
- **Toggle Completion** — Klik checkbox untuk menandai tugas selesai secara real-time (AJAX)
- Edit tugas yang sudah ada melalui modal
- Hapus tugas dengan konfirmasi modal yang elegan
- Auto-sort: tugas pending selalu tampil di atas

### 📅 Smart Daily Planner
- **Time-blocking** — Jadwalkan kegiatan dengan waktu mulai dan selesai yang presisi
- **Date-based Flexibility** — Navigasi bebas ke tanggal mana pun (kemarin, besok, minggu depan, dll.) via date picker
- **Overnight Scheduling** — Dukungan penuh untuk jadwal melewati tengah malam (contoh: 22:00 – 02:00), ditandai badge `🌙 +1 Hari`
- **Real-time Now Indicator** — Badge "NOW" pulse yang otomatis muncul pada kegiatan yang sedang berlangsung
- **Visual Timeline** — Tampilan vertikal dengan titik indikator state (current / past / future) dan animasi transisi
- **CRUD Lengkap** — Tambah, edit, dan hapus jadwal via modal interaktif dengan emoji picker
- **Duration Badge** — Kalkulasi otomatis durasi setiap kegiatan (contoh: 1j 30m)

### ⚙️ Pengaturan (Settings)
- Perbarui **nama** dan **email** profil langsung dari halaman Settings
- Ganti password akun dengan validasi `current_password` dan konfirmasi password baru
- Kelola kategori pemasukan dan pengeluaran
- Setiap kategori memiliki **nama** dan **ikon emoji** kustom
- Tambah, edit, dan hapus kategori
- Kategori digunakan di seluruh aplikasi (transaksi, dashboard)
- Kelola prioritas To-Do List dengan **nama** dan **warna** kustom
- Tambah, edit, dan hapus prioritas tugas
- Prioritas yang masih dipakai oleh tugas aktif tidak bisa dihapus
- Sistem menjaga minimal satu prioritas agar To-Do List tetap bisa digunakan

---

## 🛠️ Tech Stack

| Layer | Teknologi | Versi |
|---|---|---|
| **Backend** | Laravel | 12.x |
| **Frontend** | Blade Templates + Alpine.js | 3.x |
| **Styling** | Tailwind CSS | 4.x |
| **Build Tool** | Vite | 7.x |
| **Database** | SQLite (default) / MySQL / PostgreSQL | — |
| **Bahasa** | PHP | 8.2+ |
| **Font** | Inter & Poppins (Google Fonts) | — |

---

## 📂 Struktur Project

> Catatan: struktur terbaru juga mencakup `TaskPriority.php`, dukungan prioritas global di `AppServiceProvider.php`, serta pembaruan `SettingsController` dan `settings.blade.php` untuk profil, password, kategori, dan prioritas tugas.

```
MyLife OS/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php          # Autentikasi (login, register, logout)
│   │   ├── DashboardController.php     # Dashboard, ringkasan keuangan & jadwal hari ini
│   │   ├── ScheduleController.php      # CRUD daily planner / jadwal harian
│   │   ├── SettingsController.php      # Manajemen kategori
│   │   ├── TodoController.php          # CRUD & toggle to-do list
│   │   └── TransactionController.php   # CRUD transaksi & laporan ringkasan
│   ├── Models/
│   │   ├── Category.php                # Model kategori (income/expense)
│   │   ├── Schedule.php                # Model jadwal harian (daily planner)
│   │   ├── Todo.php                    # Model tugas/to-do
│   │   ├── Transaction.php             # Model transaksi keuangan
│   │   └── User.php                    # Model pengguna
│   └── Providers/
├── database/
│   └── migrations/                     # Schema database
├── resources/
│   ├── css/app.css                     # Stylesheet utama
│   ├── js/app.js                       # JavaScript utama
│   └── views/
│       ├── auth/                       # Halaman login & register
│       ├── components/                 # Komponen Blade reusable
│       ├── layouts/app.blade.php       # Layout utama + sidebar + modals
│       ├── partials/                   # Partial views (modals, dll.)
│       ├── dashboard.blade.php         # Halaman dashboard
│       ├── schedule.blade.php          # Halaman daily planner / timeline
│       ├── transactions.blade.php      # Daftar transaksi
│       ├── transactions-summary.blade.php  # Laporan ringkasan
│       ├── todo.blade.php              # Halaman to-do list
│       ├── settings.blade.php          # Halaman pengaturan kategori
│       └── welcome.blade.php           # Landing page
├── routes/
│   └── web.php                         # Definisi semua routes
├── public/
│   └── assets/                         # Asset statis (gambar, ikon)
├── composer.json                       # Dependensi PHP
├── package.json                        # Dependensi Node.js
└── vite.config.js                      # Konfigurasi Vite
```

---

## 📋 Prasyarat

Pastikan kamu sudah menginstal software berikut di komputer:

| Software | Versi Minimum | Cek Versi |
|---|---|---|
| **PHP** | 8.2 | `php -v` |
| **Composer** | 2.x | `composer -V` |
| **Node.js** | 18.x | `node -v` |
| **npm** | 9.x | `npm -v` |

> [!NOTE]
> Secara default, project ini menggunakan **SQLite** sebagai database. Tidak perlu install MySQL atau PostgreSQL kecuali kamu ingin menggantinya.

---

## ⚡ Instalasi & Setup

### 1. Clone Repository

```bash
git clone https://github.com/mohammadakbarr18/MyLife-OS.git
cd MyLife-OS
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Install Dependensi Node.js

```bash
npm install
```

### 4. Konfigurasi Environment

```bash
cp .env.example .env
```

Lalu generate application key:

```bash
php artisan key:generate
```

### 5. Setup Database

Secara default, project ini menggunakan **SQLite**. File database akan otomatis dibuat saat migrasi. Jalankan migrasi:

```bash
php artisan migrate
```

> [!TIP]
> Jika kamu ingin menggunakan **MySQL** atau **PostgreSQL**, ubah konfigurasi `DB_CONNECTION` dan parameter database lainnya di file `.env` sebelum menjalankan migrasi.

### 6. Jalankan Aplikasi

Buka **dua terminal** dan jalankan masing-masing perintah berikut:

**Terminal 1 — Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 — Vite Dev Server:**
```bash
npm run dev
```

**Atau**, gunakan satu perintah untuk menjalankan semuanya sekaligus:

```bash
composer dev
```

### 7. Buka di Browser

```
http://localhost:8000
```

🎉 **Selesai!** Kamu akan disambut oleh landing page MyLife OS.

---

## 🗄️ Skema Database

```mermaid
erDiagram
    USERS ||--o{ CATEGORIES : owns
    USERS ||--o{ TRANSACTIONS : owns
    USERS ||--o{ TASK_PRIORITIES : owns
    USERS ||--o{ TODOS : owns
    USERS ||--o{ SCHEDULES : owns
    CATEGORIES ||--o{ TRANSACTIONS : categorizes
    TASK_PRIORITIES ||--o{ TODOS : prioritizes

    USERS {
        bigint id PK
        string name
        string email
        string password
        datetime email_verified_at
        string remember_token
        datetime created_at
        datetime updated_at
    }

    CATEGORIES {
        bigint id PK
        bigint user_id FK
        string name
        string icon
        string type
        datetime created_at
        datetime updated_at
    }

    TRANSACTIONS {
        bigint id PK
        bigint user_id FK
        string type
        decimal amount
        bigint category_id FK
        text description
        date date
        datetime created_at
        datetime updated_at
    }

    TASK_PRIORITIES {
        bigint id PK
        bigint user_id FK
        string name
        string color
        datetime created_at
        datetime updated_at
    }

    TODOS {
        bigint id PK
        bigint user_id FK
        string title
        string status
        bigint task_priority_id FK
        date due_date
        datetime created_at
        datetime updated_at
    }

    SCHEDULES {
        bigint id PK
        bigint user_id FK
        string title
        date date
        time start_time
        time end_time
        string icon
        text note
        datetime created_at
        datetime updated_at
    }
```

> Catatan:
> - `categories.type` dan `transactions.type` berisi `income` atau `expense`
> - `todos.status` berisi `pending` atau `completed`
> - `todos.task_priority_id` terhubung ke `task_priorities`
> - Prioritas default user baru adalah `High`, `Medium`, dan `Low`

---

## 🛣️ Routes / API Endpoints

| Method | URI | Aksi | Deskripsi |
|---|---|---|---|
| `GET` | `/` | — | Landing page / redirect ke dashboard |
| `GET` | `/login` | — | Halaman login |
| `POST` | `/login` | `AuthController@login` | Proses login |
| `GET` | `/register` | — | Halaman registrasi |
| `POST` | `/register` | `AuthController@register` | Proses registrasi |
| `POST` | `/logout` | `AuthController@logout` | Logout |
| `GET` | `/dashboard` | `DashboardController@index` | Dashboard utama |
| `GET` | `/transactions` | `TransactionController@index` | Daftar transaksi |
| `POST` | `/transactions` | `TransactionController@store` | Tambah transaksi |
| `GET` | `/transactions/summary` | `TransactionController@summary` | Laporan ringkasan |
| `GET` | `/todo` | `TodoController@index` | Daftar to-do |
| `POST` | `/todo` | `TodoController@store` | Tambah tugas |
| `PATCH` | `/todo/{id}/toggle` | `TodoController@toggle` | Toggle status tugas |
| `PUT` | `/todo/{id}` | `TodoController@update` | Update tugas |
| `DELETE` | `/todo/{id}` | `TodoController@destroy` | Hapus tugas |
| `GET` | `/schedule` | `ScheduleController@index` | Daily Planner (timeline view) |
| `POST` | `/schedule` | `ScheduleController@store` | Tambah jadwal |
| `PUT` | `/schedule/{id}` | `ScheduleController@update` | Update jadwal |
| `DELETE` | `/schedule/{id}` | `ScheduleController@destroy` | Hapus jadwal |
| `GET` | `/settings` | `SettingsController@index` | Halaman pengaturan |
| `PUT` | `/settings/profile` | `SettingsController@updateProfile` | Update nama dan email profil |
| `PUT` | `/settings/password` | `SettingsController@updatePassword` | Update password akun |
| `POST` | `/settings/categories` | `SettingsController@storeCategory` | Tambah kategori |
| `PUT` | `/settings/categories/{id}` | `SettingsController@updateCategory` | Update kategori |
| `DELETE` | `/settings/categories/{id}` | `SettingsController@destroyCategory` | Hapus kategori |
| `POST` | `/settings/priorities` | `SettingsController@storePriority` | Tambah prioritas tugas |
| `PUT` | `/settings/priorities/{id}` | `SettingsController@updatePriority` | Update prioritas tugas |
| `DELETE` | `/settings/priorities/{id}` | `SettingsController@destroyPriority` | Hapus prioritas tugas |

---

## 🎨 Desain & UI/UX

MyLife OS menggunakan desain yang **warm, clean, dan modern** dengan palet warna utama:

| Warna | Hex | Penggunaan |
|---|---|---|
| 🟫 Coklat Tua | `#3E2723` | Teks utama & heading |
| 🍑 Peach | `#FCE2CE` | Aksen, tombol, sidebar aktif |
| 🫘 Coklat Sedang | `#5F402D` | Teks sekunder & ikon |
| 🥚 Krem | `#FEF6EF` | Warna background utama |

### Fitur UI Utama:
- **Sidebar navigasi** (desktop) + **Bottom navigation bar** (mobile)
- **Modal interaktif** dengan animasi smooth menggunakan Alpine.js
- **Glassmorphism** pada elemen-elemen tertentu
- **Responsive design** — Mobile-first approach
- **Custom font** — Inter untuk body text, Poppins untuk heading
- **Real-time timeline** — Indikator "NOW" pulse pada Daily Planner

---

## 🧪 Testing

Jalankan test suite bawaan Laravel:

```bash
php artisan test
```

Atau menggunakan PHPUnit secara langsung:

```bash
./vendor/bin/phpunit
```

---

## 📦 Build untuk Production

Untuk build asset production:

```bash
npm run build
```

Kemudian pastikan konfigurasi `.env` production sudah benar:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
```

Jalankan optimisasi Laravel:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Ikuti langkah berikut:

1. **Fork** repository ini
2. Buat **branch** fitur baru (`git checkout -b fitur/fitur-baru`)
3. **Commit** perubahan (`git commit -m 'Menambahkan fitur baru'`)
4. **Push** ke branch (`git push origin fitur/fitur-baru`)
5. Buat **Pull Request**

> [!IMPORTANT]
> Pastikan kode kamu mengikuti standar coding PSR-12 dan semua test tetap passed sebelum membuat PR.

---

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT) — bebas digunakan, dimodifikasi, dan didistribusikan.

---

<p align="center">
  Dibuat dengan ❤️ oleh <strong>Mohammad Akbar</strong>
</p>

<p align="center">
  <em>Organize. Track. Schedule. Achieve.</em>
</p>
