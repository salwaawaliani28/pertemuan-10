<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Buku extends CI_Controller
{
 public function __construct()
 {
 parent::__construct();
 cek_login();
 }

    public function ubahKategori()
    {
        $data['judul'] = 'Ubah Data Kategori';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelBuku->kategoriWhere(['id' => $this->uri->segment(3)])->result_array();

        $this->form_validation->set_rules('kategori', 'Nama Kategori', 'required|min_length[3]', ['required' => 'Nama Kategori Harus Diisi', 'min_length' => 'Nama Kategori Terlalu Pendek'
    ]);

    if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('buku/ubah_kategori', $data);
        $this->load->view('templates/footer', $data);
    } else {

        $data = [
            'kategori' => $this->input->post('kategori', true)
        ];

        $this->ModelBuku->updateKategori(['id' => $this->input->post('id')], $data);
        redirect('buku/kategori');
    }
    }
}