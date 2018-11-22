<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    Class User_model extends CI_Model {

    // Read data using username and password
        public function login($data) {
            $password = $this->sql_password($data['password']);
            $condition = "user_name =" . "'" . $data['username'] . "' AND " . "user_password =" . "'" . $password . "'";
            $this->db->select('*');
            $this->db->from('user_login');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return true;
            } else {
                return false;
            }
        }

    // Read data from database to show data in admin page
        public function read_user_information($username) {

            $condition = "user_name =" . "'" . $username . "'";
            $this->db->select('*');
            $this->db->from('user_login');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return $query->result();
            } else {
                return false;
            }
        }

        function sql_password($value){
            $row = $this->db->query(" select SHA2('$value', 256) as pass ")->row_array();
            return $row['pass'];
        }

    }
