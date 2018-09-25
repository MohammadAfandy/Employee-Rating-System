<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pegawai');
		if($this->session->userdata('masuk') != TRUE){
            redirect('login');
        }
	}

	function index()
	{
		$data['pegawai'] = $this->m_pegawai->getData()->result();
		$this->load->view('v_header');
		$this->load->view('v_pegawai', $data);
		$this->load->view('v_footer');
	}



	function addPegawai()
	{
		
		$nip = $this->input->post('nip');
		$nama_pegawai = $this->input->post('nama_pegawai');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$jk = $this->input->post('jk');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');

		$data = array(
			'nip' => $nip,
			'nama_pegawai' => $nama_pegawai,
			'tgl_lahir' => $tgl_lahir,
			'jk' => $jk,
			'no_hp' => $no_hp,
			'email' => $email
			);

		$this->m_pegawai->input($data, 'tb_pegawai');
		redirect('pegawai');
	}

	function delPegawai($id_pegawai)
	{
		if($this->session->userdata('akses') != 'admin'){
            redirect('pegawai');
    	}else{
    		$this->m_pegawai->del($id_pegawai);
			redirect('pegawai');
    	}
		
	}

	function editPegawai()
	{
		$id_pegawai = $this->input->post('id_pegawai');
		$nip = $this->input->post('nip');
		$nama_pegawai = $this->input->post('nama_pegawai');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$jk = $this->input->post('jk');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');

		$data = array(
			'nip' => $nip,
			'nama_pegawai' => $nama_pegawai,
			'tgl_lahir' => $tgl_lahir,
			'jk' => $jk,
			'no_hp' => $no_hp,
			'email' => $email
			);

		$where = array('id_pegawai' => $id_pegawai);
		$this->m_pegawai->edit($where,$data,'tb_pegawai');
		redirect('pegawai');
	}
}
