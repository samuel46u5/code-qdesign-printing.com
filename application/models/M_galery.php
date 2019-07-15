<?php

defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok');

class M_galery extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function data_galery_foto_all()
    {
        $this->db->select('*')->from('t_galery_foto');
        return $this->db->get();
    }

    function id_galery()
    {

        $this->db->select('SELECT max(idphoto) FROM t_galery_foto');
        $this->db->limit(1);
        $query = $this->db->get('t_product');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $id_galery = $kode;

        return $id_galery;
    }
}
