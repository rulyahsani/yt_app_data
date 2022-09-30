<?php

class Fr_model extends CI_Model
{
public function view_list() {
        $result = $this->db->query("SELECT * FROM tb_data");
        return $result->result();
    }
    
public function thema_list() {
       $content =  $this->db->get('tb_setting');
       return $content->row();
    }

}