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
        $this->load->helper(array('url', 'date', 'form'));
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

    public function upload_img()
    {
        # 매달 해당월 폴더 제작
        $mydir = './data/editor/'.date("Ymd");
        if(!is_dir($mydir)) {
            if(@mkdir($mydir, 0777)) {
                @chmod($mydir, 0777);
            }
        }
        # 파일 업로드
        $config['upload_path']          = $mydir;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 50000;
        $config['max_width']            = 50000;
        $config['max_height']           = 50000;
        $config['encrypt_name']         = true;
        $log_field = array();

        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('file'))
       {
            $error_message = $this->upload->display_errors();

           echo json_encode(array('success' => false, 'error' => strip_tags($error_message)));
           exit();
        } else {
            $data = array('upload_data' => $this->upload->data());
            $save_url = UPLOAD_FILE.$data['upload_data']['file_name'];

            # 이미지 리사이징 가로 900px 이상만 리사이징됨
            $img_conf['image_library']      = 'gd2';
            $img_conf['source_image']       = $data['upload_data']['full_path'];
            $img_conf['create_thumb']       = TRUE;
            $img_conf['quality']            = '90%';
            $img_conf['maintain_ratio']     = TRUE;
            $img_conf['new_image']          = $mydir;

            if($data['upload_data']['image_width'] > 900) {
                $img_conf['width']              = 900;
                $img_conf['master_dim']         = 'width';
            }
            $this->load->library('image_lib', $img_conf);
            if($this->image_lib->resize()) {
                # URL 다시 설정
                $refile_arr = explode('.', $data['upload_data']['file_name']);
                $refile = $refile_arr[0].'_thumb.'.$refile_arr[1];
                $save_url = '/saebom/data/editor/'.date('Ymd').'/'.$refile;
                unlink($data['upload_data']['full_path']);
            }
            echo json_encode(array('success' => true, 'save_url' =>  $save_url));
            exit();
        }
    }

    public function write_update(){

        $this->load->model('board_model');

        if($w == 'u'){
            $wr_id = $this->input->post('wr_id');
            if(!$wr_id) alert('게시물을 찾을 수 없습니다. ');
            $result = $this->board_model->get_board_info($wr_id);
            if(!$result){
                alert('게시물을 찾을 수 없습니다. ');
            }

            $data['board_info'] = $result;
        }

        $config['upload_path']   = './data/'.date("Ymd");
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 50000;
        $config['max_width']     = 50000;
        $config['max_height']    = 50000;

        @mkdir("$config[upload_path]", 0777);
        @chmod("$config[upload_path]", 0777);
        $this->load->library('upload', $config);
        $files = $_FILES;
        if(count($files['userfile']['name']) && $files['userfile']['name'] !='' ){
            $_FILES['userfile']['name'] = $files['userfile']['name'];
            $_FILES['userfile']['type'] = $files['userfile']['type'];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
            $_FILES['userfile']['error'] = $files['userfile']['error'];
            $_FILES['userfile']['size'] = $files['userfile']['size'];

            $this->upload->initialize($config);
            if ($this->upload->do_upload('userfile')) {
                $data = $this->upload->data();
            }else {
                alert($this->upload->display_errors());
            }
        }

        $data['subject'] = $_POST[subject];
        $data['content'] = $_POST[content];
        $data['category'] = $_POST[category];

        if($w == 'u') {
            $result = $this->board_model->review_update($data);
            if($result){
                redirect('/board/view/'.$result);
            }else{
                alert('글 수정에 실패하였습니다.');
            }
        }else{
            $result = $this->board_model->board_insert($data);
            if($result){
                redirect('/board/view/'.$result);
            }else{
                alert('글 작성에 실패하였습니다.');
            }
        }


    }
}