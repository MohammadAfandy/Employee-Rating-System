<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_penilaian');
		if($this->session->userdata('masuk') != TRUE){
            redirect('login');
        }
	}

	function index()
	{
		$data['penilaian'] = $this->m_penilaian->getDataPenilaian()->result();
		$data['kriteria'] = $this->m_penilaian->getDataKriteria()->result();
		$data['pegawai'] = $this->m_penilaian->getDataPegawai()->result();
		$data['pegawaipenilaian'] = $this->m_penilaian->getDataPegawaiPenilaian()->result();
		$data['ceknip'] = $this->m_penilaian->getDataNip()->result();
		$data['jumlahnip'] = count($data['ceknip']);

		// $data['pegawaiid'] = $this->m_penilaian->getDataPegawaiById($id_pegawai);

		// foreach ($data['pegawai'] as $p){
		// 	$id = $p->id_pegawai;
		// 	$data['score'] = $this->m_penilaian->getDataPenilaianByIdPegawai($id)->result();
		// 	// echo $this->db->last_query();
		// }


		// $this->output->enable_profiler(TRUE);
		$this->load->view('v_header');
		$this->load->view('v_penilaian', $data);
		$this->load->view('v_footer');
	}

	function addPenilaian()
	{
		$hasil['kriteria'] = $this->m_penilaian->getDataKriteria()->result();
		$id_pegawai = $this->input->post('id_pegawai');

		foreach ($hasil['kriteria'] as $k){
			$id_kriteria = $this->input->post($k->id_kriteria);
			$nilai = $this->input->post('c'.$k->id_kriteria);
			$data = array(
						'id_pegawai' => $id_pegawai,
						'id_kriteria' => $id_kriteria,
						'nilai' => $nilai
					);		
			$this->m_penilaian->input($data, 'tb_penilaian');
			$this->session->set_flashdata('add', 'Data Penilaian Berhasil Ditambah');
			// $this->output->enable_profiler(TRUE);
		}
		redirect('penilaian');
	}

	function delPenilaian($id_pegawai)
	{
		if($this->session->userdata('akses') != 'admin'){
            redirect('penilaian');
    	}else{
    		$this->m_penilaian->del($id_pegawai);
    		$this->session->set_flashdata('delete', 'Data Penilaian Berhasil Dihapus');
			redirect('penilaian');
    	}
	}
	
	function editPenilaian()
	{
		$hasil['kriteria'] = $this->m_penilaian->getDataKriteria()->result();
		$id_pegawai = $this->input->post('id_pegawai');
		
		foreach ($hasil['kriteria'] as $p){
			$id_kriteria = $this->input->post($p->id_kriteria);
			$nilai = $this->input->post('c'.$p->id_kriteria);
			$where = array('id_pegawai' => $id_pegawai,
							'id_kriteria' => $id_kriteria);
			$data = array('nilai' => $nilai);		
			$this->m_penilaian->edit($where, $data, 'tb_penilaian');
			$this->session->set_flashdata('edit', 'Data Penilaian Berhasil Diubah');
			// $this->output->enable_profiler(TRUE);
		}
		redirect('penilaian');
	}
}
