<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function lists($kind='', $offset='', $limit='', $subject='', $content='', $category = '') {
        if($category) $this->db->where('category', $category);
        $this->db->order_by('wrt_datetime desc');
        $this->db->like('subject', $subject);
        $this->db->like('content', $content);
        $query=$this->db->get('board',$limit,$offset);

        if ($kind == 'num_rows') {
            $result=$query->num_rows();
        } else {
            $result=$query->result();
        }
        //echo $this->db->last_query();
        return $result;
    }


    function best_lists($kind='', $offset='0', $limit='3', $subject='', $content='') {
        $this->db->order_by('hits desc');
        $this->db->like('subject', $subject);
        $this->db->like('content', $content);
        $query=$this->db->get('board',$limit,$offset);

        $result=$query->result();
        return $result;
    }

    function desc($idx)
    {
        $query=$this->db->get_where('board',array('idx'=>$idx));
        $result=$query->row();
        return $result;
    }

    function insert($subject, $content)
    {
        $data=array(
            'subject'=>$subject,
            'content'=>$content
        );
        $this->db->insert('board',$data);
    }

    function view($idx)
    {
        $query=$this->db->get_where('board',array('idx'=>$idx));
        $result=$query->row_array();
        return $result;
    }
    function update($idx, $subject, $content)
    {
        $data=array(
            'subject'=>$subject,
            'content'=>$content
        );
        $this->db->where('idx',$idx);
        $this->db->update('board',$data);
    }

    function del($idx)
    {
        $this->db->delete('board',array('idx'=>$idx));
    }

    function truncate()
    {
        $this->db->truncate('board');
    }


}