<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Crm extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/Login');
        }
        $this->load->model(array('M_order', 'M_email_sender','M_user', 'M_wishlist', 'M_invoice', 'M_contact'));
        $this->load->library(array('Mail_sender'));
        $this->load->database();
    }
    
    function f_compose_email(){
        $this->load->view('dashboard/crm/f_compose_email');
    }

    function compose_email_by_idorder(){
        $id = $this->input->post('id');
        $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($id)->row();
        $data['invoice'] = $this->M_invoice->data_invoice_by_id_order($id)->row();
        $data['orderresult'] = $this->M_order->data_order_id($id)->row();
        $data['detailorder'] = $this->M_order->data_order_detail_by_id($id)->result();
        $data['data'] = $this->M_order->data_order_by_id($id)->row();
        $this->load->view('dashboard/crm/f_compose_email_by_idorder', $data);
    }
    
    function compose_email_by_iduser(){
        $id = $this->input->post('id');
        $data['data'] = $this->M_user->user_by_id($id)->row();
        $this->load->view('dashboard/crm/f_compose_email_by_iduser', $data);
    }

    function compose_email_by_wishlist(){
        $id = $this->input->post('id');
        $data['data'] = $this->M_wishlist->wish_by_id($id)->row();
        $this->load->view('dashboard/crm/f_compose_email_by_wishlist', $data);
    }

    function get_autocomplete_email(){
        if (isset($_GET['term'])) {
            $result = $this->M_email_sender->get_data_email_all($_GET['term'])->result();
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = $row->useremail;
                echo json_encode($arr_result);
            }
        }
    }

    function send_email(){
        $mailto = $this->input->post('email');
        $subject = $this->input->post('title');
        $msg = $this->input->post('pesan');
        $cc = $this->input->post('cc');
        $this->load->library('Mail_sender');
                $Mail = new Mail_sender;
                $loc = "back";
                $Mail->send($mailto, $subject, $msg, $loc, $cc);
    }
    
    function compose_email_by_idcontact(){
        $id = $this->input->post('id');
        $data['data'] = $this->M_contact->contant_by_id($id)->row();
        $this->load->view('dashboard/crm/f_compose_email_by_idcontact', $data);
    }
    
    function compose_email_by_idsubcribe(){
        $id = $this->input->post('id');
        $data['data'] = $this->M_contact->subcribe_by_id($id)->row();
        $this->load->view('dashboard/crm/f_compose_email_by_idsubscribe', $data);
    }
    
}