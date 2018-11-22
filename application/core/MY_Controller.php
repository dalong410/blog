<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

        if($username){
            $data['footer_url'] = "/saebom/user/admin_page";
        }else{
            $data['footer_url'] = "/saebom/login";
        }
        $this->load->vars($data);
    }

}
