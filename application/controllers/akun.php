<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_akun');
		if($this->session->userdata('masuk') != TRUE){
            redirect('login');
        }
	}

	function index()
	{
		$data['akun'] = $this->m_akun->getData()->result();
		$this->load->view('v_header');
		$this->load->view('v_akun', $data);
		$this->load->view('v_footer');
	}

	function addAkun()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$level = $this->input->post('level');

		$data = array(
			'username' => $username,
			'password' => md5($password),
			'level' => $level
			);

		$this->m_akun->input($data, 'tb_user');
		$this->session->set_flashdata('add', 'Akun Berhasil Ditambah');
		redirect('akun');
	}

	function delAkun($id_user)
	{
		if($this->session->userdata('akses') != 'admin'){
            redirect('akun');
    	}else{
    		$this->m_akun->del($id_user);
    		$this->session->set_flashdata('delete', 'Akun Berhasil Dihapus');
			redirect('akun');
    	}
		
	}

	function editAkun()
	{
		$id_user = $this->input->post('id_user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$level = $this->input->post('level');

		if (!empty($password)){
			$data = array(
			'username' => $username,
			'password' => md5($password),
			'level' => $level
			);
		}else{
			$data = array(
			'username' => $username,
			'level' => $level
			);
		}
		

		$where = array('id_user' => $id_user);
		$this->m_akun->edit($where,$data,'tb_user');
		$this->session->set_flashdata('edit', 'Data Akun Berhasil Diubah');
		// $this->output->enable_profiler(TRUE);
		redirect('akun');
	}
	
}
