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

    public function showLogistik()
    { 
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

}