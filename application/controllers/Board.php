<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018-11-08
 * Time: 오후 5:30
 */

class Board extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('board_model');
        $this->load->helper(array('url', 'date'));
    }
    public function view($idx)
    {
        $data['view']=$this->board_model->view($idx);
        $this->load->view($page='view',$data);
    }

    public function write()
    {
       // $data['view']=$this->board_model->view($idx);
        $this->load->view($page='write');
    }

    public function list($county='')
    {
        $county = $this->uri->segment(3);
        if($county == 'list') $county = '';
        $subject=$this->input->get('subject', TRUE);
        $content=$this->input->get('content', TRUE);
        $data['s_subject']=$subject;
        $data['s_content']=$content;
        $_GET['subject'] = $subject;
        $_GET['content'] = $content;

        $this->load->library('pagination');
        $config['first_url'] = site_url() . '/board/'.$county.'/1?'.http_build_query($_GET);
        $config['base_url']=site_url() . '/board/'.$county;
        $config['total_rows']=$this->board_model->lists('num_rows', '', '', $subject, $content, $county);
        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;
        $config['suffix'] = '?'.http_build_query($_GET,'',"&");
        $this->pagination->initialize($config);

        $data['pagination']=$this->pagination->create_links();
        $data['num_rows']=$config['total_rows'];

        $page = $this->uri->segment(4);
        if(!$page) $page = 1;
        if ($page > 1) {
            $offset=(($page / $config['per_page'])) * $config['per_page'];
        } else {
            $offset=($page - 1) * $config['per_page'];
        }
        $data['list']=$this->board_model->lists('', $offset, $config['per_page'], $subject, $content, $county);
        $this->load->view($page='board',$data);
    }
    public function desc()
    {
        if( $_POST ) {
            $idx=$this->uri->segment(3);
            $subject=$this->input->post('subject', TRUE);
            $content=$this->input->post('content', TRUE);
            $this->board_model->update($idx, $subject, $content);

            redirect('/board/index/');
            exit;
        } else {
            $idx=$this->uri->segment(3);
            $data['desc'] = $this->board_model->desc($idx);
            $this->load->view('desc', $data);
        }
    }

    public function insert()
    {
        if( $_POST ) {
            $subject=$this->input->post('subject', TRUE);
            $content=$this->input->post('content', TRUE);
            $this->board_model->insert($subject, $content);

            redirect('/board/index/');
            exit;
        } else {
            $this->load->view('insert');
        }
    }

    public function del()
    {
        $idx=$this->uri->segment(3);
        $this->board_model->del($idx);
        redirect('/board/index/');
    }

    public function truncate()
    {
        $this->board_model->truncate();
        redirect('/board/index/');
    }
}