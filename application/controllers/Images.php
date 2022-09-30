<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Images extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Images_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		
        $data = array(
            'title' => 'Images',
            // 'dataimage' => $this->Images_model->showdata(),
        );

        $this->load->view('Layout/Header', $data);
        $this->load->view('Layout/Sidebar', $data);
        $this->load->view('Main/Images', $data);
        $this->load->view('Layout/Footer', $data);
	}

    public function dataview(){
        $data = $this->Images_model->view_list();
        echo json_encode($data);
    }

    public function upload() {
        $config['upload_path'] = './assets/upload/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('img'))
        {
            $data = array('upload_data'   => $this->upload->data());
            $name = $this->input->post('name');
            $image = $data['upload_data']['file_name'];

            $result = $this->Images_model->save_upload($name, $image);

            echo json_decode($result);
            
        } else {
            $data = $this->upload->data();

        }
    }
}