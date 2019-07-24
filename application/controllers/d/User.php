<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/Login');
        }
        $this->load->model(array('M_daerah', 'M_user', 'M_partner', 'M_company'));
        $this->load->database();
    }

    function store_user()
    {
        $email = $this->input->post('email');
        $cekemail = $this->M_user->cek_email($email)->row();
        if ($cekemail != NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Pendaftaran Gagal, Email ' . $email . ' sudah terdaftar. <br> <a href="' . base_url('') . '">lupa password?</a>"</div>');
            redirect('d/User/login');
        } else {
            $iduser = $this->M_user->id_user();
            $prov = $this->M_daerah->getNamaProv($this->input->post('provinsi'))->row();
            $data = array(
                'iduser' => $iduser,
                'username' => $this->input->post('username'),
                'provinsi' => $prov->nama,
                'kabupaten' => $this->input->post('kabupaten'),
                'useremail' => $email,
                'password' => md5($this->input->post('password')),
                'userHp' => $this->input->post('userhp'),
                'tipeuser' => $this->input->post('tipeuser'),
                'userstatus' => "Inactive"
            );
            $this->M_user->store_user($data);
            redirect('d/User/login');
        }
    }

    function store_user_back()
    {
        $email = $this->input->post('email');
        $cekemail = $this->M_user->cek_email($email)->row();
        if ($cekemail != NULL) {
            echo "<script> $.notify({
                title: '<strong>Gagal</strong>',
                message: 'Member " . $email . "  Sudah Terdaftar'
                    }, { type: 'danger',animate: 
                    {enter: 'animated fadeInUp',
                    exit: 'animated fadeOutRight'
                    },placement: { from: 'top',align: 'right'
                    },offset: 20,delay: 3000,timer: 500, spacing: 10,z_index: 1031,
                    });
                    </script>";
        } else {
            $iduser = $this->M_user->id_user();
            $prov = $this->M_daerah->getNamaProv($this->input->post('provinsi'))->row();
            $data = array(
                'iduser' => $iduser,
                'username' => $this->input->post('username'),
                'provinsi' => $prov->nama,
                'kabupaten' => $this->input->post('kabupaten'),
                'useremail' => $email,
                'password' => md5($this->input->post('password')),
                'userHp' => $this->input->post('userhp'),
                'tipeuser' => $this->input->post('tipeuser'),
                'userstatus' => "Inactive"
            );
            $this->M_user->store_user($data);
            echo "<script> $.notify({
                title: '<strong>Sukses</strong>',
                message: 'Member " . $email . "  Terdaftar'
                    }, {
                    type: 'success',
                    animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    }, placement: {from: 'top',align: 'right'
                    }, offset: 20,delay: 3000, timer: 500, spacing: 10,z_index: 1031,
                    });
                    </script>";
        }
    }

    function data_user_all()
    {
        $data['data'] = $this->M_user->data_user_all()->result();
        $this->load->view('dashboard/partner/data_user', $data);
    }

    function update_status_user()
    {
        $id = $this->input->post('id');
        $data = array(
            'userStatus' => $this->input->post('status')
        );
        $this->M_user->update_user($id, $data);
    }

    function f_input_user()
    {
        $data['partner'] = $this->M_partner->data_partner_all()->result();
        $data['provinsi'] = $this->M_daerah->getProv()->result();
        $this->load->view('dashboard/partner/f_input_user', $data);
    }

    function delete_user()
    {
        $id = $this->input->post('id');
        $this->M_user->delete_user($id);
    }

    function update_user()
    {
        $id = $this->input->post('id');
        $data = array(
            'username' => $this->input->post('username'),
            'useremail' => $this->input->post('email'),
            'userHp' => $this->input->post('hp'),
            'tipeuser' => $this->input->post('tipeuser'),
            'password' => md5($this->input->post('password'))
        );
        $this->M_user->update_user($id, $data);
    }

    function user_by_id()
    {
        $id = $this->input->post('id');
        $data['data'] = $this->M_user->user_by_id($id)->row();
        $this->load->view('dashboard/profile/data_profile', $data);
    }
}
