<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Content_model');
        $this->load->library('form_validation');
        // $this->load->library('excel');
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


// public function importdata() { 
//     include APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';

//     $config['upload_path'] = realpath('excel');
//     $config['allower_types'] = 'xlsx|xls|csv';
//     $config['mx_size'] = '10000';
//     $config['encrypt_name'] = true;

//     $this->load->library('upload', $config);

//     if(!$this->upload->do_upload()) {
//         $this->session->set_flashdata('sukses','<div class="alert alert-danger">Gagal Import Data'.$this->upload->display_errors().'</div>');

//         redirect('Content');
//     } else {
//         $data_upload    = $this->upload->data();
//         $excelreader    = new PHPExcel_Reader_Excel2007();
//         $loadExcel      = $excelreader->load('excel/'.$data_upload['file_name']);
//         $sheet = $loadExcel->getActiveSheet()->toArray(null, true, true);

//         $data = array();

//          $numrow = 1;
//          foreach ($sheet as $row) {
//             if($numrow > 1) {
//                 array_push($data, array(
//                     'name_data' => $row['A'],
//                     'text_data' => $row['B'],
//                     'content_data' => $row['C'],
//                     'state' => $row['D'],
//                 ));
//             }

//             $numrow++;
//          }

//          $this->db->insert_batch('tb_data', $data);

//          unlink(realpath('excel/'.$data_upload['file_name']));

//          // Upload Suksess
//          $this->session->set_flashdata('sukses','<div class="alert alert-danger">Berhasil !!!</div>');
//          redirect('Content');

//     }


// }

// public function import_excel() {
//     if(isset($_FILES['import']['name'])) {
//         $path = $_FILES["import"]["tmp_name"];
//         $object = PHPExcel_IOFactory::load($path);

//         foreach ($object->getWorksheetIterator() as $worksheet) {
//             $highestRow = $worksheet->getHighestRow();
//             $highestColumn = $worksheet->getHighestColumn();

//             for($row =2 ; $row<=$highestRow; $row++) {
//                 $name_data = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
//                 $text_data = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
//                 $content_data = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
//                 $state = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

//                 $temp_data[] = array(
//                     'name_data'     => $name_data,
//                     'text_data'     => $text_data,
//                     'content_data'  => $content_data,
//                     'state'         => $state,
//                 );
//             }
//         }

//         $insert = $this->Content_model->import($temp_data);

//         if($insert) {
//             $this->session->set_flashdata('sukses', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import ke Database');
// 				redirect($_SERVER['HTTP_REFERER']);
//         } else {
//             $this->session->set_flashdata('sukses', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
// 				redirect($_SERVER['HTTP_REFERER']);
//         }
//     } else {
//         echo "Tidak ada file insert";
//     }
// }
}
