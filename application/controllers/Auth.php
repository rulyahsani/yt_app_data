<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Login_model');
    }

    public function index() {

        $this->form_validation->set_rules('username', 'username','trim|required');
        $this->form_validation->set_rules('password', 'Password','trim|required');
        

        if($this->form_validation->run() == false) {
            $data = array( 
                'title'  => 'Login User',
            );
            $this->load->view('Layout/Header', $data);
            $this->load->view('Auth/Login');
            $this->load->view('Layout/Footer');
        } else {
            $this->_login();
        }
    }

    private function _login() {
        $username 			= $this->input->post('username');
		$password 		    = $this->input->post('password');

        $where = array(
            'username'  => $username,
            'password' => $password
        );

        $cek = $this->Login_model->cek_login("tb_login", $where)->num_rows();

        if($cek > 0) {

            $data_session = array(
                'username'     => $username,
                'status'        => 'login',

            );

            $this->session->set_userdata($data_session);
            redirect(base_url("Admin"));

        } else {
            $this->session->set_flashdata('sukses','<div class="alert alert-danger" role="alert">Password Salah</div>');
            redirect('Auth');
        }

    
}


public function logout() {
    $this->session->sess_destroy();
    redirect(base_url('Auth'));
}

}
