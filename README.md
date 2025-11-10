# 🎓 CRUD Laravel - Sistem Manajemen Data Mahasiswa

Aplikasi web untuk mengelola data mahasiswa yang dibangun menggunakan **Laravel 12** dengan sistem autentikasi lengkap. Aplikasi ini menerapkan operasi **CRUD (Create, Read, Update, Delete)** dengan fitur tambahan seperti pencarian, export data, dan antarmuka yang responsif menggunakan Bootstrap.

## 📋 Fitur Utama

### ✨ Manajemen Mahasiswa
* **📝 Create:** Menambahkan data mahasiswa baru (Nama, NIM, Email, Program Studi)
* **👁️ Read:** Menampilkan daftar mahasiswa dengan pagination dan pencarian
* **✏️ Update:** Mengedit dan memperbarui data mahasiswa
* **🗑️ Delete:** Menghapus data mahasiswa dengan konfirmasi

### 🔐 Sistem Autentikasi
* **🔑 Login/Register:** Sistem autentikasi menggunakan Laravel Breeze
* **🛡️ Protected Routes:** Semua fitur mahasiswa dilindungi autentikasi
* **👤 User Management:** Profil pengguna yang dapat diedit

### 📊 Export & Reporting
* **📄 Export PDF:** Mengunduh data mahasiswa dalam format PDF
* **📈 Export CSV:** Mengunduh data mahasiswa dalam format CSV/Excel
* **🔍 Search:** Pencarian berdasarkan nama, NIM, email, atau program studi

### 🎨 Interface & UX
* **📱 Responsive Design:** Interface yang responsif menggunakan Bootstrap 5
* **🎯 User-Friendly:** Antarmuka yang intuitif dan mudah digunakan
* **⚡ Fast Loading:** Optimized dengan pagination dan caching

## ⚙️ Tech Stack

### 🚀 Backend
* **Framework:** Laravel 12.31.1
* **PHP:** 8.4.12
* **Database:** MySQL/MariaDB
* **Authentication:** Laravel Breeze

### 🎨 Frontend
* **Template Engine:** Blade Templates
* **CSS Framework:** Bootstrap 5.3.2
* **Icons:** Bootstrap Icons & Emoji
* **Build Tool:** Vite

### 📦 Dependencies
* **PDF Generation:** `barryvdh/laravel-dompdf`
* **Excel Export:** Custom CSV implementation
* **Faker:** Indonesian locale data generation
* **Authentication UI:** Laravel Breeze

### 🗄️ Database Structure
* **Users Table:** Sistem autentikasi pengguna
* **Mahasiswas Table:** Data mahasiswa (id, nama, nim, email, prodi)
* **Sessions Table:** Manajemen session pengguna
* **Jobs & Cache Tables:** Background processing dan caching

## 🚀 Installation & Setup

### 📋 Requirements
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL/MariaDB

### ⚡ Quick Start

1. **📥 Clone Repository**
   ```bash
   git clone https://github.com/belpythons/crud-laravel.git
   cd crud-laravel
   ```

2. **📦 Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **⚙️ Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **🗄️ Database Configuration**
   Update your `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=crud_laravel
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **🏗️ Database Migration & Seeding**
   ```bash
   php artisan migrate:fresh --seed
   ```
   This will create all tables and populate with 25 sample mahasiswa records.

6. **🎨 Build Assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

7. **🚀 Start Development Server**
   ```bash
   php artisan serve
   ```
   Visit: `http://127.0.0.1:8000`

### 🔑 Default Access
- Create a new account via registration
- Or login with seeded user credentials (if any)
- Navigate to `/mahasiswa` for CRUD operations

## 📱 Usage

### 🎯 Main Features Access
- **Homepage:** `http://127.0.0.1:8000`
- **Login/Register:** Click login button on homepage
- **Mahasiswa CRUD:** `http://127.0.0.1:8000/mahasiswa` (requires login)
- **Export PDF:** Available from mahasiswa index page
- **Export CSV:** Available from mahasiswa index page

### 🔍 Search & Filter
- Use the search box to filter by: nama, NIM, email, or program studi
- Results are paginated (5 records per page)
- Search query is preserved across pagination

## 📂 Project Structure

```
crud-laravel/
├── 📁 app/
│   ├── 📁 Http/Controllers/
│   │   └── 🎛️ MahasiswaController.php    # CRUD operations
│   ├── 📁 Models/
│   │   ├── 👤 User.php                   # User model
│   │   └── 🎓 Mahasiswa.php              # Mahasiswa model
│   └── 📁 Exports/
│       └── 📊 MahasiswaExport.php        # CSV export logic
├── 📁 database/
│   ├── 📁 migrations/                    # Database schema
│   └── 📁 seeders/
│       └── 🌱 MahasiswaSeeder.php        # Sample data
├── 📁 resources/views/
│   ├── 📁 mahasiswa/                     # CRUD views
│   │   ├── 📄 index.blade.php            # List view
│   │   ├── ➕ create.blade.php           # Create form
│   │   ├── ✏️ edit.blade.php             # Edit form
│   │   └── 👁️ show.blade.php             # Detail view
│   └── 📁 auth/                          # Authentication views
└── 📁 routes/
    └── 🛣️ web.php                        # Application routes
```

## 🎯 Features Overview

### 🎓 Mahasiswa Management
| Feature | Description | Route |
|---------|-------------|-------|
| 📋 List | View all mahasiswa with search & pagination | `GET /mahasiswa` |
| ➕ Create | Add new mahasiswa | `GET /mahasiswa/create` |
| 💾 Store | Save new mahasiswa | `POST /mahasiswa` |
| 👁️ Show | View mahasiswa details | `GET /mahasiswa/{id}` |
| ✏️ Edit | Edit mahasiswa form | `GET /mahasiswa/{id}/edit` |
| 🔄 Update | Update mahasiswa data | `PUT /mahasiswa/{id}` |
| 🗑️ Delete | Remove mahasiswa | `DELETE /mahasiswa/{id}` |
| 📄 Export PDF | Download PDF report | `GET /mahasiswa-pdf` |
| 📊 Export CSV | Download CSV file | `GET /mahasiswa-excel` |

### 🔐 Authentication Routes
| Feature | Route | Description |
|---------|-------|-------------|
| 🏠 Home | `GET /` | Welcome page with login/register |
| 🔑 Login | `GET /login` | Login form |
| 📝 Register | `GET /register` | Registration form |
| 🏠 Dashboard | `GET /dashboard` | User dashboard |
| 👤 Profile | `GET /profile` | User profile management |

## 🛠️ Development

### 🔧 Artisan Commands
```bash
# Database
php artisan migrate:fresh --seed    # Reset & seed database
php artisan migrate                  # Run migrations
php artisan db:seed                  # Run seeders

# Cache Management
php artisan cache:clear              # Clear application cache
php artisan config:clear             # Clear config cache
php artisan view:clear               # Clear compiled views

# Development
php artisan serve                    # Start development server
php artisan tinker                   # Interactive shell
```

### 🎨 Asset Building
```bash
npm run dev          # Development build with watch
npm run build        # Production build
npm run watch        # Watch for changes
```

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

**belpythons**
- GitHub: [@belpythons](https://github.com/belpythons)
- Repository: [crud-laravel](https://github.com/belpythons/crud-laravel)

---

⭐ **Star this repository if you find it helpful!**
