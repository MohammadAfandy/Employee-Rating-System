<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_penilaian');
		$this->load->model('m_laporan');
		$this->load->library('pdf');
		if($this->session->userdata('masuk') != TRUE){
            redirect('login');
        }
	}

	function index()
	{
		// model m_penilaian
		$data['penilaian'] = $this->m_penilaian->getDataPenilaian()->result();
		$data['kriteria'] = $this->m_penilaian->getDataKriteria()->result();
		$data['pegawai'] = $this->m_penilaian->getDataPegawai()->result();
		$data['pegawaipenilaian'] = $this->m_penilaian->getDataPegawaiPenilaian()->result();
		$data['ceknip'] = $this->m_penilaian->getDataNip()->result();
		$data['jumlahnip'] = count($data['ceknip']);

		// model m_laporan
		$this->load->view('v_header');
		$this->load->view('v_laporan', $data);
		$this->load->view('v_footer');


	}
}
