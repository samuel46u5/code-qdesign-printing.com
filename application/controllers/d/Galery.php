<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Galery extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('html', 'date', 'form', 'url'));
        $this->load->model(array('M_galery'));
        $this->load->database();
    }

    // function f_upload_gallery()
    // {
    //     $id_galery = $this->M_galery->id_galery();
    //     var_dump($id_galery);
    //     die;
    //     $session = $this->session->userdata('iduser');
    //     $this->load->view('dashboard/galery/f_upload_galery_foto', $data);
    // }

    function add_galeryfoto()
    {
        $id_galery = $this->M_galery->id_galery();
        var_dump($id_galery);
        die;
        //     $session = $this->session->userdata('iduser');
        $this->load->view('dashboard/galery/f_upload_galery_foto');
    }
    function dataGaleryFoto()
    {
        $data['data'] = $this->M_galery->data_galery_foto_all()->result();
        $this->load->view('dashboard/galery/data_galery_foto', $data);
    }

    function dataGaleryVideo()
    {

        // $data['data'] = $this->M_contact->data_contact()->result();
        $data['aku'] = 'agus';
        $this->load->view('dashboard/galery/data_galery_video', $data);
    }
}
