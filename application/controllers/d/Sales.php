<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sales extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/Login');
        }
        $this->load->model(array('M_wishlist', 'M_order', 'M_invoice', 'M_company', 'M_product'));
        $this->load->database();
        $this->load->helper(array('date', 'url','download'));
        $this->load->library(array('session'));
    }

    function data_count_wishlist() {
        $data['data'] = $this->M_wishlist->data_count_wishlist()->result();
        $data['dataall'] = $this->M_wishlist->data_wishlist()->result();
        $this->load->view('dashboard/sales/data_wishlist', $data);
    }

    function data_order() {
        $status = $this->input->post('status');
        if (empty($status)) {
            $data['dataorder'] = $this->M_order->data_order()->result();
        } else {
            $data['dataorder'] = $this->M_order->data_order_by_status($status)->result();
        }
        $this->load->view('dashboard/sales/data_order_by_status', $data);
    }

    function detail_order() {
        $idorder = $this->input->post('id');
        $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($idorder)->row();
        $data['invoice'] = $this->M_invoice->data_invoice_by_id_order($idorder)->row();
        $data['orderresult'] = $this->M_order->data_order_id($idorder)->row();
        $data['detailorder'] = $this->M_order->data_order_detail_by_id($idorder)->result();
        $this->load->view('dashboard/sales/data_detail_order', $data);
    }

    function confirm_order() {
        $idorder = $this->input->post('id');
        $resi = $this->input->post('resi');
        $mailto = $this->input->post('email');
        $kurir = $this->input->post('kurir');
        $company = $this->M_company->data_company()->row();
        $subject = "Order " . $idorder . " Terkonfirmasi";
        $msg = "<p>Konfirmasi Order .</p><p><br></p><p>Order Anda Dengan Nomor Order " . $idorder . " Sudah Kita Proses.</p><p>Id Order : " . $idorder . "</p><p>nomor Resi : " . $resi . "<br></p><p>Jasa Kurir : " . $kurir . "<br></p><p>Cetak Invoice Anda klik link dibawah ini</p><p><a href='".base_url('d/Exportdata/export_invoice_pdf?idorder='.$idorder.'')."'><button style='background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Cetak Invoice</button></a></p><p><br></p><p><b>Terimakasih</b><br></p><p>$company->companyName<br>$company->address1<br>$company->phone1</p>";
        $datestring = '%Y-%m-%d %H:%i';
        $dataorder = array(
            'status' => 'process shiping',
            'verifyBy' => $this->session->userdata('iduser'),
            'dateVerify' => mdate($datestring)
        );
        $updateorder = $this->M_order->update_data_order($idorder, $dataorder);
        echo $updateorder;
        $datashiping = array(
            'receiptNumber' => $resi
        );
        $updateshiping = $this->M_order->update_data_order_shiping($idorder, $datashiping);
        echo $updateshiping;
        $datainvoice = array(
            'invoiceStatus' => 'process shiping'
        );
        $updateinvoice = $this->M_invoice->update_data_invoice($idorder, $datainvoice);
        $this->load->library('Mail_sender');
        $Mail = new Mail_sender;
        $loc = "back";
        $cc = "";
        $Mail->send($mailto, $subject, $msg, $loc, $cc);
    }

    function reject_restock_product() {
        $idorder = $this->input->post('id');
        $dataorderdetail = $this->M_order->data_detail_order_product($idorder)->result();
        $dataproduct = array();
        foreach ($dataorderdetail as $value) {
            if(($value->quantityStock-$value->productQty) < 1){$productstatus = "Out Of Stock";}else{$productstatus = "In Stock";}
            $arraytmp = array(
                'idproduct' => $value->idproduct,
                'quantityStock' => $value->quantityStock+$value->productQty,
                'productStatus' => $productstatus
            );
            array_push($dataproduct, $arraytmp);
        }
        $updatestock = $this->M_product->update_stock_product($dataproduct);
        $this->update_reject_order($idorder);
    }

    function update_reject_order($idorder){
        $dataorder = array(
            'status' => 'reject'
        );
        $updateorder = $this->M_order->update_data_order($idorder, $dataorder);

        $datainvoice = array(
            'invoiceStatus' => "reject"
        );
        $updateinvoice = $this->M_invoice->update_invoice($idorder, $datainvoice);
    }

    function count_new_order_unpaid(){
        echo $this->M_invoice->count_new_order_unpaid()->row();
    }

    function count_new_order_paid(){
        echo $this->M_order->count_new_order()->row();
    }

    function download_file_design(){
        $filename = $this->input->get('filename');
        $base = base_url('');
        $path = file_get_contents(''.$base.'/asset/img/uploads/filedesign/'.$filename.'');
        force_download($filename, $path);
    }
}