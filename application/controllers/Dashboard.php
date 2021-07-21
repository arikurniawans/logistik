<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation','pagination','session'));
        $this->load->model('Auth_model');
        $this->load->model('Calendar_model');
        $this->load->model('Inventory_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Jenis_model');
        if($this->Auth_model->isNotLogin()) redirect('auth');
    }

	public function index()
	{
        $bulan = $this->Calendar_model->indomonth();

        $data['inventory'] = $this->Inventory_model->showInventory()->num_rows();
        $data['minbarang'] = $this->Inventory_model->minInventory()->result();
        $data['bk'] = $this->Transaksi_model->showBarangKeluar()->num_rows();
        $data['bm'] = $this->Transaksi_model->showBarangMasuk('2')->num_rows();
        $data['jenis'] = $this->Jenis_model->showJenis()->num_rows();
        $data['grafik'] = $this->Transaksi_model->showGrafik($bulan)->result();
        $data['periode'] = $this->Calendar_model->indodate3();

		$this->load->view('parts/header');
        $this->load->view('parts/sidebar');
		$this->load->view('v_dashboard', $data);
		$this->load->view('parts/footer');
        // var_dump($data['grafik']);
	}

}
