<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Content_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		
        $data = array(
            'title' => 'Content Master Data',
        );

        $this->load->view('Layout/Header', $data);
        $this->load->view('Layout/Sidebar', $data);
        $this->load->view('Main/Content', $data);
        $this->load->view('Layout/Footer', $data);
	}

    // public function themaImg(){
    //     if(isset($_FILES["background"]['name'])) {
    //         $config['upload_path'] = './upload/';  
    //           $config['allowed_types'] = 'jpg|jpeg|png|gif';  
    //           $this->load->library('upload', $config); 
    //           if(!$this->upload->do_upload('background')) {
    //             $error =  $this->upload->display_errors(); 
    //               echo json_encode(array('msg' => $error, 'success' => false));
    //           } else {
    //             $data = $this->upload->data();
    //             $insert['name'] = $data['file_name'];
    //             $this->db->insert('tb_setting', $insert);
    //             $getId = $this->db->insert_id();

    //             $arr = array('msg' => 'Image has not uploaded successfully', 'success' => false);
    //             if($getId) {
    //                 $arr = array('msg' => 'Image has been uploaded successfully', 'success' => true);
    //             }
    //             echo json_encode($arr);
    //           }
    //     }
    // }

    public function dataview(){
        $data = $this->Content_model->view_list();
        echo json_encode($data);
    }


    // public function add_data() {
    //     if($this->input->is_ajax_request() == true) {
    //         $name_data = $this->input->post('name_data');
    //         $text_data = $this->input->post('text_data');
    //         $content_data = $this->input->post('content_data');

    //         $this->form_validation->set_rules('name_data', 'Name_data', 'trim|required');
    //         $this->form_validation->set_rules('text_data', 'Text_data', 'trim|required');
    //         $this->form_validation->set_rules('content_data', 'Content_data', 'trim|required');

    //         if($this->form_validation->run() == true) {
    //             $this->Content_model->save($name_data, $text_data, $content_data);
    //             $msg = [
    //                 'success' => 'Berhasil',
    //             ];
    //         } else {
    //             $msg = [
    //                 'error' => '<div class="alert alert-danger">'.validation_errors().'</div>',
    //             ];
    //         }

    //         echo json_encode($msg);
    //     }
    // }

    function upload() {
       
        $config['upload_path'] = './assets/upload/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('image'))
        {
            $data = array('upload_data'   => $this->upload->data());
            $name_data = $this->input->post('name_data');
            $text_data = $this->input->post('text_data');
            $content_data = $this->input->post('content_data');
            $image = $data['upload_data']['file_name'];

            $result = $this->Content_model->save_upload($name_data, $text_data, $content_data, $image);

            echo json_decode($result);
            
        } else {
            $data = $this->upload->data();

        }
    
}

public function deletedata() {
    $id = $this->input->post('id_data');
    $where = array('id_data' => $id);

    $this->Content_model->hapus($where, 'tb_data');
}
}
