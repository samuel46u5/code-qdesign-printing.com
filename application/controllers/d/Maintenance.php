<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Maintenance extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/Login');
        }
        $this->load->model(array('M_ads'));
        $this->load->database();
    }
    function list_exportdata(){
    	$this->load->view('dashboard/maintenance/list_exportdata');
    }
}
