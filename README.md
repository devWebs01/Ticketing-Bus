# Sistem E-Ticketing Bus PT. Four Best Synergy

Sistem pemesanan tiket bus online untuk PT. Four Best Synergy yang memungkinkan pelanggan memesan tiket bus antar kota dengan mudah dan efisien.

## ✨ Fitur Utama

- **Manajemen User**: Sistem role-based dengan customer, admin, dan checker
- **Manajemen Jadwal**: CRUD jadwal bus dengan informasi lengkap
- **Pemesanan Kursi**: Sistem pemilihan kursi real-time
- **Pembayaran**: Multiple payment method (cash, transfer, credit card, e-wallet)
- **Trip Manifest**: Manajemen perjalanan dengan driver dan conductor
- **Panel Admin**: Interface untuk mengelola semua aspek sistem

## 🛠️ Teknologi & Stack

- **Framework**: Laravel 11
- **Frontend**: Livewire + Tailwind CSS
- **Database**: MySQL 8.0+
- **Admin Panel**: Filament 3.x
- **PHP**: 8.2+

## 📋 Requirements

- PHP 8.2 atau lebih tinggi
- MySQL 8.0+ atau MariaDB 10.3+
- Composer 2.x
- Node.js 18.x+ (untuk asset compilation)
- RAM minimum 2GB

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

4. **Setup database**
   ```bash
   # Konfigurasi database di .env
   php artisan migrate
   php artisan db:seed
   ```

5. **Compile assets**
   ```bash
   npm run build
   ```

6. **Jalankan aplikasi**
   ```bash
   php artisan serve
   ```

Aplikasi akan berjalan di `http://localhost:8000`

## 📚 Dokumentasi

- [Entity-Relationship Diagram](docs/erd_diagram.md)
- [System Requirements](docs/test-system-booking-tiket-bus-pt-four-best-synergy.pdf)
- [Schedule System Flow](docs/schedule-system-flow.md)
