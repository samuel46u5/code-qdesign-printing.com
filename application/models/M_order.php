<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_order extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('date');
    }

    function generate_id_order() {
        $this->db->select('RIGHT(t_order.idorder,5) as kode', FALSE);
        $this->db->order_by('idorder', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('t_order');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kode = "odr585758" . $kodemax;
        return $kode;
    }

    function store_cart($data) {
        return $this->db->insert_batch('t_order_detail', $data);
    }

    function store_shiping($data) {
        $this->db->insert('t_order_shiping', $data);
        return $this->db->insert_id();
    }

    function store_order($data) {
        $this->db->insert('t_order', $data);
        return $this->db->insert_id();
    }

    function data_order_by_id($id) { //relation all table
        $this->db->select('*')
                ->from('t_order')
                ->join('t_order_detail', 't_order_detail.idorder=t_order.idorder')
                ->join('t_order_shiping', 't_order_shiping.idorder=t_order.idorder')
                ->where('t_order.idorder', $id);
        return $this->db->get();
    }

    function data_order_shiping_by_id($id) {
        $this->db->select('*')
                ->from('t_order_shiping')
                ->where('idorder', $id);
        return $this->db->get();
    }

    function cek_order_id($id) {
        $this->db->where('idorder', $id);
        return $this->db->get('t_order');
    }

    function data_order_id($id) {
        $this->db->where('idorder', $id);
        return $this->db->get('t_order');
    }

    function update_data_order_shiping($id, $data) {
        $this->db->where('idorder', $id);
        $this->db->update('t_order_shiping', $data);
        return "<script> $.notify({
            title: '<strong>Sukses</strong>',
            message: 'Item Terupdate'
                }, {
                type: 'success',
                animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 3000,timer: 500,spacing: 10,z_index: 1031,
                });
                </script>";
    }

    function update_data_order($id, $data) {
        $this->db->where('idorder', $id);
        $this->db->update('t_order', $data);
        return "<script> $.notify({
            title: '<strong>Sukses</strong>',
            message: 'Item Terupdate'
                }, {
                type: 'success',
                animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 3000,timer: 500,spacing: 10,z_index: 1031,
                });
                </script>";
    }

    function data_order_detail_by_id($id) {
        $this->db->select('*')
            ->join('t_product','t_product.idproduct=t_order_detail.idproduct')
            ->join('t_foto','t_foto.idupload=t_product.idupload')
            ->where('fotoStatus',1);
        $this->db->where('idorder', $id);
        return $this->db->get('t_order_detail');
    }

    function delete_data_order_detail($id) {
        $this->db->where('idorder', $id);
        $this->db->delete('t_order_detail');
    }

    function update_data_order_detail($id, $data) { //update an array
        $datadetail = $this->data_order_detail_by_id($id)->result();
        $i = 0;
        $NewArray = array();
        foreach ($datadetail as $value) {
            $NewArray[] = array_merge(array("idorderDetail" => $value->idorderDetail), $data[$i]);
            $i++;
        }
        $this->db->update_batch('t_order_deail', $NewArray, 'idorderDetail');
    }

    function data_order_by_status($status) {
        $this->db->where('status', $status);
        $this->db->join('t_order_shiping','t_order_shiping.idorder=t_order.idorder');
        return $this->db->get('t_order');
    }

    function data_order() {
        $this->db->select('*')
                ->from('t_order')
                ->join('t_order_shiping', 't_order_shiping.idorder=t_order.idorder');
        return $this->db->get();
    }

    function data_detail_order_product($idorder) {
        $this->db->select('*')
                ->join('t_product', 't_product.idproduct=t_order_detail.idproduct')
                ->where('t_order_detail.idorder', $idorder);
        return $this->db->get('t_order_detail');
    }

    function data_order_shiping() {
        return $this->db->get('t_order_shiping');
    }

    function data_order_shiping_by_date($startdate, $enddate) {
        $this->db->select('*')
                ->where('dateCreate >=', $startdate)
                ->where('dateCreate <=', $enddate);
        return $this->db->get('t_order_shiping');
    }

    function count_new_order() {
        $this->db->select('COUNT(idorder) as neworder')
                ->where('status', 'closing paid');
        return $this->db->get('t_order');
    }
    
    function count_wishlist(){
        $this->db->select('COUNT(idproduct) as wishlist');
        return $this->db->get('t_wishlist');
    }
    
    function countshoping(){
       $this->db->select('SUM(orderSumary) as countshoping');
       $this->db->where('status', 'process shiping');
        return $this->db->get('t_order'); 
    }
}
