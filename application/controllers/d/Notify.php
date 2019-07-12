<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notify extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/Login');
        }
        $this->load->model(array('M_notify'));
        $this->load->library(array('session'));
        $this->load->helper(array('html', 'date', 'form', 'url'));
        $this->load->database();
    }

    function cek_order_unpaid(){
        $data = $this->M_notify->cek_order_unpaid()->row();
        if(empty($data->result)){
            echo "0";
        }else{
            echo $data->result;
        }
    }

    function cek_order_paid(){
        $data = $this->M_notify->cek_order_paid()->row();
        if(empty($data->result)){
            echo "0";
        }else{
            echo $data->result;
        }
    }

    function count_all_notify(){
         $data = $this->M_notify->count_all_notify()->row();
        if(empty($data->result)){
            echo "0";
        }else{
            echo $data->result;
        }
    }

    function data_all_notify(){
        $data['closingunpaid'] = $this->M_notify->cek_order_unpaid()->row();
        $data['closingpaid'] = $this->M_notify->cek_order_paid()->row();
        $this->load->view('dashboard/notify/data_notify', $data);
    }

    function data_notify_by_name(){
        $name = $this->input->post('name');
       $data['data'] = $this->M_notify->data_notify_by_name($name)->result();
       $this->load->view('dashboard/notify/notify_by_name', $data);
    }
    
    function update_status_notify(){
        $id = $this->input->post('id');
        $data = array(
            'notifyStatus' => 1
        );
        $this->M_notify->update_notify_by_idorder($id, $data);
    }
}