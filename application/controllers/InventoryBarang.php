<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InventoryBarang extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->helper("file");
        $this->load->helper('path');
        $this->load->library(array('form_validation','pagination','session'));
        $this->load->library('ciqrcode');
        $this->load->model('Auth_model');
        $this->load->model('Calendar_model');
        $this->load->model('Jenis_model');
        $this->load->model('Satuan_model');
        $this->load->model('Inventory_model');
        if($this->Auth_model->isNotLogin()) redirect('auth');
    }

	public function index()
	{
        $data['jenis'] = $this->Jenis_model->showJenis()->result();
        $data['satuan'] = $this->Satuan_model->showSatuan()->result();
        $data['inventory'] = $this->Inventory_model->showInventory()->result();

		$this->load->view('parts/header');
        $this->load->view('parts/sidebar');
		$this->load->view('v_md-inventory-barang', $data);
		$this->load->view('parts/footer');
	}

    public function create()
    {
        $berkas = $_FILES['file_barang']['name'];
        $config['upload_path'] = './file_logistik';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = 5024;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('file_barang')){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', $error); 
			$this->load->view('parts/header');
            $this->load->view('parts/sidebar');
            $this->load->view('v_md-inventory-barang');
            $this->load->view('parts/footer');
        }else{
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            
            $config['cacheable']	= true;
            $config['cachedir']		= './qrlogistik/';
            $config['errorlog']		= './qrlogistik/';
            $config['imagedir']		= './qrlogistik/';
            $config['quality']		= true;
            $config['size']			= '1024';
            $config['black']		= array(224,255,255);
            $config['white']		= array(70,130,180);
            $this->ciqrcode->initialize($config);

            $image_name=$this->input->post('kode_barang').rand(2,200).'.png';

            $params = array(
                'data' => $this->input->post('kode_barang'),
                'level' => 'H',
                'size' => 10,
                'savename' => FCPATH.$config['imagedir'].$image_name
            );

            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

            $data = array(
                'kode_barang' => $this->input->post('kode_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'stok' => $this->input->post('stok'),
                'satuan_barang' => $this->input->post('satuan_barang'),
                'foto_barang' => $file_name,
                'qr_code' => $image_name,
                'user_uploaded' => $this->session->userdata('id'),
                'created_at' => $this->Calendar_model->indocal()
            );
    
            $simpan = $this->Inventory_model->createInventory($data);
            if($simpan)
            {
                $this->session->set_flashdata('message','successfull'); 
                redirect('inventorybarang');
            }
            else
            {
                $this->session->set_flashdata('message','error'); 
                redirect('inventorybarang');
            }
        }

    }

    public function edit()
    {
        $id = $this->input->post('id');

        $berkas = $_FILES['file_barang']['name'];
        $config['upload_path'] = './file_logistik';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = 5024;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $barang = $this->Inventory_model->detailInventory($id)->row();
        //var_dump($barang);

        if($berkas == ""){
                $targetqr = './qrlogistik/'.$barang->qr_code;
                unlink($targetqr);

                $config['cacheable']	= true;
                $config['cachedir']		= './qrlogistik/';
                $config['errorlog']		= './qrlogistik/';
                $config['imagedir']		= './qrlogistik/';
                $config['quality']		= true;
                $config['size']			= '1024';
                $config['black']		= array(224,255,255);
                $config['white']		= array(70,130,180);
                $this->ciqrcode->initialize($config);

                $image_name = $this->input->post('kode_barang').rand(2,200).'.png';

                $params = array(
                    'data' => $this->input->post('kode_barang'),
                    'level' => 'H',
                    'size' => 10,
                    'savename' => FCPATH.$config['imagedir'].$image_name
                );

            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

            $data = array(
                'kode_barang' => $this->input->post('kode_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'stok' => $this->input->post('stok'),
                'satuan_barang' => $this->input->post('satuan_barang'),
                'qr_code' => $image_name,
                'updated_at' => $this->Calendar_model->indocal()
            );
    
            $simpan = $this->Inventory_model->editInventory($id, $data);
            if($simpan)
            {
                $this->session->set_flashdata('message2','successfull'); 
                redirect('inventorybarang');
            }
            else
            {
                $this->session->set_flashdata('message2','error'); 
                redirect('inventorybarang');
            }
        }else{
            $target = './file_logistik/'.$barang->foto_barang;
            $targetqr = './qrlogistik/'.$barang->qr_code;
            unlink($target);
            unlink($targetqr);

            if ( ! $this->upload->do_upload('file_barang')){
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', $error); 
                $this->load->view('parts/header');
                $this->load->view('parts/sidebar');
                $this->load->view('v_md-inventory-barang');
                $this->load->view('parts/footer');
            }else{
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];

                $config['cacheable']	= true;
                $config['cachedir']		= './qrlogistik/';
                $config['errorlog']		= './qrlogistik/';
                $config['imagedir']		= './qrlogistik/';
                $config['quality']		= true;
                $config['size']			= '1024';
                $config['black']		= array(224,255,255);
                $config['white']		= array(70,130,180);
                $this->ciqrcode->initialize($config);

                $image_name = $this->input->post('kode_barang').rand(2,200).'.png';

                $params = array(
                    'data' => $this->input->post('kode_barang'),
                    'level' => 'H',
                    'size' => 10,
                    'savename' => FCPATH.$config['imagedir'].$image_name
                );

                $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

                $data = array(
                    'kode_barang' => $this->input->post('kode_barang'),
                    'nama_barang' => $this->input->post('nama_barang'),
                    'stok' => $this->input->post('stok'),
                    'satuan_barang' => $this->input->post('satuan_barang'),
                    'foto_barang' => $file_name,
                    'qr_code' => $image_name,
                    'updated_at' => $this->Calendar_model->indocal()
                );
        
                $simpan = $this->Inventory_model->editInventory($id, $data);
                if($simpan)
                {
                    $this->session->set_flashdata('message2','successfull'); 
                    redirect('inventorybarang');
                }
                else
                {
                    $this->session->set_flashdata('message2','error'); 
                    redirect('inventorybarang');
                }
            }
            
        }

    }

    public function delete()
    {
        $id = $this->input->post('id');

        $barang = $this->Inventory_model->detailInventory($id)->row();

        $target = './file_logistik/'.$barang->foto_barang;
        $targetqr = './qrlogistik/'.$barang->qr_code;
        unlink($target);
        unlink($targetqr);
        
        $hapus = $this->Inventory_model->deleteInventory($id);
        if($hapus)
        {
            $this->session->set_flashdata('message3','successfull');
            redirect('inventorybarang');
        }
        else
        {
            $this->session->set_flashdata('message3','error');
            redirect('inventorybarang');
        }
    }

    public function show($id)
    {
        $data['barang'] = $this->Inventory_model->detailInventory($id)->row();

        $data['kode'] = $data['barang']->kode_barang;
        $data['nama_barang'] = $data['barang']->nama_barang;
        $data['jenis'] = $data['barang']->jenis;
        $data['satuan'] = $data['barang']->satuan;
        $data['stok'] = $data['barang']->stok;
        $data['foto_barang'] = $data['barang']->foto_barang;
        $data['qr_code'] = $data['barang']->qr_code;

        $this->load->view('parts/header');
		$this->load->view('parts/sidebar');
		$this->load->view('v_detail-md-inventory-barang', $data);
		$this->load->view('parts/footer');
    }

    public function cetak()
    {
        $data['inventory'] = $this->Inventory_model->showInventory()->result();

		$this->load->view('v_cetak-qrcode', $data);
    }

    public function cekstokopname()
    {
        // $this->load->view('v_cek-stok-opname');
        $this->load->view('parts/header');
		$this->load->view('parts/sidebar');
		$this->load->view('v_cek-stok-opname');
		$this->load->view('parts/footer');
    }

    public function cekstok()
    {
        $kodebarang = $this->input->post('kode');
        $data['barang'] = $this->Inventory_model->ScanInventory($kodebarang)->row();

        if(!empty($data['barang'])){
            $arr = array(
                'kode' => $data['barang']->kode_barang,
                'nama_barang' => $data['barang']->nama_barang,
                'jenis' => $data['barang']->jenis,
                'satuan' => $data['barang']->satuan,
                'stok' => $data['barang']->stok,
                'foto' => $data['barang']->foto_barang
            );
            echo json_encode($arr);
        }else{
            echo json_encode('empty');
        }
        
    }

    public function cektransaksi()
    {
        $kodebarang = $this->input->post('kode');
        $data = $this->Inventory_model->ScanTransaksi($kodebarang)->result();
        if(!empty($data)){
            foreach($data as $value){
                
                echo "<tr>
                            <td>".$value->kode_barang."</td>
                            <td>".$value->nama_barang."</td>
                            <td>".$value->stok." (".$value->satuan.")</td>
                            <td>".$value->jenis."</td>
                            <td>".$value->jmlh_transaksi."</td>
                            <td>Barang ".ucwords($value->jenis_transaksi)."</td>
                            <td>".$this->kondisi($value->status_barang)."</td>
                            <td>".$value->keterangan."</td>
                    </tr>";
                }
            
            
        }else{
            echo "<tr>
                    <td colspan='8'><center>Belum ada data !</center></td>
                 </tr>";
        }
        
    }

    public function kondisi($str)
    {
        if($str == "b"){
            $value = "Baik";
        }else if($str == "r"){
            $value = "Rusak";
        }else if($str == "h"){
            $value = "Hilang";
        }
        return $value;
    }

}
