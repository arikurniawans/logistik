<?php

class Jenis_model extends CI_Model
{

    public function createJenis($data)
    {
        $jenis = $this->db->insert('jenis_logistik',$data);
        return $jenis;
    }

    public function showJenis()
    {
        $this->db->order_by('id_jenis','DESC');  
        $query = $this->db->get('jenis_logistik');     
        return $query;
    }

    public function editJenis($id,$data)
    {
        $this->db->where('id_jenis',$id);
        $this->db->update('jenis_logistik',$data);
        return true;
    }

    public function deleteJenis($id)
    {
        $this->db->where('id_jenis',$id);
        $this->db->delete('jenis_logistik');
        return true;
    }

}