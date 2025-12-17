<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Student - Controller untuk mengelola mahasiswa
 * Contoh MVC: Controller menghubungkan Model dan View
 * Juga menyediakan REST API endpoints
 */
class Student extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->helper('url');
    }

    /**
     * === BAGIAN WEB (Menampilkan view) ===
     */

    /**
     * Halaman utama - menampilkan daftar semua mahasiswa
     */
    public function index() {
        $data['title'] = 'Daftar Mahasiswa';
        $data['students'] = $this->Student_model->get_all();
        $data['total'] = $this->Student_model->count_total();

        $this->load->view('student/index', $data);
    }

    /**
     * Halaman tambah mahasiswa
     */
    public function create() {
        $data['title'] = 'Tambah Mahasiswa';
        $this->load->view('student/create', $data);
    }

    /**
     * Proses tambah mahasiswa dari form
     */
    public function store() {
        $data = array(
            'nama' => $this->input->post('nama'),
            'nim' => $this->input->post('nim'),
            'email' => $this->input->post('email'),
            'prodi' => $this->input->post('prodi'),
            'created_at' => date('Y-m-d H:i:s')
        );

        if ($this->Student_model->insert($data)) {
            $this->session->set_flashdata('message', 'Mahasiswa berhasil ditambahkan');
            redirect('student');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan mahasiswa');
            redirect('student/create');
        }
    }

    /**
     * Halaman edit mahasiswa
     */
    public function edit($id) {
        $data['title'] = 'Edit Mahasiswa';
        $data['student'] = $this->Student_model->get_by_id($id);

        if (!$data['student']) {
            show_404();
        }

        $this->load->view('student/edit', $data);
    }

    /**
     * Proses update mahasiswa dari form
     */
    public function update($id) {
        $data = array(
            'nama' => $this->input->post('nama'),
            'nim' => $this->input->post('nim'),
            'email' => $this->input->post('email'),
            'prodi' => $this->input->post('prodi'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        if ($this->Student_model->update($id, $data)) {
            $this->session->set_flashdata('message', 'Mahasiswa berhasil diperbarui');
            redirect('student');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui mahasiswa');
            redirect('student/edit/' . $id);
        }
    }

    /**
     * Proses hapus mahasiswa
     */
    public function delete($id) {
        if ($this->Student_model->delete($id)) {
            $this->session->set_flashdata('message', 'Mahasiswa berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus mahasiswa');
        }
        redirect('student');
    }

    /**
     * === BAGIAN API (Mengembalikan JSON) ===
     * API Endpoints untuk konsumsi client/aplikasi lain
     */

    /**
     * API: Ambil semua mahasiswa (GET: /api/student)
     */
    public function api_get_all() {
        $students = $this->Student_model->get_all();

        $response = array(
            'status' => true,
            'message' => 'Data berhasil diambil',
            'data' => $students,
            'total' => count($students)
        );

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    /**
     * API: Ambil mahasiswa berdasarkan ID (GET: /api/student/[id])
     */
    public function api_get($id) {
        $student = $this->Student_model->get_by_id($id);

        if ($student) {
            $response = array(
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $student
            );
        } else {
            $response = array(
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            );
            $this->output->set_status_header(404);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    /**
     * API: Cari mahasiswa (GET: /api/student/search?q=keyword)
     */
    public function api_search() {
        $keyword = $this->input->get('q');

        if (!$keyword) {
            $response = array(
                'status' => false,
                'message' => 'Keyword pencarian harus diisi',
                'data' => null
            );
            $this->output->set_status_header(400);
        } else {
            $students = $this->Student_model->search($keyword);
            $response = array(
                'status' => true,
                'message' => 'Hasil pencarian',
                'data' => $students,
                'total' => count($students)
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    /**
     * API: Tambah mahasiswa baru (POST: /api/student)
     */
    public function api_create() {
        $input = json_decode($this->input->raw_input_stream, true);

        // Validasi input
        if (!$input || !isset($input['nama']) || !isset($input['nim'])) {
            $response = array(
                'status' => false,
                'message' => 'Nama dan NIM harus diisi',
                'data' => null
            );
            $this->output->set_status_header(400);
        } else {
            $data = array(
                'nama' => $input['nama'],
                'nim' => $input['nim'],
                'email' => $input['email'] ?? '',
                'prodi' => $input['prodi'] ?? '',
                'created_at' => date('Y-m-d H:i:s')
            );

            if ($this->Student_model->insert($data)) {
                $response = array(
                    'status' => true,
                    'message' => 'Mahasiswa berhasil ditambahkan',
                    'data' => $data
                );
                $this->output->set_status_header(201);
            } else {
                $response = array(
                    'status' => false,
                    'message' => 'Gagal menambahkan mahasiswa',
                    'data' => null
                );
                $this->output->set_status_header(500);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    /**
     * API: Update mahasiswa (PUT: /api/student/[id])
     */
    public function api_update($id) {
        $student = $this->Student_model->get_by_id($id);

        if (!$student) {
            $response = array(
                'status' => false,
                'message' => 'Mahasiswa tidak ditemukan',
                'data' => null
            );
            $this->output->set_status_header(404);
        } else {
            $input = json_decode($this->input->raw_input_stream, true);

            $data = array(
                'nama' => $input['nama'] ?? $student['nama'],
                'nim' => $input['nim'] ?? $student['nim'],
                'email' => $input['email'] ?? $student['email'],
                'prodi' => $input['prodi'] ?? $student['prodi'],
                'updated_at' => date('Y-m-d H:i:s')
            );

            if ($this->Student_model->update($id, $data)) {
                $response = array(
                    'status' => true,
                    'message' => 'Mahasiswa berhasil diperbarui',
                    'data' => $data
                );
            } else {
                $response = array(
                    'status' => false,
                    'message' => 'Gagal memperbarui mahasiswa',
                    'data' => null
                );
                $this->output->set_status_header(500);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    /**
     * API: Hapus mahasiswa (DELETE: /api/student/[id])
     */
    public function api_delete($id) {
        $student = $this->Student_model->get_by_id($id);

        if (!$student) {
            $response = array(
                'status' => false,
                'message' => 'Mahasiswa tidak ditemukan',
                'data' => null
            );
            $this->output->set_status_header(404);
        } else {
            if ($this->Student_model->delete($id)) {
                $response = array(
                    'status' => true,
                    'message' => 'Mahasiswa berhasil dihapus',
                    'data' => null
                );
            } else {
                $response = array(
                    'status' => false,
                    'message' => 'Gagal menghapus mahasiswa',
                    'data' => null
                );
                $this->output->set_status_header(500);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
