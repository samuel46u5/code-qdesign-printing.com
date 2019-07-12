<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok');

class M_product extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('date');
    }

    function id_product() {
        $this->db->select('RIGHT(t_product.idproduct,3) as kode', FALSE);
        $this->db->order_by('idproduct', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('t_product');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodeproduct = "PRD5577" . $kodemax;
        return $kodeproduct;
    }

    function data_temp_idupload_temp($session, $status) {
        $this->db->select('*')
        ->where('uploadBy', $session)
        ->where('productStatus', $status);
        return $this->db->get('t_product');
    }

    function data_product_newarival() {
        $curdat = mdate('%Y-%m-%d');
        $curdate = "'$curdat'";

        return $this->db->query('SELECT *, `t_product`.`idproduct` AS `idp` FROM `t_product` 
            JOIN 
            `t_category` ON `t_category`.`idcategory`=`t_product`.`idcategory` 
            JOIN 
            `t_foto` ON `t_foto`.`idUpload`=`t_product`.`idupload` AND`fotoStatus` = 1 
            LEFT JOIN 
            `t_product_sale` ON `t_product_sale`.`idproduct`=`t_product`.`idproduct` AND `startDate` <= ' . $curdate . ' AND `endDate` >= ' . $curdate . '
            ORDER BY `productDateUpload` DESC LIMIT 10');
    }

    function fecth_data_product_newarival($start, $limit, $price) {
        $curdat = mdate('%Y-%m-%d');
        $curdate = "'$curdat'";

        return $this->db->query('SELECT *, COUNT(postSlug) AS result, `t_product`.`idproduct` AS `idp` FROM `t_product` 
            JOIN 
            `t_category` ON `t_category`.`idcategory`=`t_product`.`idcategory` 
            JOIN 
            `t_foto` ON `t_foto`.`idUpload`=`t_product`.`idupload` AND`fotoStatus` = 1 
            LEFT JOIN 
            `t_product_sale` ON `t_product_sale`.`idproduct`=`t_product`.`idproduct` AND `startDate` <= ' . $curdate . ' AND `endDate` >= ' . $curdate . '
            ORDER BY `price` ' . $price . ' LIMIT ' . $start . ',' . $limit . '');
    }

    function data_product_sale() {
        $curdate = mdate('%Y-%m-%d');
        $this->db->select('*')
        ->from('t_product_sale')
        ->join('t_product', 't_product.idproduct=t_product_sale.idproduct')
        ->join('t_foto', 't_foto.idUpload=t_product.idupload')
        ->where('startDate <=', $curdate)
        ->where('endDate >=', $curdate)
        ->where('fotoStatus', 1)
        ->order_by('productDateUpload', 'ASC')
        ->limit(10);
        return $this->db->get();
    }

    function fecth_data_product_sale($start, $limit, $price) {
        $curdate = mdate('%Y-%m-%d');
        $this->db->select('*')
        ->from('t_product_sale')
        ->join('t_product', 't_product.idproduct=t_product_sale.idproduct')
        ->join('t_foto', 't_foto.idUpload=t_product.idupload')
        ->where('startDate <=', $curdate)
        ->where('endDate >=', $curdate)
        ->where('fotoStatus', 1)
        ->order_by('priceSale', $price)
        ->limit($limit, $start);
        return $this->db->get();
    }

    function data_product_bestseller() {
        $curdat = mdate('%Y-%m-%d');
        $curdate = "'$curdat'";

        return $this->db->query('SELECT * FROM `t_product_bestseller` 
            JOIN
            `t_product` ON `t_product`.`idproduct`=`t_product_bestseller`.`idproduct`
            JOIN 
            `t_foto` ON `t_foto`.`idUpload`=`t_product`.`idupload` AND`fotoStatus` = 1 
            LEFT JOIN 
            `t_product_sale` ON `t_product_sale`.`idproduct`=`t_product`.`idproduct` AND `startDate` <= ' . $curdate . ' AND `endDate` >= ' . $curdate . '
            ORDER BY `productDateUpload`');
    }

    function fecth_data_product_bestseller($start, $limit, $price) {
        $curdat = mdate('%Y-%m-%d');
        $curdate = "'$curdat'";

        return $this->db->query('SELECT * FROM `t_product_bestseller` 
            JOIN
            `t_product` ON `t_product`.`idproduct`=`t_product_bestseller`.`idproduct`
            JOIN 
            `t_foto` ON `t_foto`.`idUpload`=`t_product`.`idupload` AND`fotoStatus` = 1 
            LEFT JOIN 
            `t_product_sale` ON `t_product_sale`.`idproduct`=`t_product`.`idproduct` AND `startDate` <= ' . $curdate . ' AND `endDate` >= ' . $curdate . '
            ORDER BY  `price` ' . $price . ' LIMIT ' . $start . ',' . $limit . '');
    }

    function delete_product_bestseller($id) {
        $this->db->where('id', $id);
        $this->db->delete('t_product_bestseller');
    }

    function data_product_bestseller_by_id($id) {
        $this->db->where('idproduct', $id);
        return $this->db->get('t_product_bestseller');
    }

    function data_product_all() {
        $curdate = mdate('%Y-%m-%d');
        $this->db->select('*, t_product.idproduct AS idp')
        ->from('t_product')
        ->join('t_category', 't_category.idcategory=t_product.idcategory')
        ->join('t_foto', 't_foto.idUpload=t_product.idupload')
        ->join('t_product_sale', 't_product_sale.idproduct=t_product.idproduct', 'left')
        ->where('fotoStatus', 1)
        ->order_by('productDateUpload', 'ASC');
        return $this->db->get();
    }

    function data_product() {
        $this->db->select('*')
        ->from('t_product')
        ->join('t_foto', 't_foto.idUpload=t_product.idupload')
        ->join('t_user', 't_user.iduser=t_product.uploadBy')
        ->where('fotoStatus', 1);
        return $this->db->get();
    }

    function data_detail_product_by_slug($slug) {
        $curdat = mdate('%Y-%m-%d');
        $curdate = "'$curdat'";
        return $this->db->query('SELECT *, `t_product`.`idproduct` AS `idp` FROM `t_product` 
            JOIN 
            `t_category` ON `t_category`.`idcategory`=`t_product`.`idcategory` 
            JOIN 
            `t_foto` ON `t_foto`.`idUpload`=`t_product`.`idupload` AND`fotoStatus` = 1 
            LEFT JOIN
            `t_multilevel_price` ON `t_multilevel_price`.`idproduct`=`t_product`.`idproduct`
            LEFT JOIN 
            `t_product_sale` ON `t_product_sale`.`idproduct`=`t_product`.`idproduct` AND `startDate` <= ' . $curdate . ' AND `endDate` >= ' . $curdate . '
            WHERE postSlug="' . $slug . '"'
            . 'ORDER BY `productDateUpload` ASC LIMIT 10');
    }

    function data_foto_by_slug($slug) {
        $this->db->select('*')
        ->from('t_product')
        ->join('t_foto', 't_foto.idUpload=t_product.idupload')
        ->where('postSlug', $slug);
        return $this->db->get();
    }

    function produk_by_link($link) {
        $this->db->select('*')
        ->from('t_category')
        ->join('t_product', 't_product.idcategory=t_category.idcategory')
        ->join('t_foto', 't_foto.idUpload=t_product.idupload')
        ->join('t_product_sale', 't_product_sale.idproduct=t_product.idproduct', 'left')
        ->where('fotoStatus', 1)
        ->where('categoryLink', $link)
        ->order_by('productDateUpload', 'ASC');
        return $this->db->get();
    }

    function produk_by_idparent($id) {
        $this->db->select('*')
        ->from('t_category')
        ->join('t_product', 't_product.idcategory=t_category.idcategory')
        ->join('t_foto', 't_foto.idUpload=t_product.idupload')
        ->join('t_product_sale', 't_product_sale.idproduct=t_product.idproduct', 'left')
        ->where('fotoStatus', 1)
        ->where('idparent', $id)
        ->order_by('productDateUpload', 'ASC');
        return $this->db->get();
    }

    function update_product($data, $id) {
        $this->db->where('idproduct', $id);
        $this->db->update('t_product', $data);
    }

    function product_by_id_all($id) {
        $this->db->select('*')
        ->join('t_category', 't_category.idcategory=t_product.idcategory')
                // ->join('t_product_color','t_product_color.idproduct=t_product.idproduct', 'left')
        ->where('t_product.idproduct', $id);
        return $this->db->get('t_product');
    }

    function product_by_id($id) {
        $this->db->select('*')
        ->where('idproduct', $id);
        return $this->db->get('t_product');
    }

    function product_by_id_cat($id) {
        $this->db->select('idproduct, productName, idcategory')
        ->where('idcategory', $id);
        return $this->db->get('t_product');
    }

    function product_by_status($status) {
        $this->db->select('*')
        ->where('productStatus', $status);
        return $this->db->get('t_product');
    }

    function delete_by_status($status) {
        $this->db->where('productStatus', $status);
        $this->db->delete('t_product');
    }

    function delete_by_idproduct($id) {
        $this->db->where('idproduct', $id);
        $this->db->delete('t_product');
    }

    function upload_img($data) {
        $this->db->insert('t_foto', $data);
        return $this->db->insert_id();
    }

    function photo_count($id) {
        $query = $this->db->query("SELECT * from t_foto where idupload='$id'");
        $jumlah = $query->num_rows();
        return $jumlah;
    }

    function store_product($data) {
        $this->db->insert('t_product', $data);
        return $this->db->insert_id();
    }

    function store_product_bestseller($data) {
        $this->db->insert('t_product_bestseller', $data);
        return $this->db->insert_id();
    }

    function load_photo($idU) {
        $this->db->select('*')
        ->where('idUpload', $idU);
        return $this->db->get('t_foto');
    }

    function foto_by_id($id) {
        $this->db->select('*')
        ->where('idFoto', $id);
        return $this->db->get('t_foto');
    }

    function foto_by_idupload($id) {
        $this->db->select('*')
        ->where('idUpload', $id);
        return $this->db->get('t_foto');
    }

    function do_delete_foto($id) {
        $this->db->where('idFoto', $id);
        $this->db->delete('t_foto');
    }

    function fetch_data_all($curdate, $start, $limit, $price) {
        return $this->db->query('SELECT *, `t_product`.`idproduct` AS `idp` FROM `t_product` 
            JOIN 
            `t_category` ON `t_category`.`idcategory`=`t_product`.`idcategory` 
            JOIN 
            `t_foto` ON `t_foto`.`idUpload`=`t_product`.`idupload` AND`fotoStatus` = 1 
            LEFT JOIN 
            `t_product_sale` ON `t_product_sale`.`idproduct`=`t_product`.`idproduct` AND `startDate` <= ' . $curdate . ' AND `endDate` >= ' . $curdate . '
            ORDER BY price ' . $price . ' LIMIT ' . $start . ',' . $limit . '');
    }

    function fetch_data_id_parent($curdate, $start, $limit, $price, $idcategory) {
        $tmp = rtrim($this->get_array_category($idcategory, ""), ", ");
        $array_category = explode(",", $tmp);
        array_push($array_category, $idcategory);
        $this->db->select('*')
        ->from('t_category AS node1')
        ->join('t_product', 'node1.idcategory=t_product.idcategory')
        ->join('t_foto', 't_foto.idUpload=t_product.idupload')
        ->join('t_product_sale', 't_product_sale.idproduct=t_product.idproduct AND startDate <=' . $curdate . 'AND endDate >=' . $curdate . '', 'left')
        ->where('fotoStatus', 1)
        ->where_in('node1.idcategory', $array_category)
        ->order_by('t_product.price', $price)
        ->limit($limit, $start);
        return $this->db->get();
    }

    function fecth_data_search($limit, $start, $productname){
        $curdat = mdate('%Y-%m-%d');
        $curdate = "'$curdat'";
        $result = $this->db->select('*')
        ->from('t_category AS node1')
        ->join('t_product', 'node1.idcategory=t_product.idcategory')
        ->join('t_foto', 't_foto.idUpload=t_product.idupload')
        ->join('t_product_sale', 't_product_sale.idproduct=t_product.idproduct AND startDate <=' . $curdate . 'AND endDate >=' . $curdate . '', 'left')
        ->where('fotoStatus', 1)
        ->like('productName', $productname)
        ->limit($limit, $start);
        return $this->db->get();
    }

    function fetch_data($limit, $start, $idcategory, $price, $group) {
        $curdat = mdate('%Y-%m-%d');
        $curdate = "'$curdat'";
        if (empty($idcategory)) {
            if (!empty($group)) {
                if ($group == "sale") {
                    return $this->fecth_data_product_sale($start, $limit, $price);
                } elseif ($group == "new") {
                    return $this->fecth_data_product_newarival($start, $limit, $price);
                } elseif ($group == "best") {
                    return $this->fecth_data_product_bestseller($start, $limit, $price);
                }
            } else {
                return $this->fetch_data_all($curdate, $start, $limit, $price);
            }
        } else {
            $data = $this->db->where('idcategory', $idcategory)->get('t_category')->row();
            if (empty($data)) {

            } elseif ($this->fetch_data_id_parent($curdate, $start, $limit, $price, $data->idcategory)->num_rows() != 0) {
                return $this->fetch_data_id_parent($curdate, $start, $limit, $price, $data->idcategory);
            } else {
                $result = $this->db->select('*')
                ->from('t_category AS node1')
                ->join('t_product', 'node1.idcategory=t_product.idcategory')
                ->join('t_foto', 't_foto.idUpload=t_product.idupload')
                ->join('t_product_sale', 't_product_sale.idproduct=t_product.idproduct AND startDate <=' . $curdate . 'AND endDate >=' . $curdate . '', 'left')
                ->where('fotoStatus', 1)
                ->where('node1.idcategory', $data->idcategory)
                ->order_by('t_product.price', $price)
                ->limit($limit, $start);
                return $this->db->get();
            }
        }
    }

    function get_array_category($parent, $hasil) {
        $w = $this->db->query("SELECT * from t_category where idparent='" . $parent . "'");
        foreach ($w->result() as $h) {
            $hasil = $this->get_array_category($h->idcategory, $hasil);
            $hasil .= $h->idcategory;
            $hasil .= ",";
        }
        return $hasil;
    }

    function count_product_result($idcategory, $group) {
        $curdat = mdate('%Y-%m-%d');
        $curdate = "'$curdat'";
        $tmp = rtrim($this->get_array_category($idcategory, ""), ", ");
        $array_category = explode(",", $tmp);
        array_push($array_category, $idcategory);
        if (empty($group)) {
            $this->db->select('COUNT(idproduct) AS result')
            ->from('t_product AS node1')
            ->where_in('node1.idcategory', $array_category);
            return $this->db->get();
        } elseif ($group == "sale") {
            $this->db->select('COUNT(t_product_sale.idproduct) AS result')
            ->from('t_product_sale')
            ->join('t_product', 't_product.idproduct=t_product_sale.idproduct')
            ->where_in('t_product.idcategory', $array_category);
            return $this->db->get();
        }
    }

    function count_search_result($productname){
        $result = $this->db->select('COUNT(t_product.idproduct) AS result')
        ->like('productName', $productname);
        return $this->db->get('t_product'); 
    }

    function update_stock_product($data) {
        $this->db->update_batch('t_product', $data, 'idproduct');
    }

    function data_relateproduct($id, $slug) {
        $curdat = mdate('%Y-%m-%d');
        $curdate = "'$curdat'";
        $this->db->Select('*')
        ->join('t_foto', 't_foto.idupload=t_product.idupload')
        ->join('t_product_sale', 't_product_sale.idproduct=t_product.idproduct AND startDate <=' . $curdate . 'AND endDate >=' . $curdate . '', 'left')
        ->where('idcategory', $id)
        ->where('fotoStatus', 1)
        ->where_not_in('postSlug', $slug);
        return $this->db->get('t_product');
    }

    function countproduct() {
        $this->db->select('COUNT(idproduct) as countproduct');
        $this->db->where_not_in('price', 'NULL');
        return $this->db->get('t_product');
    }

    function countproductoutstock() {
        $this->db->select('COUNT(idproduct) as countproductoutstock');
        $this->db->where('productStatus', 'out of stock');
        return $this->db->get('t_product');
    }

    function countproductinstock() {
        $this->db->select('COUNT(idproduct) as countproductinstock');
        $this->db->where('productStatus', 'in stock');
        return $this->db->get('t_product');
    }

    function lastSale() {
        $this->db->select('endDate');
        $this->db->order_by('endDate', 'DESC');
        return $this->db->get('t_product_sale');
    }

    function store_multilevel_price($data) {
        $this->db->insert('t_multilevel_price', $data);
        $this->db->insert_id();
    }
    
    function data_multilevel_by_id($id){
        $this->db->select('*')
        ->where('idproduct', $id);
        return $this->db->get('t_multilevel_price');
    }

    function get_multiple_price($idproduct, $qty){
        $this->db->select('*')
        ->from('t_multilevel_price')
        ->where('idproduct', $idproduct)
        ->where('rangeStart <=', $qty)
        ->where('rangeEnd >=', $qty);
        return $this->db->get();
    }

    function get_multiple_price_un($idproduct){
        $this->db->select('multilevelPrice')
        ->where('idproduct', $idproduct)
        ->where('rangeEnd', 0);
        return $this->db->get('t_multilevel_price');
    }

    function fetch_data_autocomplete($query){
        $base_url = base_url();
        $str = "'";
        $this->db->like('productName', $query);
        $this->db->join('t_foto','t_foto.idUpload=t_product.idUpload');
        $this->db->where('fotoStatus', 1);
        $data = $this->db->get('t_product');
        if($data->num_rows() > 0)
        {
           foreach($data->result_array() as $row)
           {
            $output[] = array(
             'name'  => $row["productName"],
             'image'  => $base_url.'asset/img/uploads/product/thumb/'.$row["thumbImage"],
             'slug' => $str.$row["postSlug"].$str
         );
        }
        echo json_encode($output);
    }
    }

    function multipleprice_by_idproduct($id){
        $this->db->select('*')
        ->where('idproduct', $id);
        return $this->db->get('t_multilevel_price');
    }

    function delete_multilevelprice_by_id($id){
        $this->db->where('idproduct', $id);
        $this->db->delete('t_multilevel_price');
    }

}
