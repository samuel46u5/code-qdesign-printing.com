<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_daerah', 'M_user', 'M_partner', 'M_company'));
        $this->load->database();
    }

    function index(){
        $this->f_login();
    }

    function f_login() {
        $data['profile'] = $this->M_company->data_company()->row();
        $this->load->view('dashboard/login', $data);
    }

    function do_login() {
        $email = $this->input->post('email');
        $pre_pass = $this->input->post('password');
        $pass = md5($pre_pass);

        $cek = $this->M_user->cek_user($email, $pass);
        if ($cek->num_rows() == 1) {
            if ($cek->row()->userStatus != "Active") {
                $this->session->set_flashdata('MSG', 'Login Gagal","data user ' . $email . ' belum aktif');
                redirect('d/User/f_login');
            } elseif ($cek->row()->tipeuser != "1") {
                $this->session->set_flashdata('MSG', 'Login Gagal","data user ' . $email . ', tidak memiliki akses ke dashboard');
                redirect('d/User/f_login');
            } else {
                $sess_data = array(
                    'iduser' => $cek->row()->iduser,
                    'username' => $cek->row()->username,
                    'useremail' => $cek->row()->useremail,
                    'tipeuser' => $cek->row()->tipeuser
                );
                $this->session->set_userdata($sess_data);
                redirect('d/Home/');
            }
        } else {
            $this->session->set_flashdata('MSG', 'Login Gagal, Cek e-mail atau password Anda');
            redirect('d/User/f_login');
        }
    }

    function logout() {
        $this->session->unset_userdata('iduser');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('useremail');
        $this->session->unset_userdata('tipeuser');
        session_destroy();
        redirect('d/Login/f_login');
    }
}
