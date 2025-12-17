# 📚 Simple Student Management System
### Program Belajar Konsep MVC dan REST API dengan CodeIgniter

![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.x-orange)
![PHP](https://img.shields.io/badge/PHP-7.4+-blue)
![License](https://img.shields.io/badge/License-MIT-green)

Program sederhana untuk memahami konsep **Model-View-Controller (MVC)** dan **REST API** menggunakan framework CodeIgniter 3.

## 🎯 Fitur

- ✅ **CRUD lengkap** (Create, Read, Update, Delete) mahasiswa
- ✅ **MVC Architecture** yang jelas dan mudah dipahami
- ✅ **REST API** endpoints dengan JSON response
- ✅ **Web Interface** yang interaktif dan responsif
- ✅ **API Testing Tool** terintegrasi
- ✅ Dokumentasi lengkap untuk pembelajaran

## 🚀 Quick Start

### 1️⃣ Clone Repository
```bash
git clone https://github.com/SatriaRidhoRamadana/Simple-Student-Management-for-API-and-MVC-Learning.git
cd Simple-Student-Management-for-API-and-MVC-Learning
```

### 2️⃣ Import Database
```sql
CREATE DATABASE uas_pw;
USE uas_pw;
```
Kemudian import file `database_schema.sql`

### 3️⃣ Konfigurasi Database
Edit `application/config/database.php`:
```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'uas_pw',
    'dbdriver' => 'mysqli',
);
```

### 4️⃣ Jalankan Aplikasi
- Pastikan Apache & MySQL sudah berjalan
- Akses: `http://localhost/UAS_PW/student`

## 📡 API Endpoints

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/student/api_get_all` | Ambil semua mahasiswa |
| GET | `/student/api_get/{id}` | Ambil mahasiswa berdasarkan ID |
| GET | `/student/api_search?q={keyword}` | Cari mahasiswa |
| POST | `/student/api_create` | Tambah mahasiswa baru |
| PUT | `/student/api_update/{id}` | Update data mahasiswa |
| DELETE | `/student/api_delete/{id}` | Hapus mahasiswa |

### Contoh Request

**GET - Ambil Semua Data**
```bash
curl http://localhost/UAS_PW/student/api_get_all
```

**POST - Tambah Data**
```bash
curl -X POST http://localhost/UAS_PW/student/api_create \
  -H "Content-Type: application/json" \
  -d '{
    "nama": "John Doe",
    "nim": "2024001",
    "email": "john@example.com",
    "prodi": "Teknik Informatika"
  }'
```

**Response Format**
```json
{
  "status": true,
  "message": "Data berhasil diambil",
  "data": [...],
  "total": 3
}
```

## 🏗️ Struktur MVC

```
application/
├── models/
│   └── Student_model.php       # Logika database
├── controllers/
│   └── Student.php              # Logika aplikasi + API
└── views/
    └── student/
        ├── index.php            # Daftar mahasiswa
        ├── create.php           # Form tambah
        └── edit.php             # Form edit
```

## 💡 Konsep yang Dipelajari

### Model (Student_model.php)
- Menangani semua operasi database
- Methods: `get_all()`, `get_by_id()`, `insert()`, `update()`, `delete()`, `search()`

### Controller (Student.php)
- Menghubungkan Model dan View
- Web actions untuk UI
- API actions untuk REST API

### View (*.php)
- Presentasi data ke user
- Form input dan tampilan tabel

## 🧪 Testing API

Buka file `api_testing_tool.html` di browser untuk testing API secara interaktif dengan UI yang user-friendly.

## 📖 Dokumentasi

- **[QUICK_START.md](QUICK_START.md)** - Panduan cepat setup
- **[BELAJAR_MVC_API.md](BELAJAR_MVC_API.md)** - Penjelasan lengkap konsep MVC & API
- **[FIX_404_ERROR.md](FIX_404_ERROR.md)** - Troubleshooting error 404

## 🔧 Troubleshooting

### Error 404 Not Found?
Baca panduan lengkap di [FIX_404_ERROR.md](FIX_404_ERROR.md)

### Database Connection Error?
- Pastikan MySQL running
- Cek konfigurasi di `application/config/database.php`
- Pastikan database `uas_pw` sudah dibuat

## 📦 Requirements

- PHP >= 7.4
- MySQL/MariaDB
- Apache Web Server dengan mod_rewrite
- CodeIgniter 3.x

## 📝 License

MIT License - Bebas digunakan untuk pembelajaran

## 👨‍💻 Author

**Satria Ridho Ramadana**
- GitHub: [@SatriaRidhoRamadana](https://github.com/SatriaRidhoRamadana)

## 🙏 Acknowledgments

- Framework: [CodeIgniter](https://codeigniter.com/)
- Untuk pembelajaran konsep MVC dan REST API

---

**Happy Learning! 🎉**

Jika bermanfaat, jangan lupa ⭐ Star repository ini!
