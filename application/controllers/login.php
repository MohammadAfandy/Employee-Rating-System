<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
	}

	function index()
	{
		$this->load->view('v_login');
	}

	// function loginAction(){
	// 	$username = $this->input->post('username');
	// 	$password = $this->input->post('password');
	// 	$where = array(
	// 		'username' => $username,
	// 		'password' => md5($password)
	// 		);
	// 	$cek = $this->m_login->cek_login("tb_user",$where)->num_rows();
	// 	if($cek > 0){
	// 		$data_session = array(
	// 			'nama' => $username,
	// 			'status' => "login"
	// 			);
 
	// 		$this->session->set_userdata($data_session);
 
	// 		redirect(base_url("admin"));
 
	// 	}else{
	// 		echo "Username dan password salah !";
	// 	}
	// }

	function loginAction(){
        $username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
        $password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
 
 		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->m_login->cekLogin("tb_user",$where);

        if($cek->num_rows() > 0){ 
        	$data=$cek->row_array();
            $this->session->set_userdata('masuk',TRUE);
            if($data['level']=='admin'){ 
            	$this->session->set_userdata('akses','admin');
                $this->session->set_userdata('ses_id',$data['username']);
                redirect('index');
 
            }else{
                $this->session->set_userdata('akses','user');
            	$this->session->set_userdata('ses_id',$data['username']);
                redirect('index');
            }
 		}else{
 			$this->session->set_flashdata('msg','Username Atau Password Salah');
			redirect('login');
		}
		// $this->output->enable_profiler(TRUE);
    }
 
	function logoutAction(){
		$this->session->sess_destroy();
		redirect('login');
	}
}
