<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation','pagination','session'));
        $this->load->model('Auth_model');
        $this->load->model('Calendar_model');
        $this->load->model('Satuan_model');
        $this->load->model('Jenis_model');
        if($this->Auth_model->isNotLogin()) redirect('auth');
    }

	public function index()
	{
        $data['satuan'] = $this->Satuan_model->showSatuan()->result();
        $data['jenis'] = $this->Jenis_model->showJenis()->result();

		$this->load->view('parts/header');
        $this->load->view('parts/sidebar');
		$this->load->view('v_pg-satuan', $data);
		$this->load->view('parts/footer');
	}

    public function create()
    {
        $data = array(
            'satuan' => $this->input->post('satuan'),
            'id_jenis' => $this->input->post('jenis_barang'),
            'created_at' => $this->Calendar_model->indocal()
        );

        $simpan = $this->Satuan_model->createSatuan($data);
        if($simpan)
        {
            $this->session->set_flashdata('message','successfull'); 
            redirect('satuan');
        }
        else
        {
            $this->session->set_flashdata('message','error'); 
            redirect('satuan');
        }

    }

    public function edit()
    {
        $id = $this->input->post('id');

        $data = array(
            'satuan' => $this->input->post('satuan'),
            'id_jenis' => $this->input->post('jenis_barang'),
            'updated_at' => $this->Calendar_model->indocal()
        );

        $simpan = $this->Satuan_model->editSatuan($id, $data);
        if($simpan)
        {
            $this->session->set_flashdata('message2','successfull'); 
            redirect('satuan');
        }
        else
        {
            $this->session->set_flashdata('message2','error'); 
            redirect('satuan');
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        
        $hapus = $this->Satuan_model->deleteSatuan($id);
        if($hapus)
        {
            $this->session->set_flashdata('message3','successfull');
            redirect('satuan');
        }
        else
        {
            $this->session->set_flashdata('message3','error');
            redirect('satuan');
        }
    }


}
