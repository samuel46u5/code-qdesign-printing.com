<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_wishlist extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function data_count_wishlist() {
        $this->db->select('t_wishlist.idproduct, t_product.idproduct, productName, COUNT(t_wishlist.idproduct) AS count')
                ->from('t_wishlist')
                ->join('t_product', 't_product.idproduct=t_wishlist.idproduct')
                ->group_by('t_wishlist.idproduct')
                ->order_by('count', 'DESC');
        return $this->db->get();
    }

    function data_wishlist() {
        $this->db->select('t_wishlist.idproduct, t_product.idproduct, phone,email, productName, ipAddress, dateSubmit, idwishlist')
                ->from('t_wishlist')
                ->join('t_product', 't_product.idproduct=t_wishlist.idproduct');
        return $this->db->get();
    }

    function store_wishlist($data) {
        $this->db->insert('t_wishlist', $data);
        $this->db->insert_id();
    }

    function wish_by_id($id){
        $this->db->select('*')
        ->join('t_product', 't_wishlist.idproduct=t_product.idproduct')
        ->where('idwishlist', $id);
        return $this->db->get('t_wishlist');
    }

}
