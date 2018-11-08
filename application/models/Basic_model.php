<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basic_model extends CI_Model {

    function get_total_rows($tb_name, $where, $like_where = array(), $in_where = array(), $not_in = array()) {

        if (count($like_where) > 0)  {
            foreach($like_where as $in_key => $in_data){
                if(is_array($in_data)){
                    $condition = "(";
                    for($i = 0 ; $i < count($in_data); $i++){
                        $or = $i != 0 ? " or " : "";
                        $condition.= $or . $in_key . " like '%".$in_data[$i]."%'";
                    }
                    $condition .= ")";
                    $this->db->where($condition, null, false);
                }else{
                    $this->db->like($in_key, $in_data);
                }
            }
        }

        if (count($in_where) > 0)  {
            foreach($in_where as $in_key=>$in_data)
                $this->db->where_in($in_key, $in_data);
        }

        if(count($not_in) > 0){
            foreach($not_in as $in_key=>$in_data)
                $this->db->where_not_in($in_key, $in_data);
        }

        $this->db->where($where);
        $this->db->from($tb_name);

        $result = $this->db->count_all_results();
        log_message("info", $this->db->last_query());
        return $result;
    }

    function get_total_sum($tb_name, $where, $sum_field, $like_where = array(), $in_where = array(), $not_in = array()) {
        if (count($like_where) > 0)  $this->db->or_like($like_where);
        if (count($in_where) > 0)  {
            foreach($in_where as $in_key=>$in_data)
                $this->db->where_in($in_key, $in_data);
        }

        if(count($not_in) > 0){
            foreach($not_in as $in_key=>$in_data)
                $this->db->where_not_in($in_key, $in_data);
        }

        $this->db->select_sum($sum_field, 'sum_field');
        $result = $this->db->get_where($tb_name, $where)->row_array();
        return $result['SUM_FIELD'];
    }

    function gets($tb_name, $where = array(), $start = null, $limit = null, $order, $like_where = array()){
        if (count($like_where) > 0)  $this->db->or_like($like_where);
        $this->db->order_by($order['order_field'], $order['order_method']);
        $result = $this->db->get_where($tb_name, $where, $limit, $start)->result();
        log_message("info", $this->db->last_query());
        return $result;
    }

    function gets_array($tb_name, $where = array(), $start = null, $limit = null, $order = null, $like_where = array(), $in_where = array(), $not_in_where = array()){
        if (count($like_where) > 0)  {

            foreach($like_where as $in_key => $in_data){
                if(is_array($in_data)){
                    $condition = "(";
                    for($i = 0 ; $i < count($in_data); $i++){
                        $or = $i != 0 ? " or " : "";
                        $condition.= $or . $in_key . " like '%".$in_data[$i]."%'";
                    }
                    $condition .= ")";
                    $this->db->where($condition, null, false);
                }else{
                    $this->db->like($in_key, $in_data);
                }
            }
        }

        if (count($in_where) > 0)  {
            foreach($in_where as $in_key=>$in_data) {
                $this->db->where_in($in_key, $in_data);
            }
        }
        if (count($not_in_where) > 0 ){
            foreach($not_in_where as $not_in_key=>$not_in_data) {
                $this->db->where_not_in($not_in_key, $not_in_data);
            }
        }
        if ($order != null) {
            if (is_array($order)) {
                $this->db->order_by($order['order_field'], $order['order_method']);
            }else{
                $this->db->order_by($order);
            }
        }

        $result = $this->db->get_where($tb_name, $where, $limit, $start)->result_array();
        log_message("info", $this->db->last_query());
        return $result;
    }

    function get($tb_name, $where = array()) {
        $result = $this->db->get_where($tb_name, $where)->row();
        log_message("info", $this->db->last_query());
        return $result;
    }

    function get_array($tb_name, $where = array(), $where_like = array(), $where_in = array()) {
        if (count($where_like) > 0)  $this->db->or_like($where_like);
        if (count($where_in) > 0)  {
            foreach($where_in as $in_key=>$in_data)
                $this->db->where_in($in_key, $in_data);
        }

        $result = $this->db->get_where($tb_name, $where)->row_array();
        log_message("info", $this->db->last_query());
        return $result;
    }

    function get_site_gnb(){
        $this->db->select('menu_name');
        $this->db->from('GNB_MENU');
        $this->db->order_by("order", "asc");
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;

    }

    function get_where_been(){
        $this->db->from('area_been');
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;

    }

}