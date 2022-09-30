<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Fr_model');
    }

	public function index()
	{

        $data = array(
            'title'     => 'Watch Data Now',
            'datacontent'   => $this->Fr_model->view_list(),
            'thema'     => $this->Fr_model->thema_list(),
        );


		$this->load->view('Layout/FE/Head', $data);
		$this->load->view('Main/Frontend', $data);
		$this->load->view('Layout/FE/Footer');
	}
}
