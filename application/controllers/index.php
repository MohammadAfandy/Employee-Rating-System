<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		if($this->session->userdata('masuk') != TRUE){
            redirect('login');
        }
	}

	public function index()
	{
		$this->load->view('v_header');
		$this->load->view('v_index');
		$this->load->view('v_footer');
	}
}
