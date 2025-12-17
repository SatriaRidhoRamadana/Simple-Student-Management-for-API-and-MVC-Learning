# 📚 Program Belajar MVC dan API dengan CodeIgniter

Program ini dibuat untuk membantu Anda belajar konsep **Model-View-Controller (MVC)** dan **REST API** dengan framework CodeIgniter.

## 🎯 Konsep yang Dipelajari

### 1. **Model (Student_model.php)**
Model adalah layer yang menangani semua operasi database:
- `get_all()` - Mengambil semua data
- `get_by_id()` - Mencari berdasarkan ID
- `insert()` - Menambah data baru
- `update()` - Mengubah data
- `delete()` - Menghapus data
- `search()` - Mencari berdasarkan keyword

**Keuntungan:** Memisahkan logika database dari controller, mudah di-reuse, dan mudah di-test.

### 2. **Controller (Student.php)**
Controller adalah layer yang menghubungkan Model dan View:
- Menerima input dari user
- Memanggil method di Model
- Mengirim data ke View untuk ditampilkan

**Terdapat 2 jenis action:**
- **Web Actions** (index, create, store, edit, update, delete) - Menampilkan HTML
- **API Actions** (api_get_all, api_create, api_update, api_delete) - Mengembalikan JSON

### 3. **View (index.php, create.php, edit.php)**
View adalah layer presentasi yang menampilkan data kepada user:
- Menerima data dari Controller
- Menampilkan HTML ke browser
- Form untuk input data

## 🚀 Cara Menggunakan

### Step 1: Setup Database
1. Buka MySQL/phpMyAdmin
2. Jalankan SQL dari file `database_schema.sql`
3. Database dan tabel `students` akan otomatis terbuat

### Step 2: Konfigurasi Database di CodeIgniter
Edit file `application/config/database.php`:
```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'uas_pw',
    'dbdriver' => 'mysqli',
    // ... konfigurasi lainnya
);
```

### Step 3: Akses Aplikasi
- **Web UI:** http://localhost:8080/UAS_PW/student
- **API:** http://localhost:8080/UAS_PW/student/api_get_all

## 📡 API Endpoints

### Mengambil Semua Data
```
GET /student/api_get_all
Response:
{
    "status": true,
    "message": "Data berhasil diambil",
    "data": [...],
    "total": 3
}
```

### Mengambil Data Berdasarkan ID
```
GET /student/api_get/1
Response:
{
    "status": true,
    "message": "Data ditemukan",
    "data": {...}
}
```

### Mencari Data
```
GET /student/api_search?q=Budi
Response:
{
    "status": true,
    "message": "Hasil pencarian",
    "data": [...],
    "total": 1
}
```

### Menambah Data (POST)
```
POST /student/api_create
Content-Type: application/json

{
    "nama": "Rudi Hartono",
    "nim": "2024004",
    "email": "rudi@example.com",
    "prodi": "Teknik Informatika"
}

Response:
{
    "status": true,
    "message": "Mahasiswa berhasil ditambahkan",
    "data": {...}
}
```

### Mengubah Data (PUT)
```
PUT /student/api_update/1
Content-Type: application/json

{
    "nama": "Budi Santoso Updated",
    "email": "budi.baru@example.com"
}

Response:
{
    "status": true,
    "message": "Mahasiswa berhasil diperbarui",
    "data": {...}
}
```

### Menghapus Data (DELETE)
```
DELETE /student/api_delete/1

Response:
{
    "status": true,
    "message": "Mahasiswa berhasil dihapus",
    "data": null
}
```

## 💡 Contoh Testing API dengan cURL

### Mengambil semua data
```bash
curl http://localhost:8080/UAS_PW/student/api_get_all
```

### Menambah data
```bash
curl -X POST http://localhost:8080/UAS_PW/student/api_create \
  -H "Content-Type: application/json" \
  -d '{
    "nama": "Dwi Putri",
    "nim": "2024005",
    "email": "dwi@example.com",
    "prodi": "Sistem Informasi"
  }'
```

### Mengubah data
```bash
curl -X PUT http://localhost:8080/UAS_PW/student/api_update/1 \
  -H "Content-Type: application/json" \
  -d '{
    "nama": "Budi Santoso v2",
    "email": "budi.v2@example.com"
  }'
```

### Menghapus data
```bash
curl -X DELETE http://localhost:8080/UAS_PW/student/api_delete/1
```

## 🏗️ Struktur File MVC

```
application/
├── models/
│   └── Student_model.php      (Logika database)
├── controllers/
│   └── Student.php             (Logika aplikasi + API)
└── views/
    └── student/
        ├── layout.php          (Template utama)
        ├── index.php           (Daftar mahasiswa)
        ├── create.php          (Form tambah)
        └── edit.php            (Form edit)
```

## 🎓 Alur MVC dalam Aplikasi

### Flow Menampilkan Daftar Mahasiswa:
```
1. User akses http://localhost/student
2. Router mengarahkan ke Student->index()
3. Controller memanggil Student_model->get_all()
4. Model mengambil data dari database
5. Controller mengirim data ke view
6. View menampilkan tabel mahasiswa ke browser
```

### Flow Menambah Mahasiswa:
```
1. User klik tombol "Tambah Mahasiswa"
2. Student->create() menampilkan form
3. User isi form dan klik Simpan
4. Form di-submit ke Student->store()
5. Controller validasi dan panggil Student_model->insert()
6. Model menyimpan ke database
7. Controller redirect ke halaman daftar
```

### Flow API Create:
```
1. Client POST JSON ke /student/api_create
2. Student->api_create() menerima data JSON
3. Controller validasi input
4. Panggil Student_model->insert()
5. Model simpan ke database
6. Controller return JSON response
```

## 📝 Keuntungan Menggunakan MVC

✅ **Separation of Concerns** - Setiap layer punya tanggung jawab sendiri
✅ **Reusability** - Model bisa digunakan oleh banyak controller
✅ **Testability** - Mudah membuat unit test
✅ **Maintainability** - Mudah menemukan dan memperbaiki bug
✅ **Scalability** - Mudah menambah fitur baru
✅ **Team Work** - Tim bisa bekerja pada layer berbeda secara parallel

## 🔧 Mengembangkan Lebih Lanjut

Anda bisa menambahkan:
- Validasi input yang lebih ketat
- Authentication/Authorization
- Pagination untuk data besar
- Caching untuk performa
- Error handling yang lebih baik
- Unit testing
- API documentation (Swagger)
- Rate limiting untuk API

## 📚 Referensi

- [CodeIgniter Documentation](https://codeigniter.com/user_guide/)
- [MVC Architecture](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)
- [RESTful API Design](https://restfulapi.net/)

---

**Happy Learning! 🎉**
