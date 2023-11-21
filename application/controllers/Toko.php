<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('Madmin');
        $this->load->library('form_validation');
    }

    public function index(){
        $id = $this->session->userdata('idKonsumen');
        $dataWhere = array('idKonsumen' => $id);
        $data['kategori']=$this->Madmin->get_all_data('tbl_kategori')->result();
        $data['toko']=$this->Madmin->get_by_id('tbl_toko', $dataWhere)->result();
        
        $this->load->view('home/layout/header', $data);
        $this->load->view('home/toko/index', $data);
        $this->load->view('home/layout/footer');
    }

    public function add(){
        $data['kategori']=$this->Madmin->get_all_data('tbl_kategori')->result();
        $this->load->view('home/layout/header', $data);
        $this->load->view('home/toko/formAdd');
        $this->load->view('home/layout/footer');
    }

    public function save(){
        $id = $this->session->userdata('idKonsumen');
        $this->form_validation->set_rules('namaToko', 'Nama Toko', 'required', array('required'=>'<div class="alert alert-danger alert-dismissible fade show"><strong>Error! </strong>Nama Toko Tidak Boleh Kosong! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>'));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array('required'=>'<div class="alert alert-danger alert-dismissible fade show"><strong>Error! </strong>Deskripsi Tidak Boleh Kosong! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>'));
        if (empty($_FILES['logo']['name'])){
            $this->form_validation->set_rules('logo', 'Logo Toko', 'required', array('required'=>'<div class="alert alert-danger alert-dismissible fade show"><strong>Error! </strong>Logo Tidak Boleh Kosong! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>'));
        }

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form login dengan pesan error
            $this->load->view('home/layout/header', $data);
            $this->load->view('home/toko/formAdd');
            $this->load->view('home/layout/footer');
        } else{
            $nama_toko = $this->input->post('namaToko');
            $deskripsi = $this->input->post('deskripsi');
            $config['upload_path'] = './assets/logo_toko/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            
            $this->load->library('upload', $config);
            if($this->upload->do_upload('logo')){
                $data_file = $this->upload->data();
                $data_insert = array(
                                    'idKonsumen' => $id,
                                    'namaToko' => $nama_toko,
                                    'logo' => $data_file['file_name'],
                                    'deskripsi' => $deskripsi,
                                    'statusAktif' => 'Y');
                $this->Madmin->insert('tbl_toko', $data_insert);
                redirect('toko');
            } else {
                redirect('toko/add');
            }
        }
    }
    public function get_by_id($id){
        $dataWhere = array('idKonsumen'=>$id);
        $data['toko'] = $this->Madmin->get_by_id('tbl_toko', $dataWhere)->row_object();
        $data['kategori']=$this->Madmin->get_all_data('tbl_kategori')->result();

        $this->load->view('home/layout/header', $data);
        $this->load->view('home/toko/formEdit', $data);
        $this->load->view('home/layout/footer');
    }

    public function update(){
        $id = $this->input->post('idToko');
        $this->form_validation->set_rules('namaToko', 'Nama Toko', 'required', array('required'=>'<div class="alert alert-danger alert-dismissible fade show"><strong>Error! </strong>Nama Toko Tidak Boleh Kosong! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>'));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array('required'=>'<div class="alert alert-danger alert-dismissible fade show"><strong>Error! </strong>Deskripsi Tidak Boleh Kosong! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>'));
        if (empty($_FILES['logo']['name'])){
            $this->form_validation->set_rules('logo', 'Logo Toko', 'required', array('required'=>'<div class="alert alert-danger alert-dismissible fade show"><strong>Error! </strong>Logo Tidak Boleh Kosong! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>'));
        }

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form login dengan pesan error
            $data['toko'] = $this->Madmin->get_by_id('tbl_toko', array('idToko' => $id))->row();
            $this->load->view('home/layout/header', $data);
            $this->load->view('home/toko/formEdit', $data);
            $this->load->view('home/layout/footer');
        } else{
            $nama_toko = $this->input->post('namaToko');
            $deskripsi = $this->input->post('deskripsi');
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] != UPLOAD_ERR_NO_FILE) {
                $config['upload_path'] = './assets/logo_toko/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('logo')) {
                    $data_file = $this->upload->data();
                    $data_update = array(
                        'namaToko' => $nama_toko,
                        'logo' => $data_file['file_name'],
                        'deskripsi' => $deskripsi,
                        'statusAktif' => 'Y');
                    $this->Madmin->update('tbl_toko', $data_update, 'idToko', $id);
                    redirect('toko');
                } else {
                    redirect('toko/edit/' . $id);
                }
            } else {
                $data_update = array(
                    'namaToko' => $nama_toko,
                    'logo' => $data_file['file_name'],
                    'deskripsi' => $deskripsi,
                    'statusAktif' => 'Y');
                $this->Madmin->update('tbl_toko', $data_update, 'idToko', $id);
                redirect('toko');
            }
        }
    }
    public function delete($id){
        $dataWhere = array('idKonsumen'=>$id);
        $oldData = $this->Madmin->get_by_id('tbl_toko', $dataWhere)->row_object();
        $config['upload_path'] = './assets/logo_toko/';
        if(file_exists($config['upload_path'].$oldData->logo)) unlink($config['upload_path'].$oldData->logo);
        $this->Madmin->delete('tbl_toko', 'idKonsumen', $id);
        redirect('toko');
    }

}
?>