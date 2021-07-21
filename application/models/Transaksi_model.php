<?php

class Transaksi_model extends CI_Model
{

    public function createBarangKeluar($data)
    {
        $jenis = $this->db->insert('cart_transaksi',$data);
        return $jenis;
    }

    public function createTransaksiMasuk($surat,$data)
    {
        $this->db->where('surat_jalan', $surat);
        $this->db->update('transaksi', $data);
        return true;
    }

    public function createBarangMasuk($data)
    {
        $jenis = $this->db->insert('cart_transaksi',$data);
        return $jenis;
    }

    public function showCartBarangKeluar($surat)
    { 
        $this->db->select("cart_transaksi.id_cart, cart_transaksi.id_brg, cart_transaksi.surat_jalan, 
                        barang_logistik.kode_barang, cart_transaksi.status_transaksi,
                        barang_logistik.nama_barang,sum(cart_transaksi.jumlah_transaksi) AS jml_transaksi,
                        satuan_logistik.satuan");
        $this->db->from('cart_transaksi');
        $this->db->join('barang_logistik','barang_logistik.id_barang=cart_transaksi.id_brg');
        $this->db->join('satuan_logistik','satuan_logistik.id_satuan=barang_logistik.satuan_barang');
        $this->db->where('cart_transaksi.surat_jalan', $surat);
        $this->db->where('cart_transaksi.jenis_transaksi', 'keluar');
        // $this->db->where('cart_transaksi.status_transaksi', 'T');
        $this->db->group_by('cart_transaksi.id_brg');
        $query = $this->db->get();
        return $query;
    }

    public function showCartBarangMasuk($surat)
    { 
        $this->db->select("cart_transaksi.id_cart, cart_transaksi.id_brg, cart_transaksi.surat_jalan, 
                        barang_logistik.kode_barang, cart_transaksi.status_transaksi,
                        barang_logistik.nama_barang,sum(cart_transaksi.jumlah_transaksi) AS jml_transaksi,
                        satuan_logistik.satuan");
        $this->db->from('cart_transaksi');
        $this->db->join('barang_logistik','barang_logistik.id_barang=cart_transaksi.id_brg');
        $this->db->join('satuan_logistik','satuan_logistik.id_satuan=barang_logistik.satuan_barang');
        $this->db->where('cart_transaksi.surat_jalan', $surat);
        $this->db->where('cart_transaksi.jenis_transaksi', 'masuk');
        // $this->db->where('cart_transaksi.status_transaksi', 'T');
        $this->db->group_by('cart_transaksi.id_brg');
        $query = $this->db->get();
        return $query;
    }

    public function showCartPengembalian($surat)
    { 
        $this->db->select("cart_transaksi.id_cart, cart_transaksi.id_brg, cart_transaksi.surat_jalan, 
                        barang_logistik.kode_barang, 
                        barang_logistik.nama_barang,sum(cart_transaksi.jumlah_transaksi) AS jml_transaksi,
                        satuan_logistik.satuan");
        $this->db->from('cart_transaksi');
        $this->db->join('barang_logistik','barang_logistik.id_barang=cart_transaksi.id_brg');
        $this->db->join('satuan_logistik','satuan_logistik.id_satuan=barang_logistik.satuan_barang');
        $this->db->where('cart_transaksi.surat_jalan', $surat);
        $this->db->where('cart_transaksi.jenis_transaksi', 'keluar');
        $this->db->where('cart_transaksi.status_transaksi', 'T');
        $this->db->group_by('cart_transaksi.id_brg');
        $query = $this->db->get();
        return $query;
    }

    public function showGrafik($bulan)
    {
        $query = $this->db->get_where('v_grafik_transaksi' , array("DATE_FORMAT(tgl_transaksi, '%m') = " => $bulan));
        return $query;
    }

    public function showBarangKeluar()
    {
        $query = $this->db->get_where('v_transaksi_keluar' , array('transaksi_status' => '1'));
        return $query;
    }

    public function showBarangMasuk($status)
    {
        $query = $this->db->get_where('v_transaksi_masuk', array('transaksi_status' => $status));
        return $query;
    }

    public function showFilterBarangMasuk($status)
    {
        $query = $this->db->get_where('transaksi', array('transaksi_status' => $status));
        return $query;
    }

    public function showFilterKeluar($tgl1, $tgl2)
    {
        $this->db->where('transaksi_status', '1');
        $this->db->where('tgl_keluar >=', $tgl1);
        $this->db->where('tgl_keluar <=', $tgl2);
        $query = $this->db->get('v_transaksi_keluar');
        return $query;
    }

    public function showFilterMasuk($tgl1, $tgl2)
    {
        $this->db->where('transaksi_status', '2');
        $this->db->where('tgl_masuk >=', $tgl1);
        $this->db->where('tgl_masuk <=', $tgl2);
        $query = $this->db->get('v_transaksi_masuk');
        return $query;
    }

    public function detailTransaksi($surat, $barang)
    { 
        $query = $this->db->get_where('cart_transaksi', array('surat_jalan' => $surat, 'id_brg' => $barang));     
        return $query;
    }

    public function showTransaksi($surat)
    {
        $this->db->select('*,DATE_FORMAT(created_at, "%Y-%m-%d") AS tgl_keluar');
        $this->db->from('transaksi');
        $this->db->where('surat_jalan',$surat);
        $query = $this->db->get();
        return $query;
    }

    public function showTransaksiMasuk($surat)
    {
        $this->db->select('*,DATE_FORMAT(updated_at, "%Y-%m-%d") AS tgl_masuk');
        $this->db->from('transaksi');
        $this->db->where('surat_jalan',$surat);
        $query = $this->db->get();
        return $query;
    }

    public function detailCart($surat, $idbrg)
    { 
        $this->db->select('*');
        $this->db->from('cart_transaksi');
        $this->db->where('surat_jalan', $surat);
        $this->db->where('id_brg', $idbrg);
        $query = $this->db->get();     
        return $query;
    }

    public function detailEditTransaksi($surat)
    { 
        $query = $this->db->get_where('v_transaksi_keluar', array('surat_jalan' => $surat));     
        return $query;
    }

    public function editTransaksi($surat,$data)
    {
        $this->db->where('surat_jalan', $surat);
        $this->db->update('transaksi', $data);
        return true;
    }

    public function editBarangKeluar($id, $jumlah)
    {
        $this->db->query("UPDATE cart_transaksi SET jumlah_transaksi=jumlah_transaksi+$jumlah WHERE id_brg='$id'");
        return true;
    }

    public function deleteBarangkeluar($id)
    {
        $this->db->where('id_cart', $id);
        $this->db->delete('cart_transaksi');
        return true;
    }


    public function editCartKeluar($surat,$data)
    {
        $this->db->where('surat_jalan', $surat);
        $this->db->where('jenis_transaksi', 'keluar');
        $this->db->update('cart_transaksi', $data);
        return true;
    }

    public function deleteCartMasuk($surat)
    {
        $this->db->where('surat_jalan', $surat);
        $this->db->where('jenis_transaksi', 'masuk');
        $this->db->delete('cart_transaksi');
        return true;
    }

    public function deleteTran($id)
    {
        $this->db->where('surat_jalan',$id);
        $this->db->delete('transaksi');
        return true;
    }

    public function restokBarangKeluar($id,$data)
    {
        $this->db->where('id_cart', $id);
        $this->db->update('cart_transaksi', $data);
        return true;
    }

    public function buat_kode()   {

        $this->db->select('RIGHT(transaksi.id_transaksi,4) as kode', FALSE);
        $this->db->order_by('id_transaksi','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('transaksi');      //cek dulu apakah ada sudah ada kode di tabel.    
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
        $kodejadi = "SJ".$kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;  
  }

}