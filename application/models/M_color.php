<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_color extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function data_color() {
        return $this->db->get('t_color');
    }

    function data_color_by_id($id) {
        $this->db->select('*')
                ->from('t_color')
                ->where('id', $id);
        return $this->db->get();
    }

    function data_color_by_idproduct($id) {
        $this->db->select('*')
                ->from('t_product_color')
                ->join('t_color','t_color.id=t_product_color.idcolor')
                ->where('idproduct', $id);
        return $this->db->get();
    }

    function update_data_color($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('t_color', $data);
        echo "<script> $.notify({
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

    function store_color($data) {
        $this->db->insert('t_color', $data);
        $this->db->insert_id();
        echo "<script> $.notify({
                title: '<strong>Sukses</strong>',
                message: '" . $data['colorName'] . "  Tersimpan'
                    }, {type: 'success',
                    animate: { enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                    },placement: {from: 'top',align: 'right'
                    },offset: 20,delay: 4000,timer: 1000, spacing: 10,z_index: 1031,
                    });
                    </script>";
    }

    function delete_product_color_by_id($idproduct){
        $this->db->where('idproduct', $idproduct);
        $this->db->delete('t_product_color');
    }

    function store_product_color($data) {
        $this->db->insert('t_product_color', $data);
        $this->db->insert_id();
    }

}
