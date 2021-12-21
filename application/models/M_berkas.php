<?php 

class M_berkas extends CI_Model{

    public function getTable(){
        return $this->db->get('set_berkas');
    }

    public function berkas_upload($data, $table){
        $this->db->insert($table, $data);
    }
    public function file_exists($table, $data){
       return $this->db->get_where($table, $data);
    }

}

?>