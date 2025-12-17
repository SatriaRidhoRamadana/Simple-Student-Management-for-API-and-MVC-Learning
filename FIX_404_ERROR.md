# 🔧 Cara Mengatasi Error 404 pada /student

## Solusi 1: Gunakan index.php di URL (Paling Mudah)
Akses dengan menambahkan `index.php`:
```
http://localhost/UAS_PW/index.php/student
```

## Solusi 2: Aktifkan mod_rewrite (Recommended)

### Cara Aktifkan mod_rewrite di Laragon:

1. **Klik kanan icon Laragon di system tray**
2. **Apache** → **httpd.conf**
3. **Cari baris ini** (tekan Ctrl+F):
   ```
   #LoadModule rewrite_module modules/mod_rewrite.so
   ```
4. **Hapus tanda #** menjadi:
   ```
   LoadModule rewrite_module modules/mod_rewrite.so
   ```
5. **Cari bagian** `<Directory>` dan pastikan ada:
   ```
   AllowOverride All
   ```
6. **Save file** (Ctrl+S)
7. **Restart Apache**: Klik kanan Laragon → **Stop All** → **Start All**
8. **Akses lagi**: `http://localhost/UAS_PW/student`

## Solusi 3: Ubah Config CodeIgniter (Alternatif)

Jika tidak ingin utak-atik Apache, ubah file `application/config/config.php`:

```php
// Biarkan index.php
$config['index_page'] = 'index.php';
```

Lalu selalu akses dengan:
```
http://localhost/UAS_PW/index.php/student
```

---

## ✅ Cek Apakah Sudah Berhasil

Akses URL ini untuk test API:
```
http://localhost/UAS_PW/index.php/student/api_get_all
```

Jika muncul JSON response, berarti BERHASIL! 🎉
