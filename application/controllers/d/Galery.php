<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Galery extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();


        $this->load->model(array('M_galery'));
        $this->load->library(array('session', 'image_lib', 'upload'));
        $this->load->helper(array('html', 'date', 'form', 'url'));
        $this->load->database();
    }


    public function list_album()
    {
        $album = $this->M_galery->data_galery_album_all()->result();
        echo "<option disabled selected>Pilih Kelurahan</option>";
        foreach ($album as $a) {
            echo "<option value='{$a->nama_album}'>{ $a->nama_album}</option>";
        }
    }

    function get_album_list()
    {
        $data['data'] = $this->M_galery->data_galery_album_all()->result();
        return $data->result(); //mengembalikan hasil ke pemanggil
    }

    function do_upload_album()
    {

        $data = array(
            'nama_album' => $this->input->post('nama_album')
        );
        $this->M_galery->simpan_AlbumGalery($data);
    }

    function do_upload_galery()
    {
        $url = base_url('');
        $config['upload_path'] = './asset/img/uploads/galery/';
        $nmfile = "ft_galery";
        $config['allowed_types'] = "*";
        $config['file_name'] = $nmfile;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if (!empty($_FILES['filefoto']['name'])) {
            if ($this->upload->do_upload('filefoto')) {
                $c = $this->upload->data();
                $configer = array(
                    'image_library' => 'gd2',
                    'source_image' => './asset/img/uploads/galery/' . $c['file_name'],
                    'maintain_ratio' => TRUE,
                    'maintain_ratio' => TRUE,
                    'new_image' => './asset/img/uploads/galery/' . $c['file_name'],
                    'source_image' => './asset/img/uploads/galery/' . $c['file_name']
                );
                $this->load->library('image_lib', $configer);
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();
                $this->image_lib->watermark();
                $data = array(
                    // 'bannerPosition' => $bannerpos,
                    // 'status' => "inactive",
                    // 'image' => $c['file_name'],
                    // 'bannerdescription' => 'none', //by agus
                    // 'bannerText' => $this->input->post('bannertext'),
                    // 'sortOrder' => $this->input->post('sortorder'),
                    // 'bannerLink' => $linkbanner

                    // disiini diisi sesuai nama filed
                    'id_album' => $this->input->post('album'),
                    'image' => $c['file_name'],
                    'deskripsi' => $this->input->post('bannertext')

                );


                $this->M_galery->upload_img($data);
                echo '<script>swal({
                title: "Success!",
                text: "Unggah Foto sukses",
                    type: "success",
                    showConfirmButton: true
                    }, function(){
                    dataBanner();
                    });</script>';
            } else {
                echo $this->image_lib->display_errors();
                echo $this->upload->display_errors();
                echo '<script>swal("Unggah gagal", "Foto Gagal di unggah", "warning")</script>';
            }
        }
    }

    function add_galeryfoto() //meng
    {

        $data['data'] = $this->M_galery->data_galery_album_all()->result();
        $this->load->view('dashboard/galery/f_upload_galery_foto', $data);
        // $this->load->view('dashboard/galery/f_upload_galery_foto');
    }


    function dataGaleryFoto()
    {

        $data['data'] = $this->M_galery->data_galery_foto_all()->result();
        $this->load->view('dashboard/galery/data_galery_foto', $data);
    }

    function dataGaleryVideo()
    {

        // $data['data'] = $this->M_contact->data_contact()->result();
        $data['aku'] = 'agus';
        $this->load->view('dashboard/galery/data_galery_video', $data);
    }
}
