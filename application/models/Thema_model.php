<?php

class Thema_model extends CI_Model
{

    function insertData($data)
    {
        $this->db->insert('tb_setting', $data);
    }

    public function view_list() {
        $result = $this->db->query("SELECT * FROM tb_setting");
        return $result->result();
    }

    // public function save($head, $subtitle) {
    //     $data = [
    //         'head_title'  => $head,
    //         'subtitle' => $subtitle
    //     ];

    //     $this->db->insert('tb_setting', $data);
    // }

    public function save_upload($background, $head_title, $subtitle) {
        $data = array(
            'head_title'    => $head_title,
            'subtitle'    => $subtitle,
            'background' => $background
        );

        $result = $this->db->insert('tb_setting', $data);
        return $result;
    }


    public function ambilId($table, $where) {
        return $this->db->get_where($table, $where);
    }

    public function hapus($where, $table) {
        $this->db->where($where);
        $this->db->delete($table);
    } 
}
