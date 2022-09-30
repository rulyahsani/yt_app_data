<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller { 

    function __construct() {
        parent:: __construct();
        if($this->session->userdata('status') != "login") {
            redirect(base_url("Auth"));
        }
    }
    
        
    
    public function index() {

        $data = [
            'title'  => 'Dashboard Admin',
        ];

        $this->load->view('Layout/Header', $data);
        $this->load->view('Layout/Sidebar', $data);

            $this->load->view('Main/Admin');
            $this->load->view('Layout/Footer');
    }
}