<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Thema extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Thema_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data = array(
            'title' => 'Thema Content',
        );

        $this->load->view('Layout/Header', $data);
        $this->load->view('Layout/Sidebar', $data);
        $this->load->view('Main/Thema', $data);
        $this->load->view('Layout/Footer', $data);
    }

    // public function add()
    // {
    //     if ($_POST["action"] == "Add") {
    //         $insert = array(
    //             'head_title' => $this->input->post('head_title'),
    //             'subtitle' => $this->input->post('subtitle'),
    //             'background' => $this->upload_image(),
    //         );

    //         $this->Thema_model->insertData($insert);
    //         $this->session->set_flashdata('sukses', '<div class="alert alert-danger" role="alert">Password Salah</div>');
    //     }
    // }

    // public function upload_image()
    // {
    //     if (isset($_FILES["background"])) {
    //         $extension = explode('.', $_FILES['background']['name']);
    //         $new_name = rand() . '.' . $extension[1];
    //         $destination = './upload/' . $new_name;
    //         move_uploaded_file($_FILES['background']['tmp_name'], $destination);
    //         return $new_name;
    //     }
    // }

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
        $data = $this->Thema_model->view_list();
        echo json_encode($data);
    }


    // public function add_data() {
    //     if($this->input->is_ajax_request() == true) {
    //         $head = $this->input->post('headtitle');
    //         $subtitle = $this->input->post('subtitle');

    //         $this->form_validation->set_rules('headtitle', 'Headtitle', 'trim|required');
    //         $this->form_validation->set_rules('subtitle', 'Subtitle', 'trim|required');

    //         if($this->form_validation->run() == true) {
    //             $this->Thema_model->save($head, $subtitle);
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

            if($this->upload->do_upload('background'))
            {
                $data = array('upload_data'   => $this->upload->data());
                $head_title = $this->input->post('head_title');
                $subtitle = $this->input->post('subtitle');
                $background = $data['upload_data']['file_name'];

                $result = $this->Thema_model->save_upload($background, $head_title, $subtitle);

                echo json_decode($result);
                
            } else {
                $data = $this->upload->data();

            }
        
    }

    public function getId() {
        $id = $this->input->post('id_setting');
        $where = array('id_setting' => $id);
        $datacontent = $this->Thema_model->ambilId('tb_setting', $where)->result();

        echo json_encode($datacontent);
    }

    public function deletedata() {
        $id = $this->input->post('id_setting');
        $where = array('id_setting' => $id);

        $this->Thema_model->hapus($where, 'tb_setting');
    }

}
