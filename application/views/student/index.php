<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa - Belajar MVC</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; background: white; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); overflow: hidden; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
        header h1 { font-size: 2.5em; margin-bottom: 10px; }
        .content { padding: 30px; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .btn { padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1em; text-decoration: none; display: inline-block; transition: all 0.3s ease; }
        .btn-primary { background: #667eea; color: white; }
        .btn-primary:hover { background: #5568d3; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn-group { margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table thead { background: #f8f9fa; }
        table th { padding: 15px; text-align: left; font-weight: 600; border-bottom: 2px solid #dee2e6; }
        table td { padding: 12px 15px; border-bottom: 1px solid #dee2e6; }
        table tbody tr:hover { background: #f8f9fa; }
        .action-buttons { display: flex; gap: 5px; }
        .stat-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 10px; text-align: center; margin-bottom: 20px; }
        .stat-card h3 { font-size: 2em; }
        .info-box { background: #e7f3ff; border-left: 4px solid #2196F3; padding: 15px; margin: 20px 0; border-radius: 4px; }
        .info-box h4 { color: #0066cc; margin-bottom: 10px; }
        .info-box code { background: #fff; padding: 2px 5px; border-radius: 3px; font-family: 'Courier New', monospace; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📚 Belajar MVC dengan CodeIgniter</h1>
            <p>Daftar Mahasiswa</p>
        </header>
        
        <div class="content">
            <?php if($this->session->flashdata('message')): ?>
                <div class="alert alert-success">
                    ✓ <?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php endif; ?>
            
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-error">
                    ✗ <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <div class="stat-card">
                <h3><?php echo $total; ?></h3>
                <p>Total Mahasiswa</p>
            </div>

            <div class="btn-group">
                <a href="<?php echo base_url('students/create'); ?>" class="btn btn-primary">➕ Tambah Mahasiswa</a>
                <a href="<?php echo base_url('api/students'); ?>" class="btn btn-primary" target="_blank">📡 Lihat API JSON</a>
            </div>

            <?php if(empty($students)): ?>
                <div class="info-box">
                    <h4>ℹ️ Belum ada data mahasiswa</h4>
                    <p>Mulai dengan menambahkan data mahasiswa baru melalui tombol "Tambah Mahasiswa" di atas.</p>
                    <p style="margin-top: 10px;"><strong>Catatan:</strong> Pastikan database sudah dibuat dan tabel 'students' sudah ada. Import file <code>database_schema.sql</code> untuk membuat tabel.</p>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Program Studi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($students as $student): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($student['nim']); ?></td>
                                <td><?php echo htmlspecialchars($student['nama']); ?></td>
                                <td><?php echo htmlspecialchars($student['email']); ?></td>
                                <td><?php echo htmlspecialchars($student['prodi']); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="<?php echo base_url('students/edit/' . $student['id']); ?>" class="btn btn-warning" style="padding: 5px 10px; font-size: 0.9em;">✏️ Edit</a>
                                        <a href="<?php echo base_url('students/delete/' . $student['id']); ?>" class="btn btn-danger" style="padding: 5px 10px; font-size: 0.9em;" onclick="return confirm('Yakin hapus?')">🗑️ Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <div class="info-box" style="margin-top: 30px;">
                <h4>📡 API Endpoints yang Tersedia (RESTful):</h4>
                <p>
                    <strong>GET</strong> <code><?php echo base_url('api/students'); ?></code> - Ambil semua mahasiswa<br>
                    <strong>GET</strong> <code><?php echo base_url('api/students/1'); ?></code> - Ambil mahasiswa ID 1<br>
                    <strong>GET</strong> <code><?php echo base_url('api/students/search?q=nama'); ?></code> - Cari mahasiswa<br>
                    <strong>POST</strong> <code><?php echo base_url('api/students/create'); ?></code> - Tambah mahasiswa (JSON)<br>
                    <strong>PUT</strong> <code><?php echo base_url('api/students/update/1'); ?></code> - Update mahasiswa (JSON)<br>
                    <strong>DELETE</strong> <code><?php echo base_url('api/students/delete/1'); ?></code> - Hapus mahasiswa
                </p>
            </div>
        </div>
    </div>
</body>
</html>
