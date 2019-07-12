<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_contact extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function store_contact($data){
        $this->db->insert('t_contact', $data);
        $this->db->insert_id();
        $this->session->set_flashdata('MSG', '<script>swal("Suskes","Terimakasih, Telah mengirimkan pesan untuk kami", "success");</script>');
        redirect('pages/contact');
    }

    function delete_contact($id){
        $this->db->where('idcontact', $id);
        $this->db->delete('t_contact');
    }
   
    function delete_subscribe($id){
        $this->db->where('id', $id);
        $this->db->delete('t_email_subcribe');
    }

    function data_contact(){
        return $this->db->get('t_contact');
    }
    
    function contant_by_id($id){
        $this->db->where('idcontact', $id);
        return $this->db->get('t_contact');
    }
    
    function subcribe_by_id($id){
        $this->db->where('id', $id);
        return $this->db->get('t_email_subcribe');
    }

    function store_email_sub($data){
        $this->db->insert('t_email_subcribe', $data);
        $this->db->insert_id();
        $this->session->set_flashdata('MSG', '<script>swal("Suskes","Terimakasih, Telah bersedia mengikuti kami", "success");</script>');
        redirect(''.base_url().'');
    }

    function data_email_sub(){
        return $this->db->get('t_email_subcribe');
    }
}