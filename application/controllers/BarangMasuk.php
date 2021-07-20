<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangMasuk extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation','pagination','session'));
        $this->load->model('Auth_model');
        $this->load->model('Calendar_model');
        $this->load->model('Inventory_model');
        $this->load->model('Transaksi_model');
        if($this->Auth_model->isNotLogin()) redirect('auth');
    }

	public function index()
	{
        $data['bk'] = $this->Transaksi_model->showFilterBarangMasuk('1')->result();
        $data['barang'] = $this->Transaksi_model->showBarangMasuk('2')->result();

		$this->load->view('parts/header');
        $this->load->view('parts/sidebar');
		$this->load->view('v_barang-masuk', $data);
		$this->load->view('parts/footer');
	}

    public function add()
    {
        if($this->input->get() != NULL){
            $surat = $this->input->get('nosurat');

            $data['barang'] = $this->Inventory_model->showLogistik()->result();
            $data['bk'] = $this->Transaksi_model->showCartPengembalian($surat)->result();
            $data['info'] = $this->Transaksi_model->detailEditTransaksi($surat)->row();
            $data['autonumber'] = $this->Transaksi_model->buat_kode(); 
            $data['batas'] = $this->Transaksi_model->showCartBarangKeluar($surat)->num_rows();
    
            $data['tujuan'] = $data['info']->tujuan;
            $data['no_telp'] = $data['info']->no_telp;
            $data['penerima'] = $data['info']->penerima;
            $data['nosurat'] = $surat;
    
            $this->load->view('parts/header');
            $this->load->view('parts/sidebar');
            $this->load->view('v_add-barang-masuk', $data);
            $this->load->view('parts/footer');
        }else{
            redirect('barangmasuk');
        }

    }

    public function create()
    {
        $id = $this->input->post('id');
        $idbrg = $this->input->post('idbrg');
        $nosurat = $this->input->post('surat');

        $datakembali = array(
            'status_barang' => $this->input->post('status'),
            'keterangan' => $this->input->post('catatan'),
            'status_transaksi' => 'F',
            'updated_at' => $this->Calendar_model->indocal()
        );

        $datamasuk = array(
            'surat_jalan' => $nosurat,
            'id_brg' => $idbrg,
            'jumlah_transaksi' => $this->input->post('jumlah'),
            'jenis_transaksi' => 'masuk',
            'created_at' => $this->Calendar_model->indocal()
        );
        
        $kembali = $this->Transaksi_model->restokBarangKeluar($id, $datakembali);
        $balikstok = $this->Inventory_model->reStok($idbrg, $this->input->post('jumlah'));
        $simpan = $this->Transaksi_model->createBarangMasuk($datamasuk);

        if($simpan)
        {
            $this->session->set_flashdata('message','successfull');
            redirect('barangmasuk/add?nosurat='.$nosurat);
        }
        else
        {
            $this->session->set_flashdata('message','error');
            redirect('barangmasuk/add?nosurat='.$nosurat);
        }
    }

    public function changetransaksi()
    {
        $nosurat = $this->input->post('nomor');

        $data = array(
            'transaksi_status' => '2',
            'updated_at' => $this->Calendar_model->indocal()
        );

        $simpan = $this->Transaksi_model->createTransaksiMasuk($nosurat, $data);

        if($simpan)
        {
            $this->session->set_flashdata('message','successfull'); 
            redirect('barangmasuk');
        }
        else
        {
            $this->session->set_flashdata('message','error'); 
            redirect('barangmasuk');
        }

    }

    public function show($surat)
    {
        $data['informasi'] = $this->Transaksi_model->showTransaksiMasuk($surat)->row();
        $data['bk'] = $this->Transaksi_model->showCartBarangMasuk($surat)->result();

        $data['nomor'] = $data['informasi']->surat_jalan;
        $data['penerima'] = $data['informasi']->penerima;
        $data['tujuan'] = $data['informasi']->tujuan;
        $data['no_telp'] = $data['informasi']->no_telp;
        $data['tgl_masuk'] = $data['informasi']->tgl_masuk;

        $this->load->view('parts/header');
        $this->load->view('parts/sidebar');
		$this->load->view('v_detail-transaksi-masuk', $data);
		$this->load->view('parts/footer');
        // var_dump($data['informasi']);
    }

    public function deletetransaksi()
    {
        $surat = $this->input->post('surat');
        
        $data = array(
            'status_barang' => 'b',
            'keterangan' => '-',
            'status_transaksi' => 'T'
        );

        $datatransaksi = array(
            'transaksi_status' => '1',
            'updated_at' => $this->Calendar_model->indocal()
        );

        $editcart = $this->Transaksi_model->editCartKeluar($surat, $data);
        $deletecartmasuk = $this->Transaksi_model->deleteCartMasuk($surat);
        $edittransaksi = $this->Transaksi_model->createTransaksiMasuk($surat, $datatransaksi);
        
        
        if($edittransaksi)
        {
            $this->session->set_flashdata('message3','successfull');
            redirect('barangmasuk');
        }
        else
        {
            $this->session->set_flashdata('message3','error');
            redirect('barangmasuk');
        }
    }

}
