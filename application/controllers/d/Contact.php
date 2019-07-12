<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contact extends CI_Controller {
    public function __construct() {
        parent::__construct();
         if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/Login');
        }
        $this->load->model(array('M_contact'));
        $this->load->database();
    }

    function data_contact(){
        $data['data'] = $this->M_contact->data_contact()->result();
        $this->load->view('dashboard/contact/data_contact', $data);
    }

    function data_email_sub(){
    	$data['data'] = $this->M_contact->data_email_sub()->result();
        $this->load->view('dashboard/contact/data_email_sub', $data);
    }
    
    function delete_contact_by_id(){
        $id = $this->input->post('id');
        $this->M_contact->delete_contact($id);
    }
    
    function delete_subcribe_by_id(){
        $id = $this->input->post('id');
        $this->M_contact->delete_subscribe($id);
    }
}
