<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        //$this->load->model(array('apply_model', 'apply_model'));
    }

    public function index()
    {
        $this->load->view($page='main',$data);
    }

    public function ABOUT()
    {
        $data['been_list'] = $this->basic_model->get_where_been();
        $this->load->view($page='about',$data);
    }
}
