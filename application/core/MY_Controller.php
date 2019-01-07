<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->layout = 'default';
        $this->load->model('basic_model');
        $this->load->helper(array('url', 'date'));
        $data['gnb_list'] = $this->basic_model->get_site_gnb();

        if (isset($this->session->userdata['logged_in'])) {
            $username = ($this->session->userdata['logged_in']['username']);
        }else{
            $username = '/saebom/login';
        }
        if($username=='saebomkim'){
            $data['is_admin'] = 1;
            $data['footer_url'] = "/saebom/user/admin_page";
        }else{
            $data['is_admin'] = 0;
            $data['footer_url'] = "/saebom/login";
        }

        $this->load->vars($data);
    }

}
