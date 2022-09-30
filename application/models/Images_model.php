<?php

class Images_model extends CI_Model {
    
    public function view_list() {
        $result = $this->db->query("SELECT * FROM tb_images");
        return $result->result();
    }

    public function save_upload($name, $image) {
        $data = array(

            'name'    => $name,
            'img' => $image
        );

        $result = $this->db->insert('tb_images', $data);
        return $result;
    }
}
?>