<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();

        // Load form helper library
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        $this->load->model('board_model');
    }

    public function index()
    {
        $subject=$this->input->get('subject', TRUE);
        $content=$this->input->get('content', TRUE);
        $data['s_subject']=$subject;
        $data['s_content']=$content;
        $_GET['subject'] = $subject;
        $_GET['content'] = $content;
        $offset = '0';
        $data['best_list']=$this->board_model->best_lists('', $offset, '3', $subject, $content);
        $data['list']=$this->board_model->lists('', $offset, '5', $subject, $content);
        $data['pagination'] = "<div class=\"clearfix\">
                    <a class=\"btn btn-primary float-right\" href=\"/saebom/board/list\">Older Posts &rarr;</a>
                </div>";
        $this->load->view($page='main',$data);
        $this->load->view('board',$data);
    }

    public function ABOUT()
    {
        $data['been_list'] = $this->basic_model->get_where_been();
        $this->load->view($page='about',$data);
    }

}
