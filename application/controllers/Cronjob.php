<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array(''));
        $this->load->model(array(''));
        $this->load->library(array(''));
        $this->load->database();
    }

}
