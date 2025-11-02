Proyek CRUD Mahasiswa (UTS PBF)
Proyek ini adalah aplikasi web sederhana yang dibangun menggunakan Laravel untuk mengelola data mahasiswa. Aplikasi ini menerapkan operasi dasar CRUD (Create, Read, Update, Delete). Proyek ini dibuat untuk memenuhi tugas Ujian Tengah Semester (UTS) mata kuliah Pemrograman Berbasis Framework (PBF).
URL Website: https://dazzling-example-deg.sgp.dom.my.id/mahasiswa
📋 Fitur Utama
Berdasarkan file app/Http/Controllers/MahasiswaController.php dan routes/web.php, aplikasi ini memiliki fitur-fitur berikut:
•	Create: Menambahkan data mahasiswa baru (termasuk Nama, NIM, Jurusan, dan Email).
•	Read: Menampilkan daftar semua data mahasiswa dalam bentuk tabel.
•	Update: Mengedit dan memperbarui data mahasiswa yang sudah ada.
•	Delete: Menghapus data mahasiswa dari database.
•	Export PDF: Mengunduh data tabel mahasiswa dalam format PDF.
•	Seeder: Menyertakan data dummy untuk tabel mahasiswa menggunakan MahasiswaSeeder.php.
⚙️ Teknologi yang Digunakan
•	Framework: Laravel (versi dapat dilihat di composer.json)
•	Database: Menggunakan skema yang didefinisikan dalam migrasi 2025_09_29_013905_create_mahasiswas_table.php.
•	Frontend: Blade templates (dapat dilihat di direktori resources/views/mahasiswa/).
•	Paket Tambahan: barryvdh/laravel-dompdf untuk generasi PDF (didefinisikan dalam composer.json).
🚀 Instalasi & Penyiapan Lokal
Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan lokal Anda:
1.	Clone Repository
Bash
git clone [URL_REPOSITORY_ANDA]
cd crud-laravel
2.	Install Dependensi Pastikan Anda memiliki Composer terinstal.
Bash
composer install
3.	Konfigurasi Lingkungan Salin file .env.example menjadi .env.
Bash
cp .env.example .env
4.	Buat Kunci Aplikasi
Bash
php artisan key:generate
5.	Konfigurasi Database Buka file .env dan atur koneksi database Anda (Nama database, username, password).
Code snippet
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_anda
DB_PASSWORD=password_anda
6.	Jalankan Migrasi Database Perintah ini akan membuat tabel mahasiswas dan tabel bawaan Laravel lainnya.
Bash
php artisan migrate
7.	(Opsional) Jalankan Seeder Untuk mengisi database dengan data dummy.
Bash
php artisan db:seed --class=MahasiswaSeeder
8.	Jalankan Aplikasi
Bash
php artisan serve
Aplikasi sekarang akan berjalan di http://127.0.0.1:8000. Buka http://127.0.0.1:8000/mahasiswa di browser Anda.

