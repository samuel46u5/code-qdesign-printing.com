<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Exportdata extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_order', 'M_invoice', 'M_design', 'M_company'));
        $this->load->library(array('session'));
        $this->load->helper(array('html', 'date', 'form', 'url'));
        $this->load->database();
    }

    function export_invoice_pdf() {
        $idorder = $this->input->get('idorder');
        $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($idorder)->row();
        $data['orderresult'] = $this->M_order->data_order_id($idorder)->row();
        $data['detailorder'] = $this->M_order->data_order_detail_by_id($idorder)->result();
        $data['invoice'] = $this->M_invoice->data_invoice_by_id_order($idorder)->row();

        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['profile'] = $this->M_company->data_company()->row();
        $this->load->library('pdf');
        $this->pdf->load_view('export_data/template_invoice', $data);
        $this->pdf->set_paper('A4', 'Potrait');
        $this->pdf->render();
        $this->pdf->stream("inv" . $idorder . ".pdf", array("Attachment" => 0));
    }

    function export_shiping_label_pdf() {
        $idorder = $this->input->get('idorder');
        $dataorder = $this->M_order->data_order_shiping_by_id($idorder)->row();
        $data['ordershiping'] = $this->M_order->data_order_shiping_by_id($idorder)->row();
        $data['orderresult'] = $this->M_order->data_order_id($idorder)->row();
        $data['detailorder'] = $this->M_order->data_order_detail_by_id($idorder)->result();
        $data['invoice'] = $this->M_invoice->data_invoice_by_id_order($idorder)->row();
        $data['logo'] = $this->M_design->data_banner_by_pos("logo")->row();
        $data['profile'] = $this->M_company->data_company()->row();
        $this->load->library('pdf');
        if ($dataorder->dropshipperName == "") {
            $this->pdf->load_view('export_data/template_shiping_label', $data);
        } else {
            $this->pdf->load_view('export_data/template_shiping_label_dropship', $data);
        }
        $this->pdf->set_paper('A4', 'Potrait');
        $this->pdf->render();
        $this->pdf->stream("lbl" . $idorder . ".pdf", array("Attachment" => 0));
    }

    function export_ltv_excel() {
        $startdate = $this->input->get('startdate');
        $enddate = $this->input->get('enddate');
        if (empty($startdate) && empty($enddate)) {
            $data['startdate'] = "";
            $data['enddate'] = "";
            $data['data'] = $this->M_order->data_order_shiping()->result();
        } else {
            $data['startdate'] = $startdate;
            $data['enddate'] = $enddate;
            $data['data'] = $this->M_order->data_order_shiping_by_date($startdate, $enddate)->result();
        }
        $this->load->view('export_data/template_ltv', $data);
    }

    function final_export_ltv() {
        $startdate = $this->input->get('startdate');
        $enddate = $this->input->get('enddate');
        if (empty($startdate) && empty($enddate)) {
            $data['startdate'] = "";
            $data['enddate'] = "";
            $data['data'] = $this->M_order->data_order_shiping()->result();
        } else {
            $data['startdate'] = $startdate;
            $data['enddate'] = $enddate;
            $data['data'] = $this->M_order->data_order_shiping_by_date($startdate, $enddate)->result();
        }
        $this->load->view('export_data/final_export_ltv', $data);
    }
}