<?php

defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok');

class Invoice extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_notify', 'M_widget', 'M_company', 'M_design', 'M_category', 'M_invoice', 'M_user', 'M_bank', 'M_order'));
        $this->load->database();
        $this->load->library(array('session', 'image_lib', 'upload'));
        $this->load->helper(array('date', 'form', 'url', 'cookie'));
    }

    function index()
    {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Invoice Belanja | " . $profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "sale-noti", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/checkout', $data);
    }

    function invoice()
    {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Invoice Belanja | " . $profil->companyName;
        $idorder = $this->input->get('idorder');

        $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($idorder)->row();
        $data['orderresult'] = $this->M_order->data_order_id($idorder)->row();
        $data['detailorder'] = $this->M_order->data_order_detail_by_id($idorder)->result();
        $data['invoice'] = $this->M_invoice->data_invoice_by_id_order($idorder)->row();

        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "sale-noti", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/invoice', $data);
    }

    function update_bank_invoice_partner()
    {
        $idinvoice = $this->input->post('idinvoicepartner');
        $iduser = $this->input->post('iduser');
        $idbank = $this->input->post('bank');
        $databank = $this->M_bank->data_bank_by_id($idbank)->row();
        $curentdate = mdate('%Y-%m-%d');

        $data = array(
            'paymentMethod' => $databank->bankName . "-" . $databank->accountNumber,
            'bankName' => $databank->accountName,
            'dateRegister' => $curentdate,
            'dueDate' => mdate('%Y-%m-%d', strtotime('7 days', strtotime($curentdate)))
        );
        $this->M_invoice->update_bank_invoice_partner($idinvoice, $data);
        redirect('pages/invoice/invoice-partner/?idorder=' . $idinvoice . '&user=' . $iduser . '');
        echo $this->image_lib->display_errors();
        echo $this->upload->display_errors();
    }

    function invoice_partner()
    {
        $idorder = $this->input->get('idorder');
        $iduser = $this->input->get('user');
        $data['title'] = "title";
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "sale-noti", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['user'] = $this->M_user->user_by_id($iduser)->row();
        $data['invoice'] = $this->M_invoice->invoice_partner_by_id($idorder)->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/invoice_partner', $data);
    }

    function konfirmasi_pembayaran_partner()
    {
        $idinvoice = $this->input->post('idinvoice');
        $iduser = $this->input->post('iduser');

        $config['upload_path'] = './asset/img/uploads/buktitransfer/';
        $nmfile = "ft_" . $idinvoice . " ";
        $config['allowed_types'] = "*";
        $config['file_name'] = $nmfile;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if (!empty($_FILES['slip']['name'])) {
            if ($this->upload->do_upload('slip')) {
                $c = $this->upload->data();
                $configer = array(
                    'image_library' => 'gd2',
                    'source_image' => './asset/img/uploads/buktitransfer/' . $c['file_name'],
                    'maintain_ratio' => TRUE,
                    'maintain_ratio' => TRUE,
                    'quality' => '90%',
                    'new_image' => './asset/img/uploads/buktitransfer/' . $c['file_name'],
                    'source_image' => './asset/img/uploads/buktitransfer/' . $c['file_name']
                );
                $this->load->library('image_lib', $configer);
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();

                echo $this->image_lib->display_errors();
                echo $this->upload->display_errors();
            }

            echo $this->image_lib->display_errors();
            echo $this->upload->display_errors();

            $data = array(
                'paymentImage' => $c['file_name'],
                'invoicePartnerStatus' => "PAID",
                'bankNameSender' => $this->input->post('bankname'),
                'accountNameSender' => $this->input->post('accountname'),
                'dueDate' => "null"
            );
            $this->M_invoice->update_bank_invoice_partner($idinvoice, $data);
            $this->session->set_flashdata('MSG', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Konfirmasi Sukses, Transaksi Anda akan di cek Admin Terlebih dahulu.</div>');
            redirect('pages/invoice/invoice-partner/?idorder=' . $idinvoice . '&user=' . $iduser . '');
        }
    }

    function form_confirm_payment()
    {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Konfirmasi Pembayaran Belanja | " . $profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "sale-noti", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['bank'] = $this->M_bank->data_bank()->result();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/confirm_payment', $data);
    }

    function confirm_payment_order()
    {
        $datestring = '%Y-%m-%d %H:%i';
        $idorder = $this->input->post('idorder');

        $config['upload_path'] = './asset/img/uploads/buktitransfer/';
        $nmfile = "ft_" . $idorder . " ";
        $config['allowed_types'] = "*";
        $config['file_name'] = $nmfile;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if (!empty($_FILES['slip']['name'])) {
            if ($this->upload->do_upload('slip')) {
                $c = $this->upload->data();
                $configer = array(
                    'image_library' => 'gd2',
                    'source_image' => './asset/img/uploads/buktitransfer/' . $c['file_name'],
                    'maintain_ratio' => TRUE,
                    'maintain_ratio' => TRUE,
                    'quality' => '90%',
                    'new_image' => './asset/img/uploads/buktitransfer/' . $c['file_name'],
                    'source_image' => './asset/img/uploads/buktitransfer/' . $c['file_name']
                );
                $this->load->library('image_lib', $configer);
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();

                echo $this->image_lib->display_errors();
                echo $this->upload->display_errors();
            }

            echo $this->image_lib->display_errors();
            echo $this->upload->display_errors();

            $data = array(
                'paymentImage' => $c['file_name'],
                'invoiceStatus' => "PAID",
                'dateConfirmPayment' => mdate($datestring),
                'dueDate' => "null"
            );
            $updateinvoice = $this->M_invoice->update_invoice($idorder, $data);
            $dataorder = array(
                'status' => 'closing paid'
            );
            $updateorder = $this->M_order->update_data_order($idorder, $dataorder);
            $this->session->set_flashdata('MSG', '<script>swal("Terimakasih", "Order ' . $idorder . ' akan segera kami proses !", "success");</script>');
            $this->remove_cart();
            $this->session->unset_userdata('idorder');

            $company = $this->M_company->data_company()->row();

            $mailto = $company->email;
            $subject = "Order Masuk sudah Transfer";
            $msg = '<p><b>Order Masuk sudah transfer</b><br></p><p>Order masuk dengan ID Order ' . $idorder . ' <br> Silahkan Proses di menu Sales > Order Masuk </p>';

            $this->load->library('Mail_sender');
            $Mail = new Mail_sender;
            $loc = "front";
            $cc = "";
            $Mail->send($mailto, $subject, $msg, $loc, $cc);
            $this->store_reminder_orderin($idorder);
            redirect('pages/invoice/?idorder=' . $idorder . '');
        }
    }

    function remove_cart()
    {
        $newarray = [];
        foreach ($this->cart->contents() as $key) {
            $tmp['rowid'] = $key['rowid'];
            $tmp['qty'] = 0;
            array_push($newarray, $tmp);
        }
        $this->cart->update($newarray);
    }

    function store_reminder_orderin($idorder)
    {
        $data = array(
            'notifyName' => 'Closing Paid',
            'idorder' => $idorder,
            'notifyStatus' => 0,
        );
        $ceknotify = $this->M_notify->notify_by_idorder($idorder)->row();
        if ($ceknotify->notifyStatus == 0) {
            $this->M_notify->update_notify_by_idorder($idorder, $data);
        } else {
            $this->M_notify->store_reminder_orderin($data);
        }
    }
}
