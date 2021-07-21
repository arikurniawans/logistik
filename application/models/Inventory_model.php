<?php

class Inventory_model extends CI_Model
{

    public function createInventory($data)
    {
        $jenis = $this->db->insert('barang_logistik',$data);
        return $jenis;
    }

    public function createTransaksi($data)
    {
        $jenis = $this->db->insert('transaksi',$data);
        return $jenis;
    }

    public function showInventory()
    { 
        $query = $this->db->get('v_inventory');     
        return $query;
    }

    public function minInventory()
    { 
        $this->db->where('stok <=', '10');
        // $this->db->limit(5);
        $query = $this->db->get('v_inventory');
        return $query;
    }

    public function showLogistik()
    { 
        $this->db->where_not_in('stok', '0');
        $query = $this->db->get('barang_logistik');     
        return $query;
    }

    public function detailInventory($id)
    { 
        $query = $this->db->get_where('v_inventory', array('id_barang' => $id));     
        return $query;
    }

    public function ScanInventory($id)
    { 
        $query = $this->db->get_where('v_inventory', array('kode_barang' => $id));     
        return $query;
    }

    public function ScanTransaksi($kode)
    { 
        $this->db->select('v_inventory.kode_barang, v_inventory.nama_barang, 
                            v_inventory.stok, v_inventory.satuan, v_inventory.jenis, 
                            SUM(cart_transaksi.jumlah_transaksi) AS jmlh_transaksi, 
                            cart_transaksi.jenis_transaksi, cart_transaksi.status_barang, 
                            cart_transaksi.keterangan');
        $this->db->from('cart_transaksi');
        $this->db->join('v_inventory','v_inventory.id_barang=cart_transaksi.id_brg');
        $this->db->where('kode_barang', $kode);
        $this->db->group_by('jenis_transaksi');
        $query = $this->db->get();
        return $query;
    }

    public function editInventory($id,$data)
    {
        $this->db->where('id_barang',$id);
        $this->db->update('barang_logistik',$data);
        return true;
    }

    public function deleteInventory($id)
    {
        $this->db->where('id_barang',$id);
        $this->db->delete('barang_logistik');
        return true;
    }

    public function editStok($id, $stok)
    {
        $this->db->query("UPDATE barang_logistik SET stok=stok-$stok WHERE id_barang='$id'");
        return true;
    }

    public function reStok($id, $stok)
    {
        $this->db->query("UPDATE barang_logistik SET stok=stok+$stok WHERE id_barang='$id'");
        return true;
    }

    public function generate_kode()   {

        $this->db->select('RIGHT(barang_logistik.id_barang,4) as kode', FALSE);
        $this->db->order_by('id_barang','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('barang_logistik');      //cek dulu apakah ada sudah ada kode di tabel.    
        if($query->num_rows() <> 0){      
         //jika kode ternyata sudah ada.      
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
        }
        else {      
         //jika kode belum ada      
         $kode = 1;    
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = "BR".$kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;  
  }

}