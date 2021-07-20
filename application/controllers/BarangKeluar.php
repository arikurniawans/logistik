<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangKeluar extends CI_Controller {

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
        $data['barang'] = $this->Transaksi_model->showBarangKeluar()->result();

		$this->load->view('parts/header');
        $this->load->view('parts/sidebar');
		$this->load->view('v_barang-keluar', $data);
		$this->load->view('parts/footer');
	}

    public function add()
	{
        $data['barang'] = $this->Inventory_model->showLogistik()->result();
        $data['bk'] = $this->Transaksi_model->showCartBarangKeluar($this->Transaksi_model->buat_kode())->result();
        $data['autonumber'] = $this->Transaksi_model->buat_kode(); 
        $data['batas'] = $this->Transaksi_model->showCartBarangKeluar($this->Transaksi_model->buat_kode())->num_rows();

		$this->load->view('parts/header');
        $this->load->view('parts/sidebar');
		$this->load->view('v_add-barang-keluar', $data);
		$this->load->view('parts/footer');
        //var_dump($data['bk']);
	}

    public function edit($surat)
    {
        $data['barang'] = $this->Inventory_model->showLogistik()->result();
        $data['bk'] = $this->Transaksi_model->showCartBarangKeluar($surat)->result();
        $data['info'] = $this->Transaksi_model->detailEditTransaksi($surat)->row();
        $data['autonumber'] = $this->Transaksi_model->buat_kode(); 
        $data['batas'] = $this->Transaksi_model->showCartBarangKeluar($surat)->num_rows();

        $data['tujuan'] = $data['info']->tujuan;
        $data['no_telp'] = $data['info']->no_telp;
        $data['penerima'] = $data['info']->penerima;
        $data['nosurat'] = $surat;

		$this->load->view('parts/header');
        $this->load->view('parts/sidebar');
		$this->load->view('v_edit-barang-keluar', $data);
		$this->load->view('parts/footer');
        //var_dump($data['info']);
    }

    public function create()
    {
        $data = array(
            'surat_jalan' => $this->Transaksi_model->buat_kode(),
            'id_brg' => $this->input->post('barang'),
            'jumlah_transaksi' => $this->input->post('jumlah'),
            'jenis_transaksi' => 'keluar',
            'created_at' => $this->Calendar_model->indocal()
        );

        $cek = $this->Transaksi_model->detailTransaksi($this->Transaksi_model->buat_kode(), $this->input->post('barang'))->row();
        
        if($cek != NULL)
        {
            $simpan = $this->Transaksi_model->editBarangKeluar($this->input->post('barang'), $this->input->post('jumlah'));
            //echo "Edit Data";
        }else{
            $simpan = $this->Transaksi_model->createBarangKeluar($data);
            //echo "Buat Data";
        }

        $kurangstok = $this->Inventory_model->editStok($this->input->post('barang'), $this->input->post('jumlah'));

        if($simpan)
        {
            $this->session->set_flashdata('message','successfull'); 
            redirect('barangkeluar/add');
        }
        else
        {
            $this->session->set_flashdata('message','error'); 
            redirect('barangkeluar/add');
        }

    }

    public function changecart()
    {
        $nosurat = $this->input->post('nosurat');

        $data = array(
            'surat_jalan' => $nosurat,
            'id_brg' => $this->input->post('barang'),
            'jumlah_transaksi' => $this->input->post('jumlah'),
            'jenis_transaksi' => 'keluar',
            'created_at' => $this->Calendar_model->indocal()
        );

        $cek = $this->Transaksi_model->detailCart($nosurat, $this->input->post('barang'))->row();
        
        if($cek != NULL){
            $simpan = $this->Transaksi_model->editBarangKeluar($this->input->post('barang'), $this->input->post('jumlah'));
            // echo "Ubah Data";
        }else{
            $simpan = $this->Transaksi_model->createBarangKeluar($data);
            //echo "Buat Data";
            
        }
        
        $kurangstok = $this->Inventory_model->editStok($this->input->post('barang'), $this->input->post('jumlah'));

        if($simpan)
        {
            $this->session->set_flashdata('message','successfull'); 
            redirect('barangkeluar/edit/'.$nosurat);
        }
        else
        {
            $this->session->set_flashdata('message','error'); 
            redirect('barangkeluar/edit/'.$nosurat);
        }

    }

    public function createtransaksi()
    {
        $data = array(
            'surat_jalan' => $this->input->post('nomor'),
            'tujuan' => $this->input->post('tujuan'),
            'no_telp' => $this->input->post('telp'),
            'penerima' => $this->input->post('nama'),
            'pembuat' => $this->session->userdata('id'),
            'created_at' => $this->Calendar_model->indocal()
        );

        $simpan = $this->Inventory_model->createTransaksi($data);

        if($simpan)
        {
            $this->session->set_flashdata('message','successfull'); 
            redirect('barangkeluar');
        }
        else
        {
            $this->session->set_flashdata('message','error'); 
            redirect('barangkeluar');
        }

    }

    public function changetransaksi()
    {
        $nosurat = $this->input->post('nomor');

        $data = array(
            'tujuan' => $this->input->post('tujuan'),
            'no_telp' => $this->input->post('telp'),
            'penerima' => $this->input->post('nama'),
            'pembuat' => $this->session->userdata('id'),
            'updated_at' => $this->Calendar_model->indocal()
        );

        $simpan = $this->Transaksi_model->editTransaksi($nosurat, $data);

        if($simpan)
        {
            $this->session->set_flashdata('message2','successfull'); 
            redirect('barangkeluar');
        }
        else
        {
            $this->session->set_flashdata('message2','error'); 
            redirect('barangkeluar');
        }

    }

    public function delete()
    {
        $id = $this->input->post('id');
        $idbrg = $this->input->post('idbrg');
        $nosurat = $this->input->post('surat');
        
        $hapus = $this->Transaksi_model->deleteBarangkeluar($id);
        $balikstok = $this->Inventory_model->reStok($idbrg, $this->input->post('jumlah'));

        if($hapus)
        {
            $this->session->set_flashdata('message3','successfull');
            redirect('barangkeluar/edit/'.$nosurat);
        }
        else
        {
            $this->session->set_flashdata('message3','error');
            redirect('barangkeluar/edit/'.$nosurat);
        }
    }

    public function delete1()
    {
        $id = $this->input->post('id');
        $idbrg = $this->input->post('idbrg');
        $nosurat = $this->input->post('surat');
        
        $hapus = $this->Transaksi_model->deleteBarangkeluar($id);
        $balikstok = $this->Inventory_model->reStok($idbrg, $this->input->post('jumlah'));

        if($hapus)
        {
            $this->session->set_flashdata('message3','successfull');
            redirect('barangkeluar/add');
        }
        else
        {
            $this->session->set_flashdata('message3','error');
            redirect('barangkeluar/add');
        }
    }

    public function deletetransaksi()
    {
        $surat = $this->input->post('surat');
        
        $data['bk'] = $this->Transaksi_model->showCartBarangKeluar($surat)->result();
        
        foreach($data['bk'] as $data)
        {
            $hapuscart = $this->Transaksi_model->deleteBarangkeluar($data->id_cart);
            $balikstok = $this->Inventory_model->reStok($data->id_brg, $data->jml_transaksi);
        }

        $hapus = $this->Transaksi_model->deleteTran($surat);
        
        if($hapus)
        {
            $this->session->set_flashdata('message3','successfull');
            redirect('barangkeluar');
        }
        else
        {
            $this->session->set_flashdata('message3','error');
            redirect('barangkeluar');
        }
    }

    public function show($surat)
    {
        $data['informasi'] = $this->Transaksi_model->showTransaksi($surat)->row();
        $data['bk'] = $this->Transaksi_model->showCartBarangKeluar($surat)->result();

        $data['nomor'] = $data['informasi']->surat_jalan;
        $data['penerima'] = $data['informasi']->penerima;
        $data['tujuan'] = $data['informasi']->tujuan;
        $data['no_telp'] = $data['informasi']->no_telp;
        $data['tgl_keluar'] = $data['informasi']->tgl_keluar;

        $this->load->view('parts/header');
        $this->load->view('parts/sidebar');
		$this->load->view('v_detail-transaksi-keluar', $data);
		$this->load->view('parts/footer');
        // var_dump($data['informasi']);
    }


}
