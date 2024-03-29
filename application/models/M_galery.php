<?php

defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok');

class M_galery extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function upload_img($data)
    {

        // $this->db->insert('t_banner_image', $data);
        $this->db->insert('t_galery_foto', $data);

        return $this->db->insert_id();
    }

    function data_galery_foto_all()
    {
        $this->db->select('*')->from('t_galery_foto')->join('t_album_galery', 't_galery_foto.id_album=t_album_galery.id');
        return $this->db->get();
    }

    function update_galery($id, $data)
    {

        $this->db->where('id', $id);
        $this->db->update('t_album_galery', $data);
        echo "<script> $.notify({
            title: '<strong>Sukses</strong>',
            message: 'Kategori " . $id . "  Terupdate'
                }, {type: 'success',
                animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 3000,timer: 500,spacing: 10, z_index: 1031,
                });
                </script>";
    }

    function simpan_AlbumGalery($data)
    {
        $this->db->insert('t_album_galery', $data);
        $this->db->insert_id();
    }

    function delete_galery($idphoto)
    {
        $this->db->where('idphoto', $idphoto);
        $this->db->delete('t_galery_foto');
    }

    function data_galery_album_all()
    {
        $this->db->select('*')->from('t_album_galery');
        return $this->db->get();
    }

    function update_status_galery($idphoto, $data)
    {
        $this->db->where('idphoto', $idphoto);
        $this->db->update('t_galery_foto', $data);

        echo "<script> $.notify({
            title: '<strong>Sukses</strong>',
            message: 'Galery " . $data['deskripsi'] . "  Terupdate'
                }, {
                type: 'success',
                animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 3000,timer: 500,spacing: 10,z_index: 1031,
                });
                </script>";
    }


    function foto_by_id($id)
    {

        $this->db->select("*")
            ->where('idphoto', $id);
        return $this->db->get('t_galery_foto');
    }

    function id_galery()
    {

        // $this->db->select('SELECT max(idphoto) FROM t_galery_foto');
        // $this->db->limit(1);
        // $query = $this->db->get('t_product');
        // if ($query->num_rows() <> 0) {
        //     $data = $query->row();
        //     $kode = intval($data->kode) + 1;
        // } else {
        //     $kode = 1;
        // }
        // $id_galery = $kode;

        // return $id_galery;
    }
}
