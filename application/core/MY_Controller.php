<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->layout = 'default';
        $this->load->model('basic_model');

        $data['gnb_list'] = $this->basic_model->get_site_gnb();
        $this->load->vars($data);
    }

}
