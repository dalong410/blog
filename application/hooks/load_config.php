<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class load_config
{
    function get_basic_config()
    {
        $CI =& get_instance();
        if( !$CI->session->userdata('cf_register_level') ){
            $CI->load->database();
            $config_list = $CI->basic_model->get_config(); // 기본환경설정
            $CI->session->set_userdata($config_list);
        }
    }
}