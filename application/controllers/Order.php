<?php

defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok');

class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_widget', 'M_company', 'M_bank', 'M_category', 'M_order', 'M_invoice', 'M_design', 'M_product', 'M_notify'));
        $this->load->database();
        $this->load->helper('url', 'date');
    }

    function form_track_order()
    {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Lacak Order Belanja | " . $profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "sale-noti", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/track_order', $data);
    }

    function track_order_result()
    {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Lacak Order Belanja | " . $profil->companyName;
        $idorder = $this->input->get('idorder');
        $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($idorder)->row();
        $data['orderresult'] = $this->M_order->data_order_id($idorder)->row();
        $data['detailorder'] = $this->M_order->data_order_detail_by_id($idorder)->result();
        $data['invoice'] = $this->M_invoice->data_invoice_by_id_order($idorder)->row();
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "sale-noti", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/track_order_result', $data);
    }

    function store_data_customer()
    {
        $idorderget = $this->input->get('idorder');
        $cek = $this->M_order->cek_order_id($idorderget)->row();
        $idpartner = $this->session->userdata('idpartner');

        if (empty($this->session->userdata('discountpercent'))) {
            $dis = $this->session->userdata('discountprice');
            $data = array();
            foreach ($this->cart->contents() as $value) {
                $temp = $value['qty'] * $dis;
                array_push($data, $temp);
            }
            $partnerdiscount = array_sum($data);
        } else {
            $disc = $this->session->userdata('discountpercent');
            $data2 = array();
            foreach ($this->cart->contents() as $value) {
                $temp = (($value['price'] * $disc) / 100) * $value['qty'];
                array_push($data2, $temp);
            }
            $partnerdiscount = array_sum($data2);
        }

        if ($cek->idorder == $idorderget) {
            $idorder = $idorderget;
        } else {
            $idorder = $this->M_order->generate_id_order();
        }

        $iduser = $this->session->userdata('iduser');
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $fulladdress = $this->input->post('fulladdress');
        $desa = $this->input->post('desa');
        $rt = $this->input->post('rt');
        $rw = $this->input->post('rw');
        $kecamatan = $this->input->post('kecamatan');
        $codeProvinsi = $this->input->post('provinsi');
        $codeKabupaten = $this->input->post('kabupaten');
        $postalcode = $this->input->post('postalcode');
        $custphone = $this->input->post('customerphone');
        $custemail = $this->input->post('customeremail');

        $data_oder = array(
            'idorder' => $idorder,
            'iduser' => $iduser,
            'idpartner' => $idpartner,
            'partnerDiscount' => $partnerdiscount,
            'orderSumary' => $this->cart->total() - $partnerdiscount,
            'status' => "insert data customer"
        );

        if ($cek->idorder == $idorderget) {
            $this->M_order->update_data_order($idorderget, $data_oder);
        } else {
            $this->M_order->store_order($data_oder);
        }

        $data_shiping = array(
            'idorder' => $idorder,
            'iduser' => $iduser,
            'firstName' => $firstname,
            'lastName' => $lastname,
            'Codeprovinsi' => $codeProvinsi,
            'Codekabupaten' => $codeKabupaten,
            'namaProvinsi' => $this->get_nama_provinsi($codeProvinsi),
            'namaKabupaten' => $this->get_nama_kota($codeKabupaten, $codeProvinsi),
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'rt' => $rt,
            'rw' => $rw,
            'kodePos' => $postalcode,
            'custEmail' => $custemail,
            'fullAddress' => $fulladdress,
            'custHp' => $custphone,
        );
        if ($cek->idorder == $idorderget) {
            $this->M_order->update_data_order_shiping($idorderget, $data_shiping);
        } else {
            $this->M_order->store_shiping($data_shiping);
        }
        redirect('pages/cart/shiping?idorder=' . $idorder . '');
    }

    function get_nama_provinsi($provinsi)
    {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $provinsiname = $rajaongkir->_api_ongkir('province?id=' . $provinsi . '');
        $data = json_decode($provinsiname, true);
        $result = json_encode($data['rajaongkir']['results']['province']);
        return str_replace('"', " ", $result);
    }

    function get_nama_kota($kota, $provinsi)
    {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $kotaname = $rajaongkir->_api_ongkir('city?id=' . $kota . '&province=' . $provinsi . '');
        $data = json_decode($kotaname, true);
        $result = json_encode($data['rajaongkir']['results']['city_name']);
        return str_replace('"', " ", $result);
    }

    function store_shiping()
    {
        $idorder = $this->input->get('idorder');
        $subtotal = $this->input->post('subtotal');
        $kurir = $this->input->post('kurir');
        $idpartner = $this->session->userdata('idpartner');

        if (empty($this->session->userdata('discountpercent'))) {
            $dis = $this->session->userdata('discountprice');
            $data = array();
            foreach ($this->cart->contents() as $value) {
                $temp = $value['qty'] * $dis;
                array_push($data, $temp);
            }
            $partnerdiscount = array_sum($data);
        } else {
            $disc = $this->session->userdata('discountpercent');
            $data2 = array();
            foreach ($this->cart->contents() as $value) {
                $temp = (($value['price'] * $disc) / 100) * $value['qty'];
                array_push($data2, $temp);
            }
            $partnerdiscount = array_sum($data2);
        }

        $tmpstr = $this->input->post('cost');
        $tmpexplode = explode("-", $tmpstr);
        $total = $subtotal + $tmpexplode[0];
        $data = array(
            'shipingCarge' => $tmpexplode[0],
            'shipingName' => "$kurir - $tmpexplode[1]",
            'totalPrice' => $total,
            'dropshipperName' => $this->input->post('dropshippername'),
            'dropshipperPhone' => $this->input->post('dropshipperphone'),
            'dropshipperAddress' => $this->input->post('dropshipperaddress'),
        );
        $update = $this->M_order->update_data_order_shiping($idorder, $data);
        $dataorder = array(
            'orderSumary' => $total - $partnerdiscount,
            'idpartner' => $idpartner,
            'partnerDiscount' => $partnerdiscount,
            'status' => "insert shiping"
        );
        $updateorder = $this->M_order->update_data_order($idorder, $dataorder);
        redirect('pages/cart/payment?idorder=' . $idorder . '');
    }

    function use_voucher()
    {
        $idorder = $this->input->post('idorder');
        $idvoucher = $this->input->post('idvoucher');
        $voucherprice = $this->input->post('voucherprice');
        $subtotal = $this->input->post('subtotal');

        $cekvoucher = $this->M_order->cek_order_id($idorder)->row();
        if ($cekvoucher->idvoucher == $idvoucher) {
            $this->session->set_flashdata('MSG', '<script>swal("Gagal", "Anda telah menggunakan voucher ini !", "error");</script>');
        } else {
            $dataorder = array(
                'idvoucher' => $idvoucher,
                'voucherprice' => $voucherprice,
                'orderSumary' => $subtotal - $voucherprice,
                'status' => "payment method"
            );
            $updateorder = $this->M_order->update_data_order($idorder, $dataorder);
            $this->session->set_flashdata('MSG', '<script>swal("Sukses", "voucher telah terpasang !", "success");</script>');
        }
    }

    function store_payment()
    {
        $idorder = $this->input->get('idorder');
        $idbank = $this->input->post('bank');

        $databank = $this->M_bank->data_bank_by_id($idbank)->row();
        $dataprofile = $this->M_company->data_company()->row();
        $cekinvoice = $this->M_invoice->data_invoice_by_id_order($idorder)->row();

        $datestring = '%Y-%m-%d %H:%i';
        $tanggalSekarang = date("Y-m-d H:i:s");
        $daysdue = date('Y-m-d H:i:s', strtotime('+' . $dataprofile->daysDue . ' hour', strtotime($tanggalSekarang)));

        $this->load->library('Generate_random');
        $rand = new Generate_random;
        $uniqcode = $rand->random_int(3);
        $ordersumary = ($this->input->post('ordersumary') + $uniqcode) - $this->input->post('voucher');

        $datashiping = array(
            'idbank' => $idbank
        );
        $updateshiping = $this->M_order->update_data_order_shiping($idorder, $datashiping);

        $dataorder = array(
            'orderSumary' => $ordersumary,
            'status' => 'closing unpaid'
        );
        $updateorder = $this->M_order->update_data_order($idorder, $dataorder);

        $datainvoice = array(
            'idorder' => $idorder,
            'bankAccountName' => $databank->accountName,
            'paymentMethod' => "$databank->bankName-$databank->accountNumber",
            'invoicePrice' => $ordersumary,
            'invoiceStatus' => "closing unpaid",
            'invoiceDate' => mdate($datestring),
            'dueDate' => $daysdue
        );
        if (empty($cekinvoice)) {
            $storeinvoice = $this->M_invoice->store_invoice($datainvoice);
        } else {
            $storeinvoice = $this->M_invoice->update_invoice($idorder, $datainvoice);
        }
        $this->update_stock_product($idorder);
        $this->store_reminder_orderin($idorder);
        redirect('pages/invoice?idorder=' . $idorder . '');
    }

    function update_stock_product($idorder)
    {
        $dataorderdetail = $this->M_order->data_detail_order_product($idorder)->result();
        $dataproduct = array();
        foreach ($dataorderdetail as $value) {
            if (($value->quantityStock - $value->productQty) < 1) {
                $productstatus = "Out Of Stock";
            } else {
                $productstatus = "In Stock";
            }
            $arraytmp = array(
                'idproduct' => $value->idproduct,
                'quantityStock' => $value->quantityStock - $value->productQty,
                'productStatus' => $productstatus
            );
            array_push($dataproduct, $arraytmp);
        }
        $this->M_product->update_stock_product($dataproduct);
    }

    function store_reminder_orderin($idorder)
    {
        $data = array(
            'notifyName' => 'Closing Unpaid',
            'idorder' => $idorder,
            'notifyStatus' => 0,
        );
        $this->M_notify->store_reminder_orderin($data);
    }
}
