<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_company', 'M_design', 'M_product', 'M_category', 'M_ads', 'M_widget', 'M_cs'));
        $this->load->database();
        $this->load->library(array('Ajax_pagination', 'user_agent'));
        $this->perPage = 3;
    }

    function detail_product($slug) {
        $productdetail = $this->M_product->data_detail_product_by_slug($slug)->row();
        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser() . ' ' . $this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Produk " . $productdetail->productName . " | " . $profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['activemenu'] = array('home' => "", 'product' => "sale-noti", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['category'] = $this->M_category->get_category_product(0, "");
        $data['breadcrumb'] = $this->M_category->get_breadcrumb($productdetail->idcategory);
        $data['profile'] = $this->M_company->data_company()->row();
        $data['productdetail'] = $this->M_product->data_detail_product_by_slug($slug)->row();
        $data['datamultilevel'] = $this->M_product->data_multilevel_by_id($productdetail->idp)->result();
        $data['productfoto'] = $this->M_product->data_foto_by_slug($slug)->result();
        $data['relateproduct'] = $this->M_product->data_relateproduct($productdetail->idcategory, $slug)->result();
        $data['fbpixel'] = $this->M_ads->data_ads_by_name_active("FB Pixel")->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['sharebutton'] = $this->M_widget->data_widget_by_name_active("Share Button")->row();
        $data['fbcomment'] = $this->M_widget->data_widget_by_name_active("Facebook Comment")->row();
        $data['orderwa'] = $this->M_widget->data_widget_by_name_active("Order Via WhatsApp")->row();

        $data['useragent'] = $this->agent->platform();
        $data['cs'] = $this->M_cs->data_cs_count_asc()->row();
        $data['header_detail'] = $this->load->view('header_detail', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/detail_product', $data);
    }

    function all_product() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = $profil->tagcompanyDescription . " | " . $profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "sale-noti", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['category'] = $this->M_category->get_category_product(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['product'] = $this->M_product->data_product_all()->result();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/product', $data);
    }

    function product_by_link($link) {
        $data['title'] = "title";
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "sale-noti", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['category'] = $this->M_category->get_category_product(0, "");
        $data['profile'] = $this->M_company->data_company()->row();

        $cekparent = $this->M_category->get_id_parent_by_link($link)->row();
        $data['product'] = $this->all($cekparent->idcategory);
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/product', $data);
    }

//    function a1($parent, $hasil) {
//        $w = $this->db->query("SELECT * from t_category where idparent='" . $parent . "'");
//        foreach ($w->result() as $h) {
//            $hasil = $this->a1($h->idcategory, $hasil);
//            $hasil .= $h->idcategory;
//            $hasil .= ",";
//        }
//        return $hasil;
//    }

    function search() {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = $profil->tagcompanyDescription . " | " . $profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "sale-noti", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['category'] = $this->M_category->get_category_product(0, "");
        $data['categoryslide'] = $this->M_category->get_category_by_parent("0")->result();
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/product', $data);
    }
    
    function search_product(){
       $profil = $this->M_company->data_company()->row();
        $data['title'] = $profil->tagcompanyDescription . " | " . $profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "sale-noti", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['category'] = $this->M_category->get_category_product(0, "");
        $data['categoryslide'] = $this->M_category->get_category_by_parent("0")->result();
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/product_search', $data);  
    }

    function breadcrumb(){
        $id = $this->input->post('category');
        echo $this->M_category->get_breadcrumb($id);
    }

    function count_product_result(){
        $id = $this->input->post('category');
        $group = $this->input->post('group');
        echo $this->M_product->count_product_result($id, $group)->row()->result;
    }
    function count_search_result(){
        $productname = $this->input->post('product');
        echo $this->M_product->count_search_result($productname)->row()->result;
    }

    function fetch() {
        $str = "'";
        $output = '';
        $data = $this->M_product->fetch_data($this->input->post('limit'), $this->input->post('start'), $this->input->post('category'), $this->input->post('price'), $this->input->post('group'));
        if (empty($data)) {
            $output .= ' <div class="col-sm-6 col-md-6 col-lg-4 p-b-50">';
            $output .= 'Maaf Data Kosong';
            $output .= ' </div>';
        } elseif ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= ' <div class="col-sm-6 col-md-6 col-lg-4 p-b-50">
                <div class="block2">';
                $output .= ($row->pricesale != "") ?
                '<div class="block2-img wrap-pic-w hov-img-zoom of-hidden pos-relative block2-labelsale">
                <span class="sale-precent-blok">'.floor(($row->price-$row->pricesale)/$row->price*100).'% OFF</span>
                ' : '<div class="block2-img wrap-pic-w hov-img-zoom of-hidden pos-relative block2-labelnew">';
                $output .= '<img src="' . site_url('asset/img/uploads/product/' . $row->fotoName . '') . '" class="bo18" alt="'.$row->productName.'">
                <div class="block2-overlay trans-0-4">
                <div class="block2-btn-addcart w-size1 trans-0-4">
                <button onclick="window.location.href=' . $str . '' . base_url('pages/product-detail/' . $row->postSlug . '') . '' . $str . '" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                Beli
                </button>
                </div>
                </div>
                </div>';
                $output .= ' <div class="block2-txt p-t-20">
                <a href="' . base_url('pages/product-detail/' . $row->postSlug . '') . '" class="block2-name dis-block s-text3 p-b-5">
                ' . $row->productName . '
                </a>';
                $output .= ($row->pricesale != "") ?
                '
                <div class="text-center">
                <span class="block2-oldprice m-text7 text-center">
                Rp.  ' . number_format($row->price) . '
                </span>
                <span class="block2-newprice m-text8 text-center">
                Rp. ' . number_format($row->pricesale) . ' 
                </span>
                </div>' :
                '<div class="text-center">
                <span class="block2-price m-text6 text-center">
                Rp.  ' . number_format($row->price) . '
                </span>
                </div>';
                $output .= ' </div>
                </div>
                </div>';
            }
            echo $output;
        }
    }
        
    function fetch_search() {
        $str = "'";
        $output = '';
        $data = $this->M_product->fecth_data_search($this->input->post('limit'), $this->input->post('start'), $this->input->post('productname'));
        if ($data->num_rows() == 0) {
            // $output .= ' <div class="col-sm-6 col-md-6 col-lg-4 p-b-50">';
            // $output .= 'Maaf Data Kosong';
            $output .= '0';
            // $output .= ' </div>';
        } else if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= ' <div class="col-sm-6 col-md-6 col-lg-4 p-b-50">
                <div class="block2">';
                $output .= ($row->pricesale != "") ?
                '<div class="block2-img wrap-pic-w hov-img-zoom of-hidden pos-relative block2-labelsale">
                <span class="sale-precent-blok">'.floor(($row->price-$row->pricesale)/$row->price*100).'% OFF</span>
                ' : '<div class="block2-img wrap-pic-w hov-img-zoom of-hidden pos-relative block2-labelnew">';
                $output .= '<img src="' . site_url('asset/img/uploads/product/' . $row->fotoName . '') . '" class="bo18" alt="'.$row->productName.'">
                <div class="block2-overlay trans-0-4">
                <div class="block2-btn-addcart w-size1 trans-0-4">
                <button onclick="window.location.href=' . $str . '' . base_url('pages/product-detail/' . $row->postSlug . '') . '' . $str . '" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                Beli
                </button>
                </div>
                </div>
                </div>';
                $output .= ' <div class="block2-txt p-t-20">
                <a href="' . base_url('pages/product-detail/' . $row->postSlug . '') . '" class="block2-name dis-block s-text3 p-b-5">
                ' . $row->productName . '
                </a>';
                $output .= ($row->pricesale != "") ?
                '
                <div class="text-center">
                <span class="block2-oldprice m-text7 text-center">
                Rp.  ' . number_format($row->price) . '
                </span>
                <span class="block2-newprice m-text8 text-center">
                Rp. ' . number_format($row->pricesale) . ' 
                </span>
                </div>' :
                '<div class="text-center">
                <span class="block2-price m-text6 text-center">
                Rp.  ' . number_format($row->price) . '
                </span>
                </div>';
                $output .= ' </div>
                </div>
                </div>';
            }
        }
        echo $output;
    }
    
    function cek_qty() {
        $id = $this->input->post('id');
        $product = $this->M_product->product_by_id($id)->row();
        echo $product->quantityStock;
    }

    function search_code_voucher() {
        $curdate = mdate('%Y-%m-%d');
        $code = $this->input->post('voucher');
        $totalprice = $this->input->post('totalprice');
        $data = $this->M_voucher->get_voucher_by_code($code)->row();
        if (empty($data)) {
            $result = "<small style='color:red;'>Maaf, code voucher tidak di temukan</small>";
        }elseif($data->endDate < $curdate){
            $result = "<small style='color:red;'>Maaf, code voucher tidak di temukan atau sudah kadaluarsa</small>";
        }elseif($totalprice < $data->minTransaction){
            $result = "<small style='color:red;'>Maaf, Anda tidak dapat menggunakan voucher ini. Belanja minimum Rp. ".number_format($data->minTransaction)." <br>Total belanja Anda Rp. ".number_format($totalprice)."</small>";
        }else {
            $str = "'";
            $result = '<div class="bo21 p-l-10 p-t-10 p-r-10 p-b-10 fs-13">'
                    . 'Selamat, Voucher ' . $data->voucherName . '(' . $data->voucherCode . ') Tersedia <br>'
                    . 'Anda hemat s/d Rp. ' . number_format($data->voucherPrice) . ''
                    . '</div>'
                    . '<button class="btn-sm btn-block bg-hover-brown fs-13" onclick="useVoucher(' . $str . '' . $data->voucherPrice . '' . $str . ',' . $str . '' . $data->idvoucher . '' . $str . ');">Gunakan Voucher ini</button>';
        }
        echo $result;
    }

}
