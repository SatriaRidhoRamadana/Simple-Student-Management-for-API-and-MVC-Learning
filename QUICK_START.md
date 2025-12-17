# 🚀 Quick Start Guide

## Langkah Cepat Setup:

### 1️⃣ Import Database
Buka phpMyAdmin atau MySQL client, lalu jalankan:
```sql
CREATE DATABASE uas_pw;
USE uas_pw;
```

Kemudian import file `database_schema.sql`

### 2️⃣ Konfigurasi Database
Edit file `application/config/database.php`, ubah bagian ini:

```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',        // Sesuaikan dengan username MySQL Anda
    'password' => '',            // Sesuaikan dengan password MySQL Anda
    'database' => 'uas_pw',      // Nama database
    'dbdriver' => 'mysqli',
    // ... sisanya biarkan default
);
```

### 3️⃣ Akses Aplikasi
Buka browser dan akses:
- **Web UI:** http://localhost/UAS_PW/student
- **API JSON:** http://localhost/UAS_PW/student/api_get_all

### 4️⃣ Testing API
Buka file `api_testing_tool.html` di browser untuk testing API secara interaktif.

---

## ✅ Troubleshooting

### Error 404 Not Found?
- Pastikan URL menggunakan `/student` bukan hanya `/UAS_PW`
- Cek file `application/config/config.php` → `$config['base_url']` = `'http://localhost/UAS_PW/'`

### Database Connection Error?
- Pastikan MySQL/MariaDB sudah running di Laragon
- Cek username & password di `application/config/database.php`
- Pastikan database `uas_pw` sudah dibuat

### Blank Page?
- Cek error di `application/logs/` folder
- Pastikan PHP error reporting enabled

---

Untuk dokumentasi lengkap, baca file `BELAJAR_MVC_API.md`
