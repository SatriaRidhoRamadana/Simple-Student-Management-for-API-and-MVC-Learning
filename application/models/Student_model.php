<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Student_model - Model untuk mengelola data mahasiswa
 * Contoh MVC: Model menangani semua operasi database
 */
class Student_model extends CI_Model {

    private $table = 'students';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Mengambil semua data mahasiswa
     */
    public function get_all() {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * Mengambil data mahasiswa berdasarkan ID
     */
    public function get_by_id($id) {
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->row_array();
    }

    /**
     * Menambah data mahasiswa baru
     */
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Mengubah data mahasiswa
     */
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Menghapus data mahasiswa
     */
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    /**
     * Mencari mahasiswa berdasarkan nama
     */
    public function search($keyword) {
        $this->db->like('nama', $keyword);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * Menghitung total mahasiswa
     */
    public function count_total() {
        return $this->db->count_all($this->table);
    }
}
