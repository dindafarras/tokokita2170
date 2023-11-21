<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class EditProfilMember extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Madmin');
    }
    public function index(){
        $data['member'] = $this->Madmin->get_by_id('tbl_member', array('idKonsumen' => $this->session->userdata('idKonsumen')))->row();
        $data['kategori']=$this->Madmin->get_all_data('tbl_kategori')->result();
        
        $this->load->view('home/layout/header', $data);
        $this->load->view('home/editProfilMember/formEditMember', $data);
        $this->load->view('home/layout/footer');
    }
    public function save(){
        $id = $this->session->userdata('idKonsumen');
        $password = $this->input->post('password');
        $username = $this->input->post('username');
        $namaKonsumen = $this->input->post('namaKonsumen');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');
        $telepon = $this->input->post('tlpn');
        if($password != ""){
            $dataUpdate = array(
                'username' => $username, 
                'password' => password_hash($password, PASSWORD_DEFAULT), 
                'namaKonsumen' => $namaKonsumen,
                'alamat' => $alamat, 
                'email' => $email, 
                'tlpn' => $telepon, 
            );
            $this->Madmin->update('tbl_member', $dataUpdate, 'idKonsumen', $id);
        }else{
            $dataUpdate = array(
                'username' => $username, 
                'namaKonsumen' => $namaKonsumen,
                'alamat' => $alamat, 
                'email' => $email, 
                'tlpn' => $telepon, 
            );
            $this->Madmin->update('tbl_member', $dataUpdate, 'idKonsumen', $id);
        }
        
        redirect('EditProfilMember');
    }
}

?>