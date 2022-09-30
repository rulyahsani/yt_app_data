<?php

class Content_model extends CI_Model
{
public function view_list() {
        $result = $this->db->query("SELECT * FROM tb_data");
        return $result->result();
    }

    // public function save($name_data, $text_data, $content_data) {
    //     $data = [
    //         'name_data' => $name_data,
    //         'text_data' => $text_data,
    //         'content_data'  => $content_data,
    //     ];

    //     $this->db->insert('tb_data', $data);
    // }

    public function save_upload($name_data, $text_data, $content_data, $image) {
        $data = array(
            'name_data'    => $name_data,
            'text_data'    => $text_data,
            'content_data'    => $content_data,
            'image' => $image
        );

        $result = $this->db->insert('tb_data', $data);
        return $result;
    }

    public function hapus($where, $table) {
        $this->db->where($where);
        $this->db->delete($table);
    } 
}