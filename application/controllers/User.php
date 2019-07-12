<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'date', 'form', 'cookie'));
        $this->load->model(array('M_widget','M_company', 'M_design', 'M_product', 'M_category', 'M_daerah', 'M_partner', 'M_user', 'M_bank', 'M_invoice'));
        $this->load->library(array('session', 'Mail_sender', 'Generate_random'));
        $this->load->database();
    }

    function login() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Login / Masuk | ".$profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['provinsi'] = $this->M_daerah->getProv()->result();
        $data['partner'] = $this->M_partner->data_partner_ex_admin()->result();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/login', $data);
    }

    function store_user() {
        $email = $this->input->post('useremail');
        $cekemail = $this->M_user->cek_email($email)->row();
        $price = $this->input->post('partnerprice');
        if ($cekemail != NULL) {
            $this->session->set_flashdata('MSG', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Login Error!!!</strong> email ' . $email . ' Sudah terdaftar.</div>');
            redirect('User/login');
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
                'tipeuser' => $this->input->post('typeuser'),
                'userstatus' => "Inactive"
            );
            $this->M_user->store_user($data);
            if (empty($price)) {
                $this->session->set_flashdata('MSG', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Registrasi Sukses</strong> email ' . $email . ' Terdaftar.<br> cek email Anda untuk mengaktifkan Akun.</div>');
                $company = $this->M_company->data_company()->row();

                $mailto = $email;
                $subject = "Registrasi Akun " . $iduser . "";
                $msg = '<p><b>Selamat Bergabung Dengan Kami...</b><br></p><h2><u>Verifikasi Akun Anda</u></h2><p>Verifikasi Akun Anda</p><p>Nama :' . $this->input->post('username') . '</p><p>iduser : ' . $iduser . '<br></p><p>Password : ' . $this->input->post('password') . '</p><br><p>Silahkan Klik Button Di Bawah Ini</p><p><a href="' . base_url() . 'User/verificationaccount/?iduser=' . $iduser . '&token=' . md5($this->input->post('password')) . '"><button style="background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Verifikasi</button></a> <br></p><p><b>Terimakasih</b><br></p><p>' . $company->companyName . '<br>' . $company->address1 . '<br>' . $company->phone1 . '</p>';

                $this->load->library('Mail_sender');
                $Mail = new Mail_sender;
                $loc = "front";
                $cc = "";
                $Mail->send($mailto, $subject, $msg, $loc, $cc);
                redirect('pages/login');
            } else {
                $idinvoice = $this->M_invoice->generate_id_invoice_partner();
                $this->load->library('Generate_random');
                $rand = new Generate_random;
                $uniqcode = $rand->random_int(3);
                $datainvoice = array(
                    'idinvoicepartner' => $idinvoice,
                    'iduser' => $iduser,
                    'paymentMethod' => $this->input->post('bank'),
                    'invoicePartnerPrice' => $price + $uniqcode,
                    'invoicePartnerStatus' => "UNPAID",
                    'invoicePartnerDescription' => "Pembayaran Biaya Registrasi Akun",
                    'dateRegister' => mdate('%Y-%m-%d'),
                );
                $this->session->set_flashdata('MSG', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Registrasi Sukses</strong> email ' . $email . ' Terdaftar.<br> silahkan lanjutkan proses.</div>');
                $this->M_invoice->store_invoice_partner($datainvoice);
                redirect('pages/cart/cart-partner?idorder=' . $idinvoice . '&user=' . $iduser . '');
            }
        }
    }

    function do_login() {
        $email = $this->input->post('email');
        $pre_pass = $this->input->post('password');
        $pass = md5($pre_pass);

        $cek = $this->M_user->cek_user($email, $pass);
        if ($cek->num_rows() == 1) {
            if ($cek->row()->userStatus != "Active") {
                $this->session->set_flashdata('MSG', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Login Gagal, Email Anda '.$email.' Belum Aktif, Silahkan Hubungi CS kami.</div>');
            $this->login();
            } else {
                $sess_data = array(
                    'iduser' => $cek->row()->iduser,
                    'username' => $cek->row()->username,
                    'useremail' => $cek->row()->useremail,
                    'idpartner' => $cek->row()->idpartner,
                    'discountprice' => $cek->row()->partnerDiscountPrice,
                    'discountpercent' => $cek->row()->partnerDiscountPercent
                );
                $this->session->set_userdata($sess_data);
                if (empty($this->cart->total())) {
                    redirect('pages/product/search?category=0&price=asc&group=');
                } else {
                    redirect('pages/cart?idorder=' . $_SESSION['ordid'] . '');
                }
            }
        } else {
            $this->session->set_flashdata('MSG', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Login Gagal, Cek Email atau password Anda.</div>');
            $this->login();
        }
    }

    function logout() {
        $sess_data = array('iduser', 'username', 'useremail', 'idpartner', 'discountprice', 'discountpercent', 'tipeuser');
        $this->session->unset_userdata($sess_data);
        $this->remove_cart();
        $this->session->unset_userdata('idorder');
        redirect('pages/login');
    }

    function remove_cart() {
        $newarray = [];
        foreach ($this->cart->contents() as $key) {
            $tmp['rowid'] = $key['rowid'];
            $tmp['qty'] = 0;
            array_push($newarray, $tmp);
        }
        $this->cart->update($newarray);
    }

    function info_partner_by_id() {
        $id = $this->input->post('id');
        $data = $this->M_partner->data_partner_by_id($id)->row();
        if (!empty($data)) {
            echo '<div class="alert alert-info alert-dismissible">
            Syarat & Ketentuan Akun ' . $data->partnerName . ' Adalah ' . $data->partnerDescription . '</div>';
            echo '<input type="hidden" name="partnerprice" value="' . $data->partnerAmountCost . '">';
        }
    }

    function verificationaccount() {
        $iduser = $this->input->get('iduser');
        $token = $this->input->get('token');

        $datauser = $this->M_user->user_by_id($iduser)->row();
        if ($datauser->password != $token) {
            $data['title'] = "title";
            $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
            $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "");
            $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
            $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
            $data['profile'] = $this->M_company->data_company()->row();
            $data['provinsi'] = $this->M_daerah->getProv()->result();
            $data['partner'] = $this->M_partner->data_partner_ex_admin()->result();
            $this->session->set_flashdata('MSG', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Aktivasi Gagal, Token Aktivasi Salah.</div>');
            $data['header'] = $this->load->view('header', $data, TRUE);
            $data['footer'] = $this->load->view('footer', $data, TRUE);
            redirect('pages/login');
        } else {
            $data = array(
                'userStatus' => "Active"
            );
            $this->M_user->activation_user($iduser, $data);
            $this->session->set_flashdata('MSG', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Aktivasi Sukses, Silahkan login.</div>');
            redirect('pages/login');
        }
    }

    function f_reset_password() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Reset / Ubah Password | ".$profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/reset_password', $data);
    }

    function f_new_password() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Reset / Ubah Password | ".$profil->companyName;
        $id = $this->input->get('id');
        $data['user'] = $this->M_user->user_by_id($id)->row();
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/f_new_password', $data);
    }

    function do_reset_password() {
        $email = $this->input->post('email');
        $cek = $this->M_user->cek_email($email)->row();
        $company = $this->M_company->data_company()->row();

        if (empty($cek->useremail)) {
            $this->session->set_flashdata('MSG', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Gagal, Email tidak terdaftar dalam system kami.</div>');
            redirect('pages/reset-password');
        } else {
            $mailto = $email;
            $subject = "Reset Password " . $cek->iduser . "";
            $msg = '<p>Anda Akan Mengubah Password ' . $cek->iduser . '</p><p>silahkan Klik Link Berikut Ini.</p><p><a href="'.base_url('pages/create-new-password?id='.$cek->iduser.'&tk=' . $cek->password . '').'"><button style="background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Buat Password Baru</button></a></p><br></p><p><b>Terimakasih</b><br></p><p>' . $company->companyName . '<br>' . $company->address1 . '<br>' . $company->phone1 . '</p>';
            $this->load->library('Mail_sender');
            $Mail = new Mail_sender;
            $loc = "front";
            $cc = "";
            $Mail->send($mailto, $subject, $msg, $loc, $cc);
            $this->session->set_flashdata('MSG', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Permintaan Sukses, Silahkan Cek e-mail Anda untuk reset password.</div>');
            redirect('pages/reset-password');
        }
    }

    function do_create_new_password(){
        $token = $this->input->post('tk');
        $newpass = $this->input->post('newp');
        $id = $this->input->post('id');
        $cek = $this->M_user->user_by_id($id)->row();
        if($cek->password != $token){
            echo "0";
            $this->session->set_flashdata('MSG', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Gagal, Token Anda tidak sesuai.</div>');
        }else{
            $data = array(
                'password' => md5($newpass)
            );
            $this->M_user->update_user($id, $data);
            echo "1";
            $this->session->set_flashdata('MSG', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Reset Sukses, Silahkan login kembali.</div>');
        }
    }

}
