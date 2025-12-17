# 🧭 Alur Lengkap: MVC & API di Aplikasi Student Management

Dokumen ini menjelaskan bagaimana request diproses dari awal hingga menjadi response, baik untuk halaman web (MVC) maupun API (JSON), lengkap dengan cuplikan kode dari project ini.

---

## 📌 Gambaran Umum
- **Routes**: Menerjemahkan URL menjadi pemanggilan controller/method.
- **Controller**: Mengatur alur, mengambil input, memanggil `Model`, memilih `View` atau merespons JSON.
- **Model**: Berinteraksi dengan database (CRUD).
- **View**: Menyajikan HTML ke user (untuk web).
- **Output JSON**: Untuk API (tanpa View).

---

## 🖥️ Alur Web (MVC): Menampilkan Daftar Mahasiswa
Urutan saat user membuka `http://localhost/UAS_PW/students`:
1. User akses URL → Router mengarahkan ke `Student::index()`.
2. `Controller` memanggil `Student_model::get_all()` dan `count_total()`.
3. `Model` menjalankan query ke tabel `students`.
4. `Controller` mengirim data ke `View` `student/index.php`.
5. `View` merender tabel HTML berisi data mahasiswa.

### 1) Route sederhana
```php
// application/config/routes.php
$route['students'] = 'student/index';
$route['students/(:any)'] = 'student/$1';
$route['students/(:any)/(:num)'] = 'student/$1/$2';
```

### 2) Controller: ambil data & kirim ke view
```php
// application/controllers/Student.php
public function index() {
    $data['title'] = 'Daftar Mahasiswa';
    $data['students'] = $this->Student_model->get_all();
    $data['total'] = $this->Student_model->count_total();
    $this->load->view('student/index', $data);
}
```

### 3) Model: query ke database
```php
// application/models/Student_model.php
public function get_all() {
    $query = $this->db->get($this->table);
    return $query->result_array();
}

public function count_total() {
    return $this->db->count_all($this->table);
}
```

### 4) View: menampilkan tabel
```php
// application/views/student/index.php (cuplikan)
<?php if(empty($students)): ?>
  <p>Belum ada data.</p>
<?php else: ?>
  <table>
    <thead><tr><th>NIM</th><th>Nama</th><th>Email</th><th>Prodi</th></tr></thead>
    <tbody>
      <?php foreach($students as $s): ?>
        <tr>
          <td><?= htmlspecialchars($s['nim']) ?></td>
          <td><?= htmlspecialchars($s['nama']) ?></td>
          <td><?= htmlspecialchars($s['email']) ?></td>
          <td><?= htmlspecialchars($s['prodi']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
```

---

## 📡 Alur API: Mengembalikan JSON (tanpa View)
Contoh saat client memanggil `GET /student/api_get_all`:
1. Client akses URL → Router arahkan ke `Student::api_get_all()`.
2. `Controller` memanggil `Student_model::get_all()`.
3. `Controller` menulis response JSON via `Output`.

### Controller: endpoint API (GET all)
```php
// application/controllers/Student.php
public function api_get_all() {
    $students = $this->Student_model->get_all();
    $response = [
        'status' => true,
        'message' => 'Data berhasil diambil',
        'data' => $students,
        'total' => count($students)
    ];
    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
}
```

### Controller: endpoint API (GET by ID)
```php
public function api_get($id) {
    $student = $this->Student_model->get_by_id($id);
    if ($student) {
        $response = ['status'=>true,'message'=>'Data ditemukan','data'=>$student];
    } else {
        $response = ['status'=>false,'message'=>'Data tidak ditemukan','data'=>null];
        $this->output->set_status_header(404);
    }
    $this->output->set_content_type('application/json')
                 ->set_output(json_encode($response));
}
```

---

## ✍️ Alur CRUD "Create" (Web Form)
Urutan saat user submit form tambah mahasiswa:
1. User buka `GET /students/create` → tampil form.
2. Submit form ke `POST /students/store`.
3. `Controller::store()` ambil input, panggil `Model::insert()`.
4. Redirect ke `/students` dengan flash message.

### Controller: simpan data
```php
public function store() {
    $data = [
        'nama' => $this->input->post('nama'),
        'nim' => $this->input->post('nim'),
        'email' => $this->input->post('email'),
        'prodi' => $this->input->post('prodi'),
        'created_at' => date('Y-m-d H:i:s')
    ];
    if ($this->Student_model->insert($data)) {
        $this->session->set_flashdata('message','Mahasiswa berhasil ditambahkan');
        redirect('students');
    } else {
        $this->session->set_flashdata('error','Gagal menambahkan mahasiswa');
        redirect('students/create');
    }
}
```

### Model: insert
```php
public function insert($data) {
    return $this->db->insert($this->table, $data);
}
```

---

## 🔎 Alur CRUD "Search" (API)
Urutan saat client memanggil `GET /student/api_search?q=kata`:
1. `Controller::api_search()` baca query param `q`.
2. Panggil `Model::search($keyword)`.
3. Return JSON berisi hasil.

### Controller: search
```php
public function api_search() {
    $keyword = $this->input->get('q');
    if (!$keyword) {
        $this->output->set_status_header(400);
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(['status'=>false,'message'=>'Keyword wajib','data'=>null]));
    }
    $students = $this->Student_model->search($keyword);
    $response = ['status'=>true,'message'=>'Hasil pencarian','data'=>$students,'total'=>count($students)];
    $this->output->set_content_type('application/json')
                 ->set_output(json_encode($response));
}
```

### Model: search
```php
public function search($keyword) {
    $this->db->like('nama', $keyword);
    $query = $this->db->get($this->table);
    return $query->result_array();
}
```

---

## 🧪 Cara Mencoba
- Web UI: `http://localhost/UAS_PW/students`
- API (JSON):
  - `GET http://localhost/UAS_PW/student/api_get_all`
  - `GET http://localhost/UAS_PW/student/api_get/1`
  - `GET http://localhost/UAS_PW/student/api_search?q=budi`
  - `POST http://localhost/UAS_PW/student/api_create`
  - `PUT http://localhost/UAS_PW/student/api_update/1`
  - `DELETE http://localhost/UAS_PW/student/api_delete/1`

Contoh `curl`:
```bash
# Ambil semua data
curl http://localhost/UAS_PW/student/api_get_all

# Tambah data
curl -X POST http://localhost/UAS_PW/student/api_create \
 -H "Content-Type: application/json" \
 -d '{"nama":"Rudi","nim":"2024009","email":"rudi@mail.com","prodi":"TI"}'
```

---

## ✅ Ringkasan
- **MVC (Web)**: Route → Controller → Model → View → HTML
- **API (JSON)**: Route → Controller → Model → Output JSON
- Semua alur CRUD mengikuti pola yang sama: Controller mengkoordinasi, Model mengakses DB, dan output berupa HTML atau JSON.
