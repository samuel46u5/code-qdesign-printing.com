<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_widget', 'M_company', 'M_design', 'M_product', 'M_category', 'M_user', 'M_contact', 'M_ads'));
        $this->load->database();
    }

    function home()
    {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = $profil->tagcompanyDescription . " | " . $profil->companyName;
        $data['activemenu'] = array('home' => "sale-noti", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['datapopup'] = $this->M_design->data_popup_by_status("Active")->row();
        $data['bannerhome'] = $this->M_design->data_banner_by_pos("bannerhome")->result();
        $data['bannerftop'] = $this->M_design->data_banner_by_pos("featuretop")->result();
        $data['bannerfbottom'] = $this->M_design->data_banner_by_pos("featurebottom")->result();
        $data['newarrival'] = $this->M_product->data_product_newarival()->result();
        $data['productsale'] = $this->M_product->data_product_sale()->result();
        $data['productbest'] = $this->M_product->data_product_bestseller()->result();
        $data['footertagline'] = $this->M_design->data_footer_tagline()->result();
        $data['fbpixel'] = $this->M_ads->data_ads_by_name_active("FB Pixel")->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['lastsale'] = $this->M_product->lastSale()->row();
        $data['header_home'] = $this->load->view('header_home', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/home', $data);
    }

    function cart()
    {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Keranjang Belanja | " . $profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['activemenu'] = array('home' => "", 'product' => "sale-noti", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/cart', $data);
    }

    function checkout()
    {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Checkout Belanja | " . $profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/v_checkout', $data);
    }

    function checkout_method()
    {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Checkout Belanja | " . $profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/v_checkout_method', $data);
    }

    function about()
    {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Tentang Kami | " . $profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "sale-noti", 'contact' => "");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/about', $data);
    }

    function contact()
    {
        $profil = $this->M_company->data_company()->row();
        $data['title'] = "Pusat Bantuan | " . $profil->companyName;
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['bannertitlepage'] = $this->M_design->data_banner_by_pos("bannertitlepage")->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "sale-noti");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/contact', $data);
    }

    function store_contact()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'message' => $this->input->post('message')
        );
        $this->M_contact->store_contact($data);
    }

    function data_profile_partner()
    {
        $id = $this->session->userdata('iduser');
        $data['title'] = "contact";
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['icontitle'] = $this->M_design->data_banner_by_pos("icontitle")->row();
        $data['user'] = $this->M_user->user_by_id($id)->row();
        $data['activemenu'] = array('home' => "", 'product' => "", 'cart' => "", 'trackorder' => "", 'payment' => "", 'sale' => "", 'about' => "", 'contact' => "sale-noti");
        $data['menucategory'] = $this->M_category->tree_menu_home(0, "");
        $data['menucategorymobile'] = $this->M_category->tree_menu_mobile(0, "");
        $data['profile'] = $this->M_company->data_company()->row();
        $data['chatbutton'] = $this->M_widget->data_widget_by_name_active("Chat Button")->row();
        $data['header'] = $this->load->view('header', $data, TRUE);
        $data['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('frontend/profile', $data);
    }

    function store_email_sub()
    {
        $data = array('email' => $this->input->post('email'));
        $this->M_contact->store_email_sub($data);
    }

    function search_global()
    {
        echo $this->M_product->fetch_data_autocomplete($this->uri->segment(3));
    }

    function galery()
    {
        $this->load->view('frontend/galery');
    }
}
