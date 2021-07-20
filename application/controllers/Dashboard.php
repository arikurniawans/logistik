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
        if($this->Auth_model->isNotLogin()) redirect('auth');
    }

	public function index()
	{
		$this->load->view('parts/header');
        $this->load->view('parts/sidebar');
		$this->load->view('v_dashboard');
		$this->load->view('parts/footer');
	}
}
