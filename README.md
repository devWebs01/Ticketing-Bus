# Sistem E-Ticketing Bus PT. Four Best Synergy

Sistem pemesanan tiket bus online untuk PT. Four Best Synergy yang memungkinkan pelanggan memesan tiket antar kota dengan mudah dan efisien.

## ✨ Fitur Utama

* **Manajemen User**: Role-based (customer, admin, checker)
* **Manajemen Jadwal**: CRUD jadwal bus dengan informasi lengkap
* **Pemesanan Kursi**: Pemilihan kursi real-time
* **Pembayaran**: Upload bukti pembayaran
* **Trip Manifest**: Manajemen perjalanan (driver & conductor)
* **Panel Admin**: Interface untuk mengelola seluruh sistem

## 🛠️ Teknologi & Stack

* **Framework**: Laravel 11
* **Frontend**: Livewire + Tailwind CSS
* **Database**: MySQL 8.0+
* **Admin Panel**: Filament 3.x
* **PHP**: 8.2+

## 📋 Persyaratan

* PHP 8.2 atau lebih tinggi
* MySQL 8.0+ atau MariaDB 10.3+
* Composer 2.x
* Node.js 18.x+ (untuk kompilasi aset)
* RAM minimum 2GB

## 🚀 Instalasi

1. **Clone repository**

   ```bash
   git clone https://github.com/your-username/e-ticketing-bus.git
   cd e-ticketing-bus
   ```

2. **Install dependencies**

   ```bash
   composer install
   npm install
   ```

3. **Setup environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Edit `.env` dan atur:

   ```env
   APP_URL=http://127.0.0.1:8000
   DB_DATABASE=nama_database
   DB_USERNAME=username_db
   DB_PASSWORD=password_db
   ```

4. **Setup database**

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Buat symbolic link storage (jika perlu)**

   ```bash
   php artisan storage:link
   ```

6. **Compile assets**

   ```bash
   npm run build
   ```

7. **Jalankan aplikasi**

   ```bash
   php artisan serve --host=127.0.0.1 --port=8000
   ```

   Aplikasi akan berjalan di `http://127.0.0.1:8000`

## 📚 Login (Admin)

1. **Akses halaman admin**

   ```text
   http://127.0.0.1:8000/admin
   ```
2. **Credensial default**

   ```text
   Email : admin@testing.com
   Password : password
   ```

## 📝 Catatan Tambahan

* Pastikan konfigurasi database pada `.env` benar sebelum menjalankan migrasi.
* Jika menggunakan Docker atau environment non-local, sesuaikan `APP_URL` dan host pada perintah `php artisan serve`.
* Untuk environment produksi, gunakan web server (Nginx/Apache) dan jangan gunakan `php artisan serve`.

---
