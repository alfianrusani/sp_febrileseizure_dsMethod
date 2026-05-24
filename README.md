# Febrile Seizure Expert System
**Sistem Pakar Mendiagnosa Penyakit Febrile Seizure pada Anak**
**Metode: Dempster-Shafer | Stack: Laravel 13 + PHP 8.3 | Template: Bizland (User) + Tabler (Admin)**

---

## Struktur Project

```
febrile-seizure/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DiagnosisController.php          ← User-facing controller
│   │   │   ├── Auth/AuthController.php           ← Login/logout
│   │   │   └── Admin/AdminControllers.php        ← All admin controllers (single file)
│   │   └── Middleware/AdminMiddleware.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Disease.php
│   │   ├── Symptom.php
│   │   ├── KnowledgeBase.php
│   │   └── Diagnosis.php
│   └── Services/
│       └── DempsterShaferService.php             ← Core DS calculation engine
├── database/
│   ├── migrations/
│   │   ├── ..._create_users_table.php
│   │   ├── ..._create_diseases_table.php
│   │   ├── ..._create_symptoms_table.php
│   │   ├── ..._create_knowledge_base_table.php
│   │   └── ..._create_diagnoses_table.php
│   └── seeders/DatabaseSeeder.php               ← All 22 symptoms + 2 diseases pre-loaded
├── resources/views/
│   ├── layouts/
│   │   ├── user.blade.php                        ← Bizland Bootstrap 5 layout
│   │   └── admin.blade.php                       ← Tabler admin layout
│   ├── user/
│   │   ├── home.blade.php
│   │   ├── diagnosis.blade.php                   ← Consultation form
│   │   ├── result.blade.php                      ← Diagnosis result
│   │   ├── print.blade.php                       ← Printable report
│   │   ├── about.blade.php
│   │   ├── diseases.blade.php
│   │   └── contact.blade.php
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── diseases/{index,form}.blade.php
│   │   ├── symptoms/{index,form}.blade.php
│   │   ├── knowledge/index.blade.php
│   │   └── diagnoses/{index,show}.blade.php
│   └── auth/login.blade.php
├── routes/web.php
└── bootstrap/app.php
```

---

## Setup di Laravel Herd (Langkah-langkah)

### 1. Buat project Laravel 13 baru

```bash
cd ~/Herd
composer create-project laravel/laravel febrile-seizure "^11"
# atau Laravel 13 (jika sudah tersedia):
composer create-project laravel/laravel febrile-seizure
```

### 2. Copy semua file dari folder ini ke project Laravel

Salin semua file yang telah dibuat ke dalam project Laravel Anda:

```bash
# Copy semua file (sesuaikan path)
cp -r /path/to/downloaded/files/* ~/Herd/febrile-seizure/
```

**Pastikan file-file ini ada di posisi yang benar:**
- `app/Http/Controllers/DiagnosisController.php`
- `app/Http/Controllers/Auth/AuthController.php`
- `app/Http/Controllers/Admin/AdminControllers.php`
- `app/Http/Middleware/AdminMiddleware.php`
- `app/Models/*.php` (semua 5 model)
- `app/Services/DempsterShaferService.php`
- `database/migrations/*.php` (semua 5 migrasi)
- `database/seeders/DatabaseSeeder.php`
- `resources/views/**/*.blade.php` (semua view)
- `routes/web.php`
- `bootstrap/app.php`

### 3. Konfigurasi .env

```bash
cd ~/Herd/febrile-seizure
cp .env.example .env
php artisan key:generate
```

Edit `.env`:

```dotenv
APP_NAME="Febrile Seizure Expert"
APP_URL=http://febrile-seizure.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=febrile_seizure
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Buat database

Buka TablePlus / phpMyAdmin / MySQL CLI:

```sql
CREATE DATABASE febrile_seizure CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Jalankan migrasi dan seeder

```bash
php artisan migrate --seed
```

Ini akan otomatis membuat:
- ✅ 2 penyakit (P1: Kejang Demam Sederhana, P2: Kejang Demam Kompleks)
- ✅ 22 gejala lengkap dengan nilai densitas dari jurnal
- ✅ Basis pengetahuan (relasi gejala-penyakit)
- ✅ 1 akun admin

### 6. Buka di browser

Herd otomatis membuat domain `.test`. Akses:

| URL | Keterangan |
|-----|-----------|
| `http://febrile-seizure.test` | Website user (Bizland) |
| `http://febrile-seizure.test/konsultasi` | Form konsultasi |
| `http://febrile-seizure.test/login` | Login admin |
| `http://febrile-seizure.test/admin` | Dashboard admin (Tabler) |

### 7. Kredensial Admin

```
Email    : admin@febrileseizure.com
Password : admin123
```

---

## Fitur Sistem

### 👤 Halaman User (Bizland Template)
| Halaman | Route | Deskripsi |
|---------|-------|-----------|
| Beranda | `/` | Hero section, fitur, cara kerja, info penyakit |
| Konsultasi | `/konsultasi` | Form data pasien + pilih gejala (22 gejala) |
| Hasil Diagnosa | `/konsultasi/hasil/{id}` | Hasil DS + rekomendasi penanganan |
| Cetak Laporan | `/konsultasi/cetak/{id}` | Print-friendly PDF report |
| Tentang | `/about` | Info sistem, metode DS, tim developer |
| Penyakit | `/diseases` | Informasi lengkap 2 jenis kejang demam |
| Kontak | `/contact` | Form kontak |

### 🔐 Halaman Admin (Tabler Template)
| Halaman | Route | Deskripsi |
|---------|-------|-----------|
| Dashboard | `/admin` | Stats, diagnosa terbaru, chart distribusi |
| Data Penyakit | `/admin/diseases` | CRUD penyakit |
| Data Gejala | `/admin/symptoms` | CRUD gejala + density slider |
| Basis Pengetahuan | `/admin/knowledge` | Kelola relasi gejala-penyakit |
| Laporan Diagnosa | `/admin/diagnoses` | List + filter + detail diagnosa |

---

## Algoritma Dempster-Shafer

File: `app/Services/DempsterShaferService.php`

```
1. Inisialisasi mass function untuk setiap gejala:
   - m{disease}    = density (nilai keyakinan)
   - m{theta}      = 1 - density (ketidakpastian)

2. Kombinasi bertahap (gejala 1 → gejala 2 → ... → gejala n):
   m3(Z) = Σ_{X∩Y=Z} m1(X)·m2(Y) / (1 − K)
   di mana K = Σ_{X∩Y=∅} m1(X)·m2(Y)

3. Cari nilai belief tertinggi → diagnosis final
```

---

## Teknologi

| Komponen | Teknologi |
|----------|-----------|
| Backend | Laravel 13 (PHP 8.3) |
| Database | MySQL 8+ |
| Frontend User | Bootstrap 5 (Bizland style) |
| Frontend Admin | Tabler v1.0.0-beta20 |
| Icons | Bootstrap Icons 1.11.3 |
| Fonts | Google Fonts (Raleway + Open Sans) |
| Environment | Laravel Herd |

---

## Troubleshooting

**Error: Class not found**
```bash
composer dump-autoload
```

**Migration error**
```bash
php artisan migrate:fresh --seed
```

**Permission error**
```bash
chmod -R 775 storage bootstrap/cache
```

**Herd tidak mengenali domain**
- Pastikan project ada di folder `~/Herd/`
- Restart Herd dari system tray
