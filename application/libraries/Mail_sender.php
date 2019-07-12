<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mail_sender {
    protected $CI;
    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library(array('session'));
    }
    public function send($mailto, $subject, $msg, $loc, $cc) {
        $this->CI->load->model(array('M_email_sender', 'M_company'));
        $this->CI->load->database();
        $dataemail = $this->CI->M_email_sender->data_email_sender()->row();
        $company = $this->CI->M_company->data_company()->row();
        {
            $config = Array(
                'protocol' => $dataemail->protocol,
                'smtp_host' => $dataemail->smtp_host,
                'smtp_port' => $dataemail->smtp_port,
                'smtp_user' => $dataemail->smtp_user,
                'smtp_pass' => $dataemail->smtp_pass,
                'mailtype' => $dataemail->mailtype,
                'charset' => $dataemail->charset
            );
            $this->CI->load->library('email', $config);
            $this->CI->email->set_newline("\r\n");
            $this->CI->email->from($company->companyName, $subject);
            $this->CI->email->to($mailto);
            if(!empty($cc)){
            $this->CI->email->cc($cc);
            }
            $this->CI->email->subject($company->companyName, $subject);
            $this->CI->email->message($msg);
            $this->CI->email->set_mailtype('html');
            if (!$this->CI->email->send()) {
                $report = "<script> $.notify({
            title: '<strong>Gagal</strong>',
            message: 'Email Gagal dikirim'
                }, {
                type: 'danger',
                animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 3000,timer: 500,spacing: 10,z_index: 1031,
                });
                </script>";
                    if($loc == "back"){
                        echo $report;                        
                        print_r($this->CI->email->print_debugger());

                    }else{
                        return $report;
                        print_r($this->CI->email->print_debugger());
                    }
            } else {
               $report = "<script> $.notify({
            title: '<strong>Sukses</strong>',
            message: 'Email Terkirim'
                }, {
                type: 'success',
                animate: {enter: 'animated fadeInUp',exit: 'animated fadeOutRight'
                },placement: {from: 'top',align: 'right'
                },offset: 20,delay: 3000,timer: 500,spacing: 10,z_index: 1031,
                });
                </script>";
                if($loc == "back"){
                        echo $report;
                    }else{
                        return $report;
                    }
            }
        }
    }
}