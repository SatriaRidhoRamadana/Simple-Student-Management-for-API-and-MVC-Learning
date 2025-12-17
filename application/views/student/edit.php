<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa - Belajar MVC</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); overflow: hidden; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
        header h1 { font-size: 2.5em; margin-bottom: 10px; }
        .content { padding: 30px; }
        .alert-error { padding: 15px; margin-bottom: 20px; border-radius: 5px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .btn { padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1em; text-decoration: none; display: inline-block; transition: all 0.3s ease; }
        .btn-primary { background: #667eea; color: white; }
        .btn-primary:hover { background: #5568d3; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-group { display: flex; gap: 10px; margin-top: 20px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 1em; }
        input:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
        .info-box { background: #e7f3ff; border-left: 4px solid #2196F3; padding: 15px; margin: 20px 0; border-radius: 4px; }
        .info-box h4 { color: #0066cc; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📚 Belajar MVC dengan CodeIgniter</h1>
            <p>Edit Data Mahasiswa</p>
        </header>
        
        <div class="content">
            <a href="<?php echo base_url('students'); ?>" class="btn btn-primary" style="margin-bottom: 20px;">← Kembali</a>

            <?php if(!$student): ?>
                <div class="alert-error">
                    ✗ Data mahasiswa tidak ditemukan!
                </div>
            <?php else: ?>
                <form method="post" action="<?php echo base_url('students/update/' . $student['id']); ?>">
                    <div class="form-group">
                        <label for="nim">NIM *</label>
                        <input type="text" id="nim" name="nim" required value="<?php echo htmlspecialchars($student['nim']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap *</label>
                        <input type="text" id="nama" name="nama" required value="<?php echo htmlspecialchars($student['nama']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <input type="text" id="prodi" name="prodi" value="<?php echo htmlspecialchars($student['prodi']); ?>">
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">💾 Perbarui</button>
                        <a href="<?php echo base_url('students'); ?>" class="btn btn-danger">❌ Batal</a>
                    </div>
                </form>

                <div class="info-box" style="margin-top: 30px;">
                    <h4>💡 Konsep MVC dalam action ini:</h4>
                    <ul style="margin-left: 20px; margin-top: 10px;">
                        <li><strong>Model:</strong> Student_model memanggil get_by_id() untuk mengambil data dari database</li>
                        <li><strong>Controller:</strong> Metode edit() mengambil data via model dan mengirimnya ke view</li>
                        <li><strong>View:</strong> File ini menampilkan form dengan data yang sudah diisi</li>
                        <li><strong>Update:</strong> Metode update() memproses form dan memanggil model untuk update database</li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
