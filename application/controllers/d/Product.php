<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('iduser') == "" && $this->session->userdata('tipeuser') != "1") {
            $this->session->set_flashdata('MSG', 'Login Gagal <br> Anda tidak memiliki akses ke dashboard');
            redirect('d/Login');
        }
        $this->load->model(array('M_product', 'M_category'));
        $this->load->library(array('session', 'image_lib', 'upload'));
        $this->load->helper(array('html', 'date', 'form', 'url'));
        $this->load->database();
    }

    function f_upload() {
        $idproduct = $this->M_product->id_product();
        $session = $this->session->userdata('iduser');
        $cektemp = $this->M_product->data_temp_idupload_temp($session, "temp");
        if ($cektemp->num_rows() > 0) {
            $data['idproduct'] = $cektemp->row()->idproduct;
            $data['session'] = $session;
        } else {
            $data['idproduct'] = $this->M_product->id_product();
            $data['session'] = $this->session->userdata('iduser');
            $this->temp_upload_product($idproduct, $idproduct . $session, $session);
        }
        $data['category'] = $this->M_category->get_select_category(0, "");
        $this->load->view('dashboard/product/f_upload_product', $data);
    }

    function do_upload_product() {
        $idProduct = $this->input->post('idproduct');
        $idUpload = $this->input->post('idupload');
        $session = $this->session->userdata('iduser');
        $multilevelstatus = $this->input->post('multilevelstatus');
        $rangestart = $this->input->post('rangestart');
        $rangeend = $this->input->post('rangeend');
        $multilevelprice = $this->input->post('multilevelprice');
        
        $price = $this->input->post('productprice');
        if(!empty($price)){
            $price = $price;
        }else{
            $price = $multilevelprice[0];
        }
        $multilevelprice = $this->input->post('multilevelprice');
        $unit = $this->input->post('unit');
        $cekfoto = $this->M_product->photo_count($idUpload);
        if ($cekfoto < 2) {
            echo '<script>swal("Unggah gagal", "Anda Belum Mengunggah minimal 2 foto", "warning")</script>';
        } else {
            $product_name = $this->input->post('productname');
            $string = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $product_name);
            $trim = trim($string);
            $pre_slug = strtolower(str_replace(" ", "-", $trim));
            $slug = "$pre_slug-$idProduct" . '.html';
            $data = array(
                'idproduct' => $idProduct,
                'idcategory' => $this->input->post('category'),
                'idupload' => $idUpload,
                'productName' => ucwords($product_name),
                'productDescription' => ucwords($this->input->post('productdescription')),
                'price' => str_replace(".", "", $price),
                'multilevelStatus' => $multilevelstatus,
                'quantityStock' => $this->input->post('productqty'),
                'size' => $this->input->post('productsize'),
                'material' => $this->input->post('productmaterial'),
                'productWeight' => $this->input->post('productweight'),
                'postSlug' => $slug,
                'productStatus' => "In Stock",
                'fileDesignStatus' => $this->input->post('filedesignstatus'),
                'uploadBy' => $session
            );
            $this->M_product->update_product($data, $idProduct);
            if (!empty($multilevelstatus)) {
                $this->store_multilevel_price($idProduct,$rangestart, $rangeend, $multilevelprice, $unit);
            }
            echo '<script>swal({
                title: "Success!",
                text: "Produk ' . $this->input->post('productname') . ' Tersimpan dengan Stok ' . $this->input->post('productqty') . '",
                    type: "success",
                    showConfirmButton: true
                    }, function(){
                    dataProduct();
                    });</script>';
        }
    }

    function store_multilevel_price($idproduct,$rangestart, $rangeend, $multilevelprice, $unit) {
        $cek = $this->M_product->multipleprice_by_idproduct($idproduct);
        if($cek->num_rows() > 0){
            $this->M_product->delete_multilevelprice_by_id($idproduct);
            for ($i = 0; $i < count($rangestart); $i++) {
            $start = $rangestart[$i];
            $end = $rangeend[$i];
            $price = $multilevelprice[$i];
            $data = array(
                'idproduct' => $idproduct,
                'rangeStart' => str_replace(".", "", $start),
                'rangeEnd' => str_replace(".", "", $end),
                'multilevelPrice' => str_replace(".", "", $price),
                'unit' => $unit
            );
            $this->M_product->store_multilevel_price($data);
        }
        }else{
            for ($i = 0; $i < count($rangestart); $i++) {
            $start = $rangestart[$i];
            $end = $rangeend[$i];
            $price = $multilevelprice[$i];
            $data = array(
                'idproduct' => $idproduct,
                'rangeStart' => str_replace(".", "", $start),
                'rangeEnd' => str_replace(".", "", $end),
                'multilevelPrice' => str_replace(".", "", $price),
                'unit' => $unit
            );
            $this->M_product->store_multilevel_price($data);
        }
        }
    }

    function temp_upload_product($idP, $idU, $session) {
        $data = array(
            'idproduct' => $idP,
            'idcategory' => "NULL",
            'idupload' => $idU,
            'productName' => "NULL",
            'productDescription' => "NULL",
            'price' => "NULL",
            'quantityStock' => 0,
            'size' => "NULL",
            'material' => "NULL",
            'productWeight' => "NULL",
            'postSlug' => "NULL",
            'productStatus' => "temp",
            'uploadBy' => $session
        );
        $cek = $this->M_product->product_by_id($idP)->num_rows();
        if ($cek == 0) {
            $this->M_product->store_product($data);
        } else {
            $this->M_product->update_product($data, $idP);
        }
    }

    function do_upload_photo() {
        $idP = $this->input->post('idproduct');
        $a = $this->input->post('idupload');
        $session = $this->session->userdata('iduser');
        $b = $this->M_product->photo_count($a);
        $e = $b + 1;
        $config['upload_path'] = './asset/img/uploads/product/';
        $nmfile = "ft_" . $a . " ";
        $config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|JPEG|PNG';
        $config['file_name'] = $nmfile;
        $config['encrypt_name'] = FALSE;
        $this->upload->initialize($config);
        if (!empty($_FILES['filefoto']['name'])) {
            if ($this->upload->do_upload('filefoto')) {
                $c = $this->upload->data();
                $this->_create_thumbs($c['file_name']);
                $data = array(
                    'idUpload' => $a,
                    'fotoName' => $c['file_name'],
                    'thumbImage' => "thmb_" . $c['file_name'],
                    'fotoStatus' => $e
                );
                $this->M_product->upload_img($data);
                echo '<script>swal("Sukses", "Unggah Sukses foto ke - ' . $e . '", "success")</script>';
            } else {
                echo $this->image_lib->display_errors();
                echo '<script>swal("Unggah gagal", "Foto Gagal di unggah", "warning")</script>';
            }
            echo $this->image_lib->display_errors();
        }
        $cek = $this->M_product->product_by_id($idP)->num_rows();
        if ($cek == 0) {
            $this->temp_upload_product($idP, $a, $session);
        }
    }

    function _create_thumbs($file_name) {
        // Image resizing config
        $config = array(
            // Large Image
            array(
                'image_library' => 'GD2',
                'source_image' => './asset/img/uploads/product/' . $file_name,
                'maintain_ratio' => FALSE,
                'quality' => '98%',
                'width' => 400,
                'height' => 400,
                'new_image' => './asset/img/uploads/product/' . $file_name
            ),
            // Small Image
            array(
                'image_library' => 'GD2',
                'source_image' => './asset/img/uploads/product/' . $file_name,
                'maintain_ratio' => FALSE,
                'width' => 80,
                'height' => 67,
                'new_image' => './asset/img/uploads/product/thumb/' . "thmb_" . $file_name
        ));
        $this->load->library('image_lib', $config[0]);
        foreach ($config as $item) {
            $this->image_lib->initialize($item);
            if (!$this->image_lib->resize()) {
                return false;
            }
            $this->image_lib->clear();
        }
    }

    function load_photo($idU) {
        $gambar = $this->M_product->load_photo($idU)->result();
        foreach ($gambar as $value) {
            $id = "'$value->idFoto'";
            $status = "$value->fotoStatus";
            echo ' <div class="col-md-6 border-grey">
        <img class="img-responsive" src="' . site_url('asset/img/uploads/product/' . $value->fotoName . '') . '" />
        <span class="col-md-4 btn btn-sm bg-border-blue border-grey" style="display: block; color: #dd4b39; margin-top:7px;" onClick="del(' . $id . ')"><i class="fa fa-trash"></i> Hapus</span>'
            . '<span class="label label-success">' . $status . '</span> 
    </div>
    <div class="clearfix visible-xs"></div>';
        }
    }

    function imgDel($id) {
        $gambar = $this->M_product->foto_by_id($id)->row();
        unlink("asset/img/uploads/product/" . $gambar->fotoName);
        unlink("asset/img/uploads/product/thumb/" . $gambar->thumbImage);
        $this->M_product->do_delete_foto($id);
    }

    function data_product() {
        $data['data'] = $this->M_product->data_product()->result();
        $this->load->view('dashboard/product/data_product', $data);
    }

    function update_stock() {
        $id = $this->input->post('id');
        $stock = $this->input->post('stock');
        if ($stock == 0) {
            $data = array(
                'quantityStock' => $stock,
                'productStatus' => "Out Of Stock"
            );
            $this->M_product->update_product($data, $id);
        } else if ($stock > 0) {
            $data = array(
                'quantityStock' => $stock,
                'productStatus' => "In Stock"
            );
            $this->M_product->update_product($data, $id);
        }
        echo "<script> $.notify({title: '<strong>Sukses</strong>',message: 'Update Stok " . $id . " -> " . $stock . "'}, {
                    type: 'success',animate: {enter: 'animated fadeInUp', exit: 'animated fadeOutRight'
                    },
                    placement: {from: 'top',align: 'right'
                    },
                    offset: 20,delay: 3000,timer: 500,spacing: 10,z_index: 1031, });
                    </script>";
    }

    function delete_product() {
        $idproduct = $this->input->post('idproduct');
        $idupload = $this->input->post('idupload');
        $this->M_product->delete_by_idproduct($idproduct);
        $gambar = $this->M_product->foto_by_idupload($idupload)->result();
        foreach ($gambar as $value) {
            unlink("asset/img/uploads/product/" . $value->fotoName);
            unlink("asset/img/uploads/product/thumb/" . $value->thumbImage);
            $this->M_product->do_delete_foto($value->idFoto);
        }
    }

    function f_update_product() {
        $data['data'] = $this->M_product->product_by_id_all($this->input->post('id'))->row();
        $data['category'] = $this->M_category->get_select_category(0, "");
        $data['datamultilevel'] = $this->M_product->data_multilevel_by_id($this->input->post('id'))->result();
        $this->load->view('dashboard/product/f_update_product', $data);
    }

    function cek_qty() {
        $id = $this->input->post('id');
        $product = $this->M_product->product_by_id($id)->row();
        echo $product->quantityStock;
    }

}
