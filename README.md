# Sistem E-Ticketing Bus PT. Four Best Synergy

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-red.svg" alt="Laravel 11">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/MySQL-8.0+-orange.svg" alt="MySQL 8.0+">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="MIT License">
</p>

## 📋 Deskripsi Sistem

Sistem E-Ticketing Bus adalah aplikasi web modern untuk pemesanan tiket bus antar kota yang dikembangkan khusus untuk PT. Four Best Synergy. Sistem ini menyediakan platform lengkap untuk mengelola operasional bus, mulai dari manajemen jadwal, pemesanan kursi, pembayaran, hingga pelaporan perjalanan.

### 🎯 Tujuan Sistem

- Memudahkan pelanggan dalam memesan tiket bus secara online
- Mengoptimalkan manajemen operasional perusahaan bus
- Meningkatkan efisiensi proses pemesanan dan pembayaran
- Menyediakan data real-time untuk pengambilan keputusan
- Mengurangi kesalahan manual dalam proses booking

## ✨ Fitur Utama

### 👥 Manajemen Pengguna
- **Role-based Access Control**: Customer, Admin, Checker
- **Registrasi & Login**: Sistem autentikasi yang aman
- **Profil Pengguna**: Manajemen data pribadi pelanggan

### 🚌 Manajemen Armada & Jadwal
- **CRUD Rute**: Tambah, edit, hapus rute perjalanan
- **Manajemen Kendaraan**: Data bus dan kapasitas kursi
- **Jadwal Perjalanan**: Sistem jadwal dinamis dengan hari operasional
- **Seat Layout**: Konfigurasi layout kursi per kendaraan

### 🎫 Sistem Pemesanan
- **Pencarian Jadwal**: Filter berdasarkan tanggal, rute, waktu
- **Pemilihan Kursi**: Interface real-time untuk memilih kursi
- **Booking Process**: Proses pemesanan yang aman dan terstruktur
- **Konfirmasi Booking**: Email/SMS notifikasi

### 💳 Sistem Pembayaran
- **Multiple Payment Methods**:
  - Tunai (Cash)
  - Transfer Bank
  - Kartu Kredit/Debit
  - E-Wallet (GoPay, OVO, Dana, LinkAja)
- **Payment Gateway Integration**: Mendukung berbagai provider
- **Payment Status Tracking**: Monitoring status pembayaran real-time

### 📊 Trip Manifest & Operasional
- **Surat Jalan**: Dokumen resmi perjalanan
- **Driver & Conductor Assignment**: Penugasan kru perjalanan
- **Manifest Penumpang**: Daftar penumpang per trip
- **Check-in System**: Sistem boarding untuk checker

### 👨‍💼 Panel Admin (Filament)
- **Dashboard Analytics**: Statistik penjualan dan operasional
- **User Management**: Kelola pengguna dan role
- **Content Management**: Update informasi perusahaan
- **Reporting System**: Laporan keuangan dan operasional
- **Settings Management**: Konfigurasi sistem

## 🛠️ Teknologi & Stack

### Backend
- **Framework**: Laravel 11.x
- **PHP Version**: 8.2 atau lebih tinggi
- **Database**: MySQL 8.0+
- **ORM**: Eloquent ORM

### Frontend
- **CSS Framework**: Tailwind CSS
- **JavaScript Framework**: Livewire (Full-stack framework untuk Laravel)
- **UI Components**: Bootstrap 5 + Custom Components
- **Icons**: Bootstrap Icons

### Admin Panel
- **Framework**: Filament 3.x
- **Theme**: Default Filament dengan custom styling

### Additional Libraries
- **Authentication**: Laravel Sanctum/Breeze
- **File Storage**: Laravel Storage (Local/Public Disk)
- **Email**: Laravel Mail
- **Queue**: Laravel Queue untuk background jobs
- **Testing**: PHPUnit + Laravel Dusk

## 📋 Requirements Sistem

### Server Requirements
- **PHP**: 8.2 atau lebih tinggi
- **Web Server**: Apache/Nginx dengan mod_rewrite
- **Database**: MySQL 8.0+ atau MariaDB 10.3+
- **RAM**: Minimum 2GB (Recommended 4GB+)
- **Storage**: Minimum 10GB untuk aplikasi dan data

### Software Dependencies
- **Composer**: 2.x
- **Node.js**: 18.x+ (untuk asset compilation)
- **NPM/Yarn**: Latest stable version

### Browser Support
- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## 🚀 Panduan Instalasi

### 1. Persiapan Environment

```bash
# Clone repository
git clone https://github.com/your-username/e-ticketing-bus.git
cd e-ticketing-bus

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Copy environment file
cp .env.example .env
```

### 2. Konfigurasi Environment

Edit file `.env` dan sesuaikan konfigurasi berikut:

```env
# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_ticketing_bus
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

# Application Configuration
APP_NAME="E-Ticketing Bus PT. Four Best Synergy"
APP_ENV=local
APP_KEY=base64:your_app_key_here
APP_DEBUG=true
APP_URL=http://localhost:8000

# Mail Configuration (untuk notifikasi)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

# Payment Gateway (jika menggunakan)
PAYMENT_GATEWAY_API_KEY=your_api_key
PAYMENT_GATEWAY_SECRET=your_secret
```

### 3. Setup Database

```bash
# Generate application key
php artisan key:generate

# Jalankan migration
php artisan migrate

# Seed data awal
php artisan db:seed
```

### 4. Compile Assets

```bash
# Compile assets untuk production
npm run build

# Atau untuk development
npm run dev
```

### 5. Menjalankan Aplikasi

```bash
# Jalankan server development
php artisan serve

# Atau menggunakan custom host/port
php artisan serve --host=0.0.0.0 --port=8000
```

Aplikasi akan berjalan di `http://localhost:8000`

### 6. Setup Admin User

```bash
# Buat admin user pertama
php artisan tinker

# Di dalam tinker, jalankan:
User::create([
    'name' => 'Admin',
    'email' => 'admin@fourbest.co.id',
    'password' => Hash::make('password'),
    'role' => 'admin'
]);
```

### 7. Akses Admin Panel

Buka browser dan akses:
- **Frontend Customer**: `http://localhost:8000`
- **Admin Panel**: `http://localhost:8000/admin`

Login dengan kredensial admin yang dibuat pada langkah 6.

## 📖 Cara Penggunaan

### Untuk Customer
1. **Registrasi/Login**: Daftar akun atau login ke sistem
2. **Cari Jadwal**: Pilih rute, tanggal, dan waktu keberangkatan
3. **Pilih Kursi**: Klik kursi yang tersedia pada layout bus
4. **Isi Data Penumpang**: Lengkapi informasi penumpang
5. **Pilih Metode Pembayaran**: Pilih cara pembayaran
6. **Konfirmasi Pembayaran**: Selesaikan pembayaran sesuai metode
7. **Cetak Tiket**: Simpan atau cetak e-tiket

### Untuk Admin
1. **Login ke Admin Panel**: Akses `/admin`
2. **Kelola Master Data**: Setup rute, kendaraan, jadwal
3. **Monitor Booking**: Lihat dan kelola pemesanan
4. **Proses Pembayaran**: Verifikasi pembayaran manual
5. **Generate Manifest**: Buat surat jalan untuk driver
6. **Laporan**: Generate laporan penjualan dan operasional

## 📁 Struktur Database

Sistem menggunakan 11 tabel utama:

```
users (Pengguna)
├── user_details (Detail pengguna)

routes (Rute perjalanan)
├── schedules (Jadwal perjalanan)
│   ├── schedule_days (Hari operasional)

vehicles (Kendaraan)
├── vehicle_seats (Kursi per kendaraan)
│   ├── seats (Data kursi)

bookings (Pemesanan)
├── booking_details (Detail pemesanan)
├── payments (Pembayaran)

trip_manifests (Surat jalan)
├── trip_manifest_details (Detail manifest)

settings (Pengaturan sistem)
```

Detail lengkap ERD dapat dilihat di [`docs/erd_diagram.md`](docs/erd_diagram.md)

## 🔧 Konfigurasi Tambahan

### Queue Worker (untuk email & background jobs)
```bash
# Jalankan queue worker
php artisan queue:work

# Atau menggunakan supervisor untuk production
# Setup supervisor config di /etc/supervisor/conf.d/
```

### Storage Link (untuk file uploads)
```bash
php artisan storage:link
```

### Cache Optimization
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🧪 Testing

```bash
# Jalankan semua test
php artisan test

# Jalankan test spesifik
php artisan test --filter=BookingTest

# Jalankan test dengan coverage
php artisan test --coverage
```

## 📊 Monitoring & Logging

- **Logs**: Semua aktivitas tercatat di `storage/logs/laravel.log`
- **Queue Monitoring**: Pantau job queue melalui admin panel
- **Performance**: Monitor response time dan database queries
- **Error Tracking**: Setup error reporting ke external service

## 🔒 Keamanan

- **CSRF Protection**: Semua form dilindungi CSRF token
- **SQL Injection Prevention**: Menggunakan Eloquent ORM
- **XSS Protection**: Input sanitization dan escaping
- **Rate Limiting**: API rate limiting untuk mencegah abuse
- **Password Hashing**: Bcrypt hashing untuk password
- **Session Security**: Secure session management

## 🤝 Kontribusi

1. Fork repository
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📝 Lisensi

Proyek ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk detail lebih lanjut.

## 📞 Dukungan

Untuk dukungan teknis atau pertanyaan:
- Email: support@fourbest.co.id
- WhatsApp: +62 822-6017-3314
- Website: https://fourbest.co.id

## 📚 Dokumentasi Tambahan

- [Entity-Relationship Diagram](docs/erd_diagram.md)
- [System Requirements](docs/test-system-booking-tiket-bus-pt-four-best-synergy.pdf)
- [Schedule System Flow](docs/schedule-system-flow.md)
- [Testing Report](docs/testing-report.md)

---

**Dikembangkan dengan ❤️ oleh PT. Four Best Synergy**
