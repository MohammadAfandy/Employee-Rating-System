<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_kriteria');
		$this->load->helper('form');
		if($this->session->userdata('masuk') != TRUE){
            redirect('login');
        }
	}

	function index()
	{
		$data['angkaBobot'] = array(
			'' => '-Set Bobot-',
			'0.1' => '10 %',
			'0.15' => '15 %',
			'0.2' => '20 %',
			'0.25' => '25 %',
			'0.3' => '30 %',
		);

		$data['kriteria'] = $this->m_kriteria->getData()->result();
		$this->load->view('v_header');
		$this->load->view('v_kriteria', $data);
		$this->load->view('v_footer');
	}

	function setBobot(){
		$data['kriteria'] = $this->m_kriteria->getData()->result();

		foreach ($data['kriteria'] as $k) {
			$bobot = $this->input->post('c'.$k->id_kriteria);
			$id_kriteria = $this->input->post('id_kriteria');
			$where = array('id_kriteria' => $k->id_kriteria);
			$data = array(
				'bobot' => $bobot
			);
			$this->m_kriteria->edit($where,$data,'tb_kriteria');
			
		}

		redirect('kriteria');
	}

	function editKriteria()
	{
		$data['kriteria'] = $this->m_kriteria->getData()->result();
		$id_kriteria = $this->input->post('id_kriteria');
		$nama_kriteria = $this->input->post('nama_kriteria');

		$where = array('id_kriteria' => $id_kriteria);

		$data = array(
			'nama_kriteria' => $nama_kriteria
		);

		$this->m_kriteria->edit($where,$data,'tb_kriteria');
	
		redirect('kriteria');
	}

}
