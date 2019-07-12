<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Color extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/Login');
        }
        $this->load->model(array('M_color'));
        $this->load->library(array());
        $this->load->database();
    }
    
    function data_color(){
        $data['data'] = $this->M_color->data_color()->result();
        $this->load->view('dashboard/system/data_color', $data);
    }
    
    function update_color() {
        $id = $this->input->post('id');
        $data = array(
            'colorName' => $this->input->post('name')
        );
        $this->M_color->update_data_color($id, $data);
    }
    
    function f_store_color(){
        $this->load->view('dashboard/system/f_store_color');
    }
    
    function store_color() {
        $data = array(
            'colorName' => $this->input->post('name')
        );
        $this->M_color->store_color($data);
    }
}