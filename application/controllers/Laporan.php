<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation','pagination','session'));
        $this->load->model('Auth_model');
        $this->load->model('Transaksi_model');
        if($this->Auth_model->isNotLogin()) redirect('auth');
    }

	public function index()
	{
        redirect('dashboard');
	}

    public function laporankeluar()
    {
        if($this->input->post() != NULL)
        {
            $tgl1 = $this->input->post('tgl1');
            $tgl2 = $this->input->post('tgl2');

            if($tgl1 == "" AND $tgl2 == ""){
                $data['barang'] = $this->Transaksi_model->showBarangKeluar()->result();
            }else{
                $data['barang'] = $this->Transaksi_model->showFilterKeluar($tgl1, $tgl2)->result();
            }
            
            $this->load->view('parts/header');
            $this->load->view('parts/sidebar');
            $this->load->view('v_laporan-keluar', $data);
            $this->load->view('parts/footer');
        }else{
            $data['barang'] = $this->Transaksi_model->showBarangKeluar()->result();

            $this->load->view('parts/header');
            $this->load->view('parts/sidebar');
            $this->load->view('v_laporan-keluar', $data);
            $this->load->view('parts/footer');
        }
        
    }

    public function laporanmasuk()
    {
        if($this->input->post() != NULL)
        {
            $tgl1 = $this->input->post('tgl1');
            $tgl2 = $this->input->post('tgl2');

            if($tgl1 == "" AND $tgl2 == ""){
                $data['barang'] = $this->Transaksi_model->showBarangMasuk('2')->result();
            }else{
                $data['barang'] = $this->Transaksi_model->showFilterMasuk($tgl1, $tgl2)->result();
            }
            
            $this->load->view('parts/header');
            $this->load->view('parts/sidebar');
            $this->load->view('v_laporan-masuk', $data);
            $this->load->view('parts/footer');
        }else{
            $data['barang'] = $this->Transaksi_model->showBarangMasuk('2')->result();

            $this->load->view('parts/header');
            $this->load->view('parts/sidebar');
            $this->load->view('v_laporan-masuk', $data);
            $this->load->view('parts/footer');
        }
        
    }

}
