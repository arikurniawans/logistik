<?php

class Satuan_model extends CI_Model
{

    public function createSatuan($data)
    {
        $jenis = $this->db->insert('satuan_logistik',$data);
        return $jenis;
    }

    public function showSatuan()
    {
        $query = $this->db->get('v_satuan');     
        return $query;
    }

    public function editSatuan($id,$data)
    {
        $this->db->where('id_satuan',$id);
        $this->db->update('satuan_logistik',$data);
        return true;
    }

    public function deleteSatuan($id)
    {
        $this->db->where('id_satuan',$id);
        $this->db->delete('satuan_logistik');
        return true;
    }

}