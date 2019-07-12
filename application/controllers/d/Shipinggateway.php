<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ShipingGateway extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_shiping_gateway', 'M_order'));
    }

    function get_provinsi() {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $provinsi = $rajaongkir->_api_ongkir('province');
        $data = json_decode($provinsi, true);
        echo json_encode($data['rajaongkir']['results']);
    }

    function get_kota($provinsi = "") {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        if (!empty($provinsi)) {
            if (is_numeric($provinsi)) {
                $kota = $rajaongkir->_api_ongkir('city?province=' . $provinsi);
                $data = json_decode($kota, true);
                echo json_encode($data['rajaongkir']['results']);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    function get_nama_provinsi($provinsi) {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $provinsiname = $rajaongkir->_api_ongkir('province?id=' . $provinsi . '');
        $data = json_decode($provinsiname, true);
        $result = json_encode($data['rajaongkir']['results']['province']);
        return str_replace('"', " ", $result);
    }

    function get_nama_kota($kota, $provinsi) {
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $kotaname = $rajaongkir->_api_ongkir('city?id=' . $kota . '&province=' . $provinsi . '');
        $data = json_decode($kotaname, true);
        $result = json_encode($data['rajaongkir']['results']['city_name']);
        return str_replace('"', " ", $result);
    }

    function store_origin_shiping() {
        $id = 1; //change by param if more than one gateway
        $idprovinsi = $this->input->post('provinsi');
        $idkota = $this->input->post('kotaorigin');

        $data = array(
            'originProvinceCode' => $idprovinsi,
            'originCityCode' => $idkota,
            'originProvinceName' => $this->get_nama_provinsi($idprovinsi),
            'originCityName' => $this->get_nama_kota($idkota, $idprovinsi)
        );
        $this->M_shiping_gateway->update_shiping_gateway($id, $data);
    }

    function get_cost($des, $weight, $cour) {
        $gatewayname = "Raja Ongkir";
        $origin = $this->M_shiping_gateway->data_shiping_gateway_by_name($gatewayname)->row();
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $tarif = $rajaongkir->_api_ongkir_post($origin->originCityCode, $des, $weight, $cour);
        $data = json_decode($tarif, true);
        echo json_encode($data['rajaongkir']['results']);
    }
}