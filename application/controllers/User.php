<?php
//session_start(); //we need to start session in order to access it through CI
Class User extends MY_Controller {

    public function __construct() {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
        // Load session library
       // $this->load->library();
        // Load database
        $this->load->model('user_model');
    }
    // Show login page
    public function index() {
        $this->load->view('login');
    }
    // Show login page
    public function login() {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('admin_page');
        }else{
            $this->load->view('login');
        }
    }

// Check for user login process
    public function user_login_process() {

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            /*if(isset($this->session->userdata['logged_in'])){
                $this->load->view('admin_page');
            }else{
                $this->load->view('login');
            }*/
            $this->load->view('login');
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );
            $result = $this->user_model->login($data);
            if ($result == TRUE) {

                $username = $this->input->post('username');
                $result = $this->user_model->read_user_information($username);
                if ($result != false) {
                    $session_data = array(
                        'username' => $result[0]->user_name,
                        'email' => $result[0]->user_email,
                    );
// Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    $this->load->view('admin_page');
                    //redirect('/saebom/user/admin_page');
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('login', $data);
            }
        }
    }

// Logout from admin page
    public function logout() {
        // Removing session data
        $sess_array = array(
            'username' => '',
            
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('login', $data);
    }

    public function admin_page() {
        $this->load->view('admin_page');
    }

}

?>